<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PpdbControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->student) {
            return redirect()->route('ppdb.payment');
        }
        return view('ppdb');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student.nisn' => ['required', 'string', 'max:255'],
            'student.full_name' => ['required', 'string', 'max:255'],
            'student.gender' => ['required', 'string', 'in:male,female'],
            'student.birth_place' => ['required', 'string', 'max:255'],
            'student.birth_date' => ['required', 'date'],
            'student.religion' => ['required', 'string', 'max:255'],
            'student.address' => ['required', 'string'],
            'student.whatsapp' => ['required', 'string', 'max:255'],
            'student.email' => ['required', 'email', 'max:255'],
            'student.last_school' => ['required', 'string', 'max:255'],
            'student.org_experience' => ['string', 'nullable'],
            'student.height' => ['required', 'numeric'],
            'student.weight' => ['required', 'numeric'],
            'student.history_illness' => ['string', 'nullable'],
            'parent.full_name' => ['required', 'string', 'max:255'],
            'parent.gender' => ['required', 'string', 'in:male,female'],
            'parent.job' => ['required', 'string'],
            'parent.income_per_month' => ['required', 'numeric'],
            'parent.whatsapp' => ['required', 'string', 'max:255'],
            'parent.email' => ['required', 'email', 'max:255'],
            'payment_method' => ['required', 'string', 'in:qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline']
        ]);


        $student = $request->student;
        $parent = $request->parent;
        $payment_method = $request->payment_method;
        $user = Auth::user();

        DB::transaction(function () use ($user, $student, $parent, $payment_method) {
            // registering student
            $create_student = $user->student()->create([
                'nisn' => $student['nisn'],
                'full_name' => $student['full_name'],
                'gender' => $student['gender'],
                'birth_place' => $student['birth_place'],
                'birth_date' => $student['birth_date'],
                'religion' => $student['religion'],
                'address' => $student['address'],
                'email' => $student['email'],
                'whatsapp' => $student['whatsapp'],
                'last_school' => $student['last_school'],
                'org_experience' => $student['org_experience'],
                'height' => $student['height'],
                'weight' => $student['weight'],
                'history_illness' => $student['history_illness'],
                'is_new' => true,
            ]);

            // registering student's parent
            $create_student->parent()->create([
                'full_name' => $parent['full_name'],
                'gender' => $parent['gender'],
                'job' => $parent['job'],
                'income_per_month' => $parent['income_per_month'],
                'whatsapp' => $parent['whatsapp'],
                'email' => $parent['email'],
            ]);

            // create transaction
            $order_id = 'PPDB-' . uniqid();
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => 150000,
                ],
                'item_details' => [
                    [
                        'id' => "$order_id-$create_student->full_name",
                        'name' => "PPDB untuk $create_student->full_name",
                        'quantity' => 1,
                        'price' => 150000
                    ]
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email
                ],
                'custom_expiry' => [
                    'expiry_duration' => 44640, // 31 days
                    'unit' => 'minute'
                ],
            ];

            // BCA virtual account
            if ($payment_method == 'va_bca') {
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bca'
                ];
            }

            // BNI virtual account
            if ($payment_method == 'va_bni') {
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bni'
                ];
            }

            // BRI virtual account
            if ($payment_method == 'va_bri') {
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bri'
                ];
            }

            // CIMB virtual account
            if ($payment_method == 'va_cimb') {
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'cimb'
                ];
            }

            // Permata virtual account
            if ($payment_method == 'va_permata') {
                $params['payment_type'] = 'permata';
            }

            // GoPay
            if ($payment_method == 'gopay') {
                $params['payment_type'] = 'gopay';
                $params['gopay'] = [
                    'enable_callback' => true,
                    'callback_url' => route('ppdb.payment')
                ];
            }

            // QRIS
            if ($payment_method == 'qris') {
                $params['payment_type'] = 'qris';
                $params['qris'] = [
                    'acquirer' => 'gopay'
                ];
            }

            // ShopeePay
            if ($payment_method == 'shopeepay') {
                $params['payment_type'] = 'shopeepay';
                $params['shopeepay'] = [
                    'callback_url' => route('ppdb.payment')
                ];
            }

            try {
                $midtransConfig = json_decode($this->startMidtransConfig());
                $response = \Midtrans\CoreApi::charge($params);

                // virtual account
                // BCA virtual account
                if ($payment_method == 'va_bca') {
                    $virtual_account = $response->va_numbers[0]->va_number;
                    $bank = $response->va_numbers[0]->bank;
                }

                // BNI virtual account
                if ($payment_method == 'va_bni') {
                    $virtual_account = $response->va_numbers[0]->va_number;
                    $bank = $response->va_numbers[0]->bank;
                }

                // BRI virtual account
                if ($payment_method == 'va_bri') {
                    $virtual_account = $response->va_numbers[0]->va_number;
                    $bank = $response->va_numbers[0]->bank;
                }

                // CIMB virtual account
                if ($payment_method == 'va_cimb') {
                    $virtual_account = $response->va_numbers[0]->va_number;
                    $bank = $response->va_numbers[0]->bank;
                }

                // Permata virtual account
                if ($payment_method == 'va_permata') {
                    $virtual_account = $response->permata_va_number;
                    $bank = 'permata';
                }

                // e-wallet
                // GoPay
                if ($payment_method == 'gopay') {
                    $link_qr_code = $response->actions[0]->url;
                    $link_deeplink = $response->actions[1]->url;
                    $link_get_status = $response->actions[2]->url;
                    $link_cancel = $response->actions[3]->url;
                }

                // QRIS
                if ($payment_method == 'qris') {
                    $link_qr_code = $response->actions[0]->url;
                }

                // ShopeePay
                if ($payment_method == 'shopeepay') {
                    $link_deeplink = $response->actions[0]->url;
                }

                $user->transaction()->create([
                    'order_id' => $response->order_id,
                    'fraud_status' => $response->fraud_status,
                    'transaction_id' => $response->transaction_id,
                    'transaction_status' => $response->transaction_status,
                    'payment_method' => $payment_method,
                    'virtual_account' => $virtual_account ?? null,
                    'bank' => $bank ?? null,
                    'status_message' => $response->status_message,
                    'status_code' => $response->status_code,
                    'gross_amount' => $response->gross_amount,
                    'link_qr_code' => $link_qr_code ?? null,
                    'link_deeplink' => $link_deeplink ?? null,
                    'link_get_status' => $link_get_status ?? null,
                    'link_cancel' => $link_cancel ?? null,
                    'minimarket' => null,
                    'minimarket_payment_code' => null,
                    'settlement_time' => null
                ]);
            } catch (\Throwable $th) {
                //throw $th;
                switch ($th->getCode()) {
                    case 402:
                        Log::debug('Payment channel is not activated, you have to activate your Core API');
                        break;

                    default:
                        Log::debug($th->getMessage());
                        break;
                }
            }
        });

        return redirect()->route('ppdb.payment');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function payment()
    {
        $user = Auth::user();
        if (!$user->student) {
            return redirect()->route('ppdb.index');
        }
        $student = $user->student;
        $transaction = $user->transaction;
        // return $transaction;
        return view('ppdb-payment', compact('student', 'transaction'));
    }
}