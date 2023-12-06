<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\Teacher;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ExtracurricularsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:extracurriculars-create')->only(['create', 'store']);
        $this->middleware('can:extracurriculars-read')->only(['index', 'show']);
        $this->middleware('can:extracurriculars-update')->only(['edit', 'update']);
        $this->middleware('can:extracurriculars-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Extracurricular::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'extracurriculars.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        $extracurriculars = Extracurricular::all();
        return view('extracurriculars.index', compact('extracurriculars'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('extracurriculars.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'schedule' => 'required|array|min:1', // Ensure at least one day is selected
            'schedule.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Validate each day
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'mentor_id' => 'nullable|integer|exists:teachers,id',
        ]);

        // Upload and store the image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageDir = 'extracurricularImages'; // Adjust the image directory path
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        // Create a new extracurricular instance
        $extracurricular = Extracurricular::create([
        'name' => $request->name,
        'image' => $imageName,
        'schedule' => json_encode($request->input('schedule')), // Assuming schedule is stored as JSON
        'location' => $request->location,
        'description' => $request->description,
        'mentor_id' => $request->mentor_id,
        ]);

        // Redirect to a success page or show a success message
        return redirect()->route('admin.extracurriculars.index')->with('success', 'Extracurricular added successfully');
    }

    public function edit($id)
    {
        // Retrieve the extracurricular record from the database
        $extracurricular = Extracurricular::findOrFail($id);
        $mentors = Teacher::all();

        // Pass the $extracurricular variable to the view
        return view('extracurriculars.edit', compact('extracurricular', 'mentors'));
    }

    public function update(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'schedule' => 'required|array',
        'schedule.*' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        'location' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'mentor_id' => 'nullable|integer|exists:teachers,id',
    ]);

    $extracurricular = Extracurricular::findOrFail($id);

    // Check if a new image was provided and update it
    if ($request->hasFile('image')) {
        $request->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        // Upload and store the new image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageDir = 'extracurricularImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');
        if (Storage::disk('public')->exists($imageDir . '/' . $extracurricular->image)) {
            Storage::disk('public')->delete($imageDir . '/' . $extracurricular->image);
        }
        // Update the image path in the database
        $extracurricular->image = $imageName;
    }

    // Update the extracurricular instance with the validated data
    $extracurricular->update([
        'name' => $request->name,
        'schedule' => json_encode($request->input('schedule')),
        'location' => $request->location,
        'description' => $request->description,
        'mentor_id' => $request->mentor_id,
    ]);

    // Redirect to a success page or show a success message
    return redirect()->route('admin.extracurriculars.index')->with('success', 'An Extracurricular updated successfully');
}

public function destroy($id)
{
    $extracurricular = Extracurricular::findOrFail($id);
    $extracurricular->delete();

    // Delete associated image if it exists
    if (Storage::disk('public')->exists('extracurricularImages/' . $extracurricular->image)) {
        Storage::disk('public')->delete('extracurricularImages/' . $extracurricular->image);
    }

    if (request()->ajax()) {
        return response()->json(true);
    }

    return redirect()->route('admin.extracurriculars.index')->with('error', 'An Extracurricular has been removed!');
}

public function massDestroy(Request $request)
{
    $extracurricularIds = explode(',', $request->ids);

    // Fetch all extracurriculars to be deleted
    $extracurriculars = Extracurricular::whereIn('id', $extracurricularIds)->get();

    foreach ($extracurriculars as $extracurricular) {
        // Delete the extracurricular and associated image if it exists
        $extracurricular->delete();

        if (Storage::disk('public')->exists('extracurricularImages/' . $extracurricular->image)) {
            Storage::disk('public')->delete('extracurricularImages/' . $extracurricular->image);
        }
    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.extracurriculars.index')->with('status', 'Bulk delete success');
}
}
