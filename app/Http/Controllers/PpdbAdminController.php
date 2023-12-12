<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PpdbAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ppdb-create')->only(['create', 'store']);
        $this->middleware('can:ppdb-read')->only('index');
        $this->middleware('can:ppdb-update')->only(['edit', 'update', 'confirm_offline_payment']);
        $this->middleware('can:ppdb-delete')->only(['destroy', 'massDestroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Student::with(['parent', 'transaction']);

            if (request()->payment == 'pending') {
                $model->whereRelation('transaction', 'transaction_status', '=', 'pending');
            }
            if (request()->payment == 'settlement') {
                $model->whereRelation('transaction', 'transaction_status', '=', 'settlement');
            }
            if (request()->payment == 'expire') {
                $model->whereRelation('transaction', 'transaction_status', '=', 'expire');
            }

            return DataTables::of($model)
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'ppdb.datatables.options')
                ->editColumn('gender', function ($model) {
                    return $model->gender == 'male' ? 'L' : 'P';
                })
                ->editColumn('transaction.transaction_status', function ($model) {
                    switch (@$model->transaction->transaction_status) {
                        case 'pending':
                            return 'Pending';
                            break;

                        case 'settlement':
                            return 'Lunas';
                            break;

                        case 'expire':
                            return 'Kadaluarsa';
                            break;

                        default:
                            return '-';
                            break;
                    }
                })
                ->editColumn('birth', function ($model) {
                    return "$model->birth_place - " . Carbon::parse($model->birth_date)->format('d-m-Y');
                })
                ->editColumn('created_at', function ($model) {
                    return $model->created_at->tz('Asia/Jakarta')->format('H:i/d-m-Y');
                })
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('ppdb.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ppdb.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name', 'max:255']
        ]);

        Student::create([
            'name' => $request->name
        ]);

        return redirect()->route('ppdb.index')->with('status', 'Permission created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::with('parent', 'files')->findOrFail($id);
        // return $student;

        return view('ppdb.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'parent.email' => ['required', 'email', 'max:255']
        ]);

        $user = Student::findOrFail($id)->user;
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
            return redirect()->route('admin.ppdb.index')->with('error', 'Tidak dapat memperbarui data PPDB');
        }

        return redirect()->route('admin.ppdb.index')->with('success', 'Data PPDB berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('ppdb.index')->with('status', 'Permission deleted !');
    }

    public function massDestroy(Request $request)
    {
        $arr = explode(',', $request->ids);

        // foreach ($arr as $data) {
        // Student::destroy($data);
        // }

        Student::destroy($arr);

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('ppdb.index')->with('status', 'Bulk delete success');
    }

    function confirm_offline_payment($student_id)
    {
        $student = Student::with('user.transaction')->findOrFail($student_id);
        $transaction = $student->user->transaction;

        if ($transaction->payment_method == 'offline' && $transaction->transaction_status == 'pending') {
            $transaction->update([
                'transaction_status' => 'settlement',
                'settlement_time' => now()
            ]);

            return back()->with('success', "Pembayaran PPDB untuk $student->full_name berhasil dikonfirmasi");
        }
        return back()->with('warning', 'Pembayaran tidak dapat dikonfirmasi');
    }
}
