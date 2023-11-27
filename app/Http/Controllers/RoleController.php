<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles-create')->only(['create', 'store']);
        $this->middleware('can:roles-read')->only('index');
        $this->middleware('can:roles-update')->only(['update', 'edit']);
        $this->middleware('can:roles-delete')->only(['destroy', 'massDestroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Role::query()->with('permissions'))
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('permissions', 'admin.roles.datatables.permissions')
                ->addColumn('options', 'admin.roles.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options', 'permissions'])
                ->toJson();
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get()->groupBy(function ($q) {
            return explode('-', $q->name)[0];
        });

        return view('admin.roles.create', compact('permissions'));
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
            'name' => ['required', 'string', 'unique:roles,name', 'max:255'],
            'permissions.*' => ['string', 'exists:permissions,name']
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('status', 'Role created !');
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
        $role = Role::findById($id);
        $permissions = Permission::orderBy('name')->get()->groupBy(function ($q) {
            return explode('-', $q->name)[0];
        });

        return view('admin.roles.edit', compact('role', 'permissions'));
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
            'name' => ['required', 'string', Rule::unique('roles')->ignore($id), 'max:255'],
            'permissions.*' => ['string', 'exists:permissions,name']
        ]);

        $role = Role::findById($id);

        if ($role->name == 'super admin') {
            return redirect()->route('admin.roles.index')->with('status-warning', 'You cannot update this role !');
        }

        $role->update([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('status', 'Role updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);

        if ($role->name == 'super admin') {
            // return redirect()->route('admin.roles.index')->with('status-warning', 'You cannot delete this role !');
            return response()->json('You cannot delete this role !', 403);
        }

        Role::destroy($id);

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.roles.index')->with('status', 'Role deleted !');
    }

    public function massDestroy(Request $request)
    {
        $arr = explode(',', $request->ids);
        $willDeleted = [];

        foreach ($arr as $data) {
            $role = Role::findById($data);
            if ($role->name != 'super admin') {
                // $role->delete();
                array_push($willDeleted, $role->id);
            }
        }

        Role::destroy($willDeleted);

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.roles.index')->with('status', 'Bulk delete success');
    }
}
