<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PpdbAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ppdb-create')->only(['create', 'store']);
        $this->middleware('can:ppdb-read')->only(['index', 'download_private_file', 'archive']);
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
            $model = Student::with(['parent', 'transaction', 'files']);

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
                ->editColumn('religion', function($model) {
                    return Str::headline($model->religion);
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
            'student.nisn' => ['required', 'numeric', 'digits:10'],
            'student.full_name' => ['required', 'string', 'max:255'],
            'student.gender' => ['required', 'string', 'in:male,female'],
            'student.birth_place' => ['required', 'string', 'max:255'],
            'student.birth_date' => ['required', 'date'],
            'student.religion' => ['required', 'string', 'max:255', 'in:islam,kristen_protestan,kristen_katolik,hindu,buddha,khonghucu'],
            'student.address' => ['required', 'string'],
            'student.whatsapp' => ['required', 'numeric', 'max_digits:255'],
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
            'parent.whatsapp' => ['required', 'numeric', 'max_digits:255'],
            'parent.email' => ['required', 'email', 'max:255']
        ], [
            'student.nisn' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
                'digits' => 'NISN harus 10 digit.'
            ],
            'student.full_name' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'max' => 'Maksimal 255 huruf.'
            ],
            'student.gender' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'in' => 'Pilihan diantara Laki-Laki/Perempuan.'
            ],
            'student.birth_place' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'max' => 'Maksimal 255 huruf.'
            ],
            'student.birth_date' => [
                'required' => 'Diperlukan.',
                'date' => 'Harus berupa tanggal.',
            ],
            'student.religion' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'max' => 'Maksimal 255 huruf.',
                'in' => 'Pilihan diantara Islam/Kristen Protestan/Kristen Katolik/Hindu/Buddha/Khonghucu.'
            ],
            'student.address' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.'
            ],
            'student.whatsapp' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
                'max_digits' => 'Maksimal 255 digit'
            ],
            'student.email' => [
                'required' => 'Diperlukan.',
                'email' => 'Harus berupa email yang valid.',
                'max' => 'Maksimal 255 huruf.'
            ],
            'student.last_school' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'max' => 'Maksimal 255 huruf.'
            ],
            'student.org_experience' => [
                'string' => 'Harus berupa huruf.'
            ],
            'student.height' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
            ],
            'student.weight' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
            ],
            'student.history_illness' => [
                'string' => 'Harus berupa huruf.'
            ],
            'parent.full_name' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'max' => 'Maksimal 255 huruf.'
            ],
            'parent.gender' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.',
                'in' => 'Pilihan diantara Laki-Laki/Perempuan.'
            ],
            'parent.job' => [
                'required' => 'Diperlukan.',
                'string' => 'Harus berupa huruf.'
            ],
            'parent.income_per_month' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
            ],
            'parent.whatsapp' => [
                'required' => 'Diperlukan.',
                'numeric' => 'Harus berupa angka.',
                'max_digits' => 'Maksimal 255 digit'
            ],
            'parent.email' => [
                'required' => 'Diperlukan.',
                'email' => 'Harus berupa email yang valid.',
                'max' => 'Maksimal 255 huruf.'
            ]
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

        // update/upload files
        $request->validate([
            'kk' => ['file', 'max:10240'],
            'akta' => ['file', 'max:10240'],
            'kip' => ['file', 'max:10240', 'nullable'],
            'pkh' => ['file', 'max:10240', 'nullable'],
        ], [
            'kk' => [
                'file' => 'Data yang diupload harus berupa file.',
                'max' => 'Ukuran data maksimal 10MB.'
            ],
            'akta' => [
                'file' => 'Data yang diupload harus berupa file.',
                'max' => 'Ukuran data maksimal 10MB.'
            ],
            'kip' => [
                'file' => 'Data yang diupload harus berupa file.',
                'max' => 'Ukuran data maksimal 10MB.'
            ],
            'pkh' => [
                'file' => 'Data yang diupload harus berupa file.',
                'max' => 'Ukuran data maksimal 10MB.'
            ]
        ]);

        // $user = Auth::user();
        $student = $current_student;

        $kk = $student->files()->where('file_type', 'kk')->first();
        $akta = $student->files()->where('file_type', 'akta')->first();
        $kip = $student->files()->where('file_type', 'kip')->first();
        $pkh = $student->files()->where('file_type', 'pkh')->first();

        // kartu keluarga
        if (!$kk) {
            $request->validate([
                'kk' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
            ], [
                'kk' => [
                    'file' => 'Data yang diupload harus berupa file.',
                    'max' => 'Ukuran data maksimal 10MB.',
                    'required' => 'Diperlukan.',
                    'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                ]
            ]);
            DB::beginTransaction();
            try {
                $kk_upload = Storage::putFile('/student-files/kk', new File($request->file('kk')));
                $student->files()->create([
                    'file_name' => $kk_upload,
                    'file_type' => 'kk',
                    'original_file_name' => $request->file('kk')->getClientOriginalName()
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                Log::error($th->getMessage());
                DB::rollBack();
            }
        } else {
            if ($request->hasFile('kk')) {
                $request->validate([
                    'kk' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'kk' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
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
                    Log::error($th->getMessage());
                    DB::rollBack();
                }

                DB::beginTransaction();
                try {
                    $kk_upload = Storage::putFile('/student-files/kk', new File($request->file('kk')));
                    $student->files()->create([
                        'file_name' => $kk_upload,
                        'file_type' => 'kk',
                        'original_file_name' => $request->file('kk')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
        }

        // akta kelahiran
        if (!$akta) {
            $request->validate([
                'akta' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
            ], [
                'akta' => [
                    'file' => 'Data yang diupload harus berupa file.',
                    'max' => 'Ukuran data maksimal 10MB.',
                    'required' => 'Diperlukan.',
                    'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                ]
            ]);
            DB::beginTransaction();
            try {
                $akta_upload = Storage::putFile('/student-files/akta', new File($request->file('akta')));
                $student->files()->create([
                    'file_name' => $akta_upload,
                    'file_type' => 'akta',
                    'original_file_name' => $request->file('akta')->getClientOriginalName()
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                Log::error($th->getMessage());
                DB::rollBack();
            }
        } else {
            if ($request->hasFile('akta')) {
                $request->validate([
                    'akta' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'akta' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
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
                    Log::error($th->getMessage());
                    DB::rollBack();
                }

                DB::beginTransaction();
                try {
                    $akta_upload = Storage::putFile('/student-files/akta', new File($request->file('akta')));
                    $student->files()->create([
                        'file_name' => $akta_upload,
                        'file_type' => 'akta',
                        'original_file_name' => $request->file('akta')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
        }

        // kip
        if (!$kip) {
            if ($request->hasFile('kip')) {
                $request->validate([
                    'kip' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'kip' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
                ]);
                DB::beginTransaction();
                try {
                    $kip_upload = Storage::putFile('/student-files/kip', new File($request->file('kip')));
                    $student->files()->create([
                        'file_name' => $kip_upload,
                        'file_type' => 'kip',
                        'original_file_name' => $request->file('kip')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
        } else {
            if ($request->hasFile('kip')) {
                $request->validate([
                    'kip' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'kip' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
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
                    Log::error($th->getMessage());
                    DB::rollBack();
                }

                DB::beginTransaction();
                try {
                    $kip_upload = Storage::putFile('/student-files/kip', new File($request->file('kip')));
                    $student->files()->create([
                        'file_name' => $kip_upload,
                        'file_type' => 'kip',
                        'original_file_name' => $request->file('kip')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
        }

        // pkh
        if (!$pkh) {
            if ($request->hasFile('pkh')) {
                $request->validate([
                    'pkh' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'pkh' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
                ]);
                DB::beginTransaction();
                try {
                    $pkh_upload = Storage::putFile('/student-files/pkh', new File($request->file('pkh')));
                    $student->files()->create([
                        'file_name' => $pkh_upload,
                        'file_type' => 'pkh',
                        'original_file_name' => $request->file('pkh')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
        } else {
            if ($request->hasFile('pkh')) {
                $request->validate([
                    'pkh' => ['file', 'max:10240', 'required', 'mimetypes:application/pdf,image/*']
                ], [
                    'pkh' => [
                        'file' => 'Data yang diupload harus berupa file.',
                        'max' => 'Ukuran data maksimal 10MB.',
                        'required' => 'Diperlukan.',
                        'mimetypes' => 'Data yang di upload harus berupa Gambar/PDF'
                    ]
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
                    Log::error($th->getMessage());
                    DB::rollBack();
                }

                DB::beginTransaction();
                try {
                    $pkh_upload = Storage::putFile('/student-files/pkh', new File($request->file('pkh')));
                    $student->files()->create([
                        'file_name' => $pkh_upload,
                        'file_type' => 'pkh',
                        'original_file_name' => $request->file('pkh')->getClientOriginalName()
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::error($th->getMessage());
                    DB::rollBack();
                }
            }
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

    public function download_private_file(Request $request)
    {
        $file_path = $request->file_path;
        if (Storage::exists($file_path)) {
            $path = Storage::download($file_path);
            return $path;
        }
        return abort(404);
    }

    public function archive($student_id) {
        $student = Student::with(['parent', 'transaction', 'files'])->findOrFail($student_id);
        return view('ppdb.archive', compact('student'));
    }
}
