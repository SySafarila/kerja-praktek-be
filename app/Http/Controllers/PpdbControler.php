<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'student.religion' => ['required', 'string', 'max:255', 'in:islam,kristen_protestan,kristen_katolik,hindu,buddha,khonghucu'],
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

        if ($user->student) {
            return redirect()->route('ppdb.payment');
        }

        DB::beginTransaction();
        try {
            // registering student
            $student = $user->student()->create([
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
            $student->parent()->create([
                'full_name' => $parent['full_name'],
                'gender' => $parent['gender'],
                'job' => $parent['job'],
                'income_per_month' => $parent['income_per_month'],
                'whatsapp' => $parent['whatsapp'],
                'email' => $parent['email'],
            ]);

            // create transaction
            $order_id = 'PPDB-' . uniqid();

            // $this->charge_transaction($payment_method, $order_id, $student['full_name'], $user);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            // $this->midtrans_error_logger($th);
            return $this->midtrans_error_redirect($th);
        }

        // charge transaction
        DB::beginTransaction();
        try {
            $this->charge_transaction($payment_method, $order_id, $student, $user);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            $this->midtrans_error_logger($th);
            return $this->midtrans_error_redirect($th);
        }


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
        $validator = Validator::make($request->all(), [
            'student.nisn' => ['required', 'string', 'max:255'],
            'student.full_name' => ['required', 'string', 'max:255'],
            'student.gender' => ['required', 'string', 'in:male,female'],
            'student.birth_place' => ['required', 'string', 'max:255'],
            'student.birth_date' => ['required', 'date'],
            'student.religion' => ['required', 'string', 'max:255', 'in:islam,kristen_protestan,kristen_katolik,hindu,buddha,khonghucu'],
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
            'parent.email' => ['required', 'email', 'max:255']
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('update-error', 'true');
        }

        $user = Auth::user();
        $student = $request->student;
        $parent = $request->parent;
        $current_student = $user->student;
        $current_parent = $current_student->parent;

        DB::beginTransaction();
        try {
            $current_student->update([
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
                'history_illness' => $student['history_illness']
            ]);
            $current_parent->update([
                'full_name' => $parent['full_name'],
                'gender' => $parent['gender'],
                'job' => $parent['job'],
                'income_per_month' => $parent['income_per_month'],
                'whatsapp' => $parent['whatsapp'],
                'email' => $parent['email'],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            Log::error($th->getMessage());
            DB::rollBack();
            return back()->with('error', 'Tidak dapat memperbarui data PPDB');
        }
        return back()->with('success', 'Data PPDB berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function update_payment(Request $request)
    {
        $request->validate([
            'update_payment_method' => ['required', 'string', 'in:qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline']
        ]);

        $user = Auth::user();
        if (!$user->student) {
            return redirect()->route('ppdb.index');
        }
        $transaction = $user->transaction;
        if (!$transaction) {
            return redirect()->route('ppdb.payment');
        }

        if (in_array($transaction->transaction_status, ['pending', 'expire'])) {
            // update payment method
            if ($request->update_payment_method && in_array($request->update_payment_method, ['qris', 'va_bca', 'va_bni', 'va_bri', 'va_permata', 'va_cimb', 'gopay', 'shopeepay', 'offline'])) {
                $order_id = 'PPDB-' . uniqid();

                if ($transaction->payment_method == 'offline') {
                    // change payment method to offline
                    DB::beginTransaction();
                    try {
                        $this->charge_transaction($request->update_payment_method, $order_id, $user->student, $user);
                        $transaction->delete();
                        DB::commit();
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        $this->midtrans_error_logger($th);
                        return $this->midtrans_error_redirect($th);
                    }
                } else {
                    // change payment method to another online payment
                    // charge new transaction
                    DB::beginTransaction();
                    try {
                        $this->charge_transaction($request->update_payment_method, $order_id, $user->student, $user);
                        DB::commit();
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        $this->midtrans_error_logger($th);
                        return $this->midtrans_error_redirect($th);
                    }

                    // cancel current transaction
                    DB::beginTransaction();
                    try {
                        $this->startMidtransConfig();
                        $response = \Midtrans\Transaction::cancel($transaction->transaction_id);
                        $transaction->delete();
                        DB::commit();
                    } catch (\Throwable $th) {
                        //throw $th;
                        DB::rollBack();
                        $this->midtrans_error_logger($th);
                        return $this->midtrans_error_redirect($th);
                    }
                }
                return redirect()->route('ppdb.payment');
            }
        }
        return redirect()->route('ppdb.payment');
    }

    public function payment()
    {
        $user = Auth::user();
        if (!$user->student) {
            return redirect()->route('ppdb.index');
        }
        $student = $user->student;
        $transaction = $user->transaction;
        $files = $student->files;

        if (!$transaction) {
            // if transaction not found
            $order_id = 'PPDB-' . uniqid();
            DB::beginTransaction();
            try {
                $this->charge_transaction('qris', $order_id, $user->student, $user);
                DB::commit();
                return redirect()->route('ppdb.payment')->with('error', 'Kami tidak dapat menemukan transaksi pembayaran kamu. Sebagai gantinya, kami telah membuatkan transaksi yang baru.');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                $this->midtrans_error_logger($th);
                return $this->midtrans_error_redirect($th);
            }
        }

        // check transaction
        if ($transaction->transaction_status == 'pending' && $transaction->payment_method != 'offline') {
            // if transaction status is PENDING and the payment method is not OFFLINE
            try {
                // get transaction status
                $this->startMidtransConfig();
                $response = \Midtrans\Transaction::status($transaction->transaction_id);
            } catch (\Throwable $th) {
                //throw $th;
                $this->midtrans_error_logger($th);
                return view('errors.midtrans', ['code' => $th->getCode(), 'message' => 'Ada yang salah dengan pembayaranmu, silahkan hubungi admin']);
            }

            if ($response->transaction_status == 'settlement') {
                // if paid
                $this->midtrans_settlement($transaction, $response);
            }
            if ($response->transaction_status == 'expire') {
                // if expired
                $this->midtrans_expire($transaction, $response);
            }
            if ($response->transaction_status == 'cancel') {
                // if canceled
                $this->midtrans_cancel($transaction, $response);
                return redirect()->route('ppdb.payment')->with('error', 'Kami tidak dapat menemukan transaksi pembayaran kamu. Sebagai gantinya, kami telah membuatkan transaksi yang baru.');
            }
        }

        // return $files->where('file_type', 'kk')->first();
        return view('ppdb-payment', compact('student', 'transaction', 'files'));
    }

    function charge_transaction($payment_method, $order_id, $student, $user)
    {
        if ($payment_method == 'offline') {
            // bayar di sekolah
            $user->transaction()->create([
                'student_id' => $student->id,
                'order_id' => $order_id,
                'fraud_status' => null,
                'transaction_id' => $order_id,
                'transaction_status' => 'pending',
                'payment_method' => $payment_method,
                'virtual_account' => null,
                'bank' => null,
                'status_message' => null,
                'status_code' => null,
                'gross_amount' => 150000,
                'link_qr_code' => null,
                'link_deeplink' => null,
                'link_get_status' => null,
                'link_cancel' => null,
                'minimarket' => null,
                'minimarket_payment_code' => null,
                'settlement_time' => null
            ]);
        } else {
            // bayar secara online
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => 150000,
                ],
                'item_details' => [
                    [
                        'id' => "$order_id-$student->full_name",
                        'name' => "PPDB untuk $student->full_name",
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
                    'bank' => 'bca',
                    'free_text' => [
                        'payment' => [
                            'id' => "Pembayaran PPDB untuk $student->full_name",
                            'en' => "PPDB payment for $student->full_name"
                        ],
                        'inquiry' => [
                            'id' => "Pembayaran PPDB untuk $student->full_name",
                            'en' => "PPDB payment for $student->full_name"
                        ]
                    ]
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
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'permata',
                    'permata' => [
                        'recipient_name' => "PPDB - $student->full_name"
                    ]
                ];
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
                    'student_id' => $student->id,
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
                $this->midtrans_error_logger($th);
                throw $th;
            }
        }
    }

    public function upload_files(Request $request)
    {
        $request->validate([
            'kk' => ['file', 'max:10240'],
            'akta' => ['file', 'max:10240'],
            'kip' => ['file', 'max:10240', 'nullable'],
            'pkh' => ['file', 'max:10240', 'nullable'],
        ]);

        $user = Auth::user();
        $student = $user->student;

        $kk = $student->files()->where('file_type', 'kk')->first();
        $akta = $student->files()->where('file_type', 'akta')->first();
        $kip = $student->files()->where('file_type', 'kip')->first();
        $pkh = $student->files()->where('file_type', 'pkh')->first();

        // kartu keluarga
        if (!$kk) {
            $request->validate([
                'kk' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
            ]);
            $kk_upload = Storage::putFile('/student-files/kk', new File($request->file('kk')));
            $student->files()->create([
                'file_name' => $kk_upload,
                'file_type' => 'kk',
                'original_file_name' => $request->file('kk')->getClientOriginalName()
            ]);
        } else {
            if ($request->hasFile('kk')) {
                $request->validate([
                    'kk' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                if (Storage::exists($kk->file_name)) {
                    Storage::delete($kk->file_name);
                }
                DB::beginTransaction();
                try {
                    $kk->delete();
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollBack();
                }
                $kk_upload = Storage::putFile('/student-files/kk', new File($request->file('kk')));
                $student->files()->create([
                    'file_name' => $kk_upload,
                    'file_type' => 'kk',
                    'original_file_name' => $request->file('kk')->getClientOriginalName()
                ]);
            }
        }

        // akta kelahiran
        if (!$akta) {
            $request->validate([
                'akta' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
            ]);
            $akta_upload = Storage::putFile('/student-files/akta', new File($request->file('akta')));
            $student->files()->create([
                'file_name' => $akta_upload,
                'file_type' => 'akta',
                'original_file_name' => $request->file('akta')->getClientOriginalName()
            ]);
        } else {
            if ($request->hasFile('akta')) {
                $request->validate([
                    'akta' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                if (Storage::exists($akta->file_name)) {
                    Storage::delete($akta->file_name);
                }
                DB::beginTransaction();
                try {
                    $akta->delete();
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollBack();
                }
                $akta_upload = Storage::putFile('/student-files/akta', new File($request->file('akta')));
                $student->files()->create([
                    'file_name' => $akta_upload,
                    'file_type' => 'akta',
                    'original_file_name' => $request->file('akta')->getClientOriginalName()
                ]);
            }
        }

        // kip
        if (!$kip) {
            if ($request->hasFile('kip')) {
                $request->validate([
                    'kip' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                $kip_upload = Storage::putFile('/student-files/kip', new File($request->file('kip')));
                $student->files()->create([
                    'file_name' => $kip_upload,
                    'file_type' => 'kip',
                    'original_file_name' => $request->file('kip')->getClientOriginalName()
                ]);
            }
        } else {
            if ($request->hasFile('kip')) {
                $request->validate([
                    'kip' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                if (Storage::exists($kip->file_name)) {
                    Storage::delete($kip->file_name);
                }
                DB::beginTransaction();
                try {
                    $kip->delete();
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollBack();
                }

                $kip_upload = Storage::putFile('/student-files/kip', new File($request->file('kip')));
                $student->files()->create([
                    'file_name' => $kip_upload,
                    'file_type' => 'kip',
                    'original_file_name' => $request->file('kip')->getClientOriginalName()
                ]);
            }
        }

        // pkh
        if (!$pkh) {
            if ($request->hasFile('pkh')) {
                $request->validate([
                    'pkh' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                $pkh_upload = Storage::putFile('/student-files/pkh', new File($request->file('pkh')));
                $student->files()->create([
                    'file_name' => $pkh_upload,
                    'file_type' => 'pkh',
                    'original_file_name' => $request->file('pkh')->getClientOriginalName()
                ]);
            }
        } else {
            if ($request->hasFile('pkh')) {
                $request->validate([
                    'pkh' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ]);
                if (Storage::exists($pkh->file_name)) {
                    Storage::delete($pkh->file_name);
                }
                DB::beginTransaction();
                try {
                    $pkh->delete();
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollBack();
                }

                $pkh_upload = Storage::putFile('/student-files/pkh', new File($request->file('pkh')));
                $student->files()->create([
                    'file_name' => $pkh_upload,
                    'file_type' => 'pkh',
                    'original_file_name' => $request->file('pkh')->getClientOriginalName()
                ]);
            }
        }

        return back()->with('success', 'Berkas berhasil ter-upload!');
    }
}
