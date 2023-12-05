<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:staffs-create')->only(['create', 'store']);
        $this->middleware('can:staffs-read')->only(['index', 'show']);
        $this->middleware('can:staffs-update')->only(['edit', 'update']);
        $this->middleware('can:staffs-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Staff::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'staffs.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('staffs.index');
    }

    public function create()
    {
        return view('staffs.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'position' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255',
            'nuptk' => 'nullable|string|max:255',
        ]);

        // Upload and store the image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        // Adjust the image directory path according to your actual storage path
        $imageDir = 'staffImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        // Create a new staff instance
        $staff = Staff::create([
            'name' => $request->name,
            'image' => $imageName,
            'position' => $request->position,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
        ]);

        // Redirect to a success page or show a success message
        return redirect()->route('admin.staffs.index')->with('success', 'Staff member created successfully');
    }

    public function edit($id)
{
    // Retrieve the staff record from the database
    $staff = Staff::findOrFail($id);

    // Pass the $staff variable to the view
    return view('staffs.edit', compact('staff'));
}

    public function update(Request $request, $id)
    {
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'nip' => 'nullable|string|max:255',
        'nuptk' => 'nullable|string|max:255',
    ]);

    $staff = Staff::findOrFail($id);

        // Check if a new image was provided and update it
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max:2048']
            ]);

            // Upload and store the new image
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imageDir = 'staffImages';
            $request->file('image')->storeAs($imageDir, $imageName, 'public');
            if (Storage::disk('public')->exists($imageDir . '/' . $staff->image)) {
                Storage::disk('public')->delete($imageDir . '/' . $staff->image);
            }
            // Update the image path in the database
            $staff->image = $imageName;
        }

    // Update the staff instance with the validated data
    $staff->update([
        'name' => $request->name,
        'position' => $request->position,
        'nip' => $request->nip,
        'nuptk' => $request->nuptk,
    ]);

    // Redirect to a success page or show a success message
    return redirect()->route('admin.staffs.index')->with('success', 'Staff member updated successfully');
    }

    public function destroy($id)
    {
        //
        $staffs = Staff::findOrFail($id);
        $staffs->delete();

        if (Storage::disk('public')->exists('staffImages/'.$staffs->image)) {
            Storage::disk('public')->delete('staffImages/'.$staffs->image);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.staffs.index')->with('error', 'A staff has been removed !');
    }

    public function massDestroy(Request $request)
{
    $staffIds = explode(',', $request->ids);

    // Fetch all staffs to be deleted
    $staffs = Staff::whereIn('id', $staffIds)->get();

    foreach ($staffs as $staff) {
        // Delete the staff and associated image if it exists
        $staff->delete();

        if (Storage::disk('public')->exists('staffImages/'.$staff->image)) {
            Storage::disk('public')->delete('staffImages/'.$staff->image);
        }
    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.staffs.index')->with('status', 'Bulk delete success');
}
}

