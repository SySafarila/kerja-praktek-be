<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PpdbAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ppdb-create')->only(['create', 'store']);
        $this->middleware('can:ppdb-read')->only('index');
        $this->middleware('can:ppdb-update')->only(['edit', 'update']);
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
            return DataTables::of(Student::query()->with('user.transaction', 'parent'))
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'ppdb.datatables.options')
                ->editColumn('gender', function($model) {
                    return $model->gender == 'male' ? 'L' : 'P';
                })
                ->editColumn('payment', function($model) {
                    switch ($model->user->transaction->transaction_status) {
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
                ->editColumn('birth', function($model) {
                    return "$model->birth_place - " . Carbon::parse($model->birth_date)->format('d-m-Y');
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
        return 'in progress';
        $permission = Student::findById($id);

        return view('ppdb.edit', compact('permission'));
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
        return 'in progress';
        $request->validate([
            'name' => ['required', 'string', Rule::unique('permissions')->ignore($id), 'max:255']
        ]);

        $permission = Student::findById($id);
        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('ppdb.index')->with('status', 'Permission updated !');
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
}
