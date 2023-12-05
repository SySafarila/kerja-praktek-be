<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:teachers-create')->only(['create', 'store']);
        $this->middleware('can:teachers-read')->only(['index', 'show']);
        $this->middleware('can:teachers-update')->only(['edit', 'update']);
        $this->middleware('can:teachers-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Teacher::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'teachers.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('teachers.index');
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'subject' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255',
            'nuptk' => 'nullable|string|max:255',
        ]);

        // Upload and store the image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        // Adjust the image directory path according to your actual storage path
        $imageDir = 'teacherImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        // Create a new teacher instance
        $teacher = Teacher::create([
            'name' => $request->name,
            'image' => $imageName,
            'subject' => $request->subject,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
        ]);

        // Redirect to a success page or show a success message
        return redirect()->route('admin.teachers.index')->with('success', 'A Teacher added successfully');
    }

    public function edit($id)
{
    // Retrieve the teacher record from the database
    $teacher = Teacher::findOrFail($id);

    // Pass the $teacher variable to the view
    return view('teachers.edit', compact('teacher'));
}

    public function update(Request $request, $id)
    {
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'subject' => 'nullable|string|max:255',
        'nip' => 'nullable|string|max:255',
        'nuptk' => 'nullable|string|max:255',
    ]);

    $teacher = Teacher::findOrFail($id);

    // Check if a new image was provided and update it
    if ($request->hasFile('image')) {
        $request->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        // Upload and store the new image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageDir = 'teacherImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');
        if (Storage::disk('public')->exists($imageDir . '/' . $teacher->image)) {
            Storage::disk('public')->delete($imageDir . '/' . $teacher->image);
        }
        // Update the image path in the database
        $teacher->image = $imageName;
    }

    // Update the teacher instance with the validated data
    $teacher->update([
        'name' => $request->name,
        'subject' => $request->subject,
        'nip' => $request->nip,
        'nuptk' => $request->nuptk,
    ]);

    // Redirect to a success page or show a success message
    return redirect()->route('admin.teachers.index')->with('success', 'A Teacher updated successfully');
    }

    public function destroy($id)
    {
        //
        $teachers = Teacher::findOrFail($id);
        $teachers->delete();

        if (Storage::disk('public')->exists('teacherImages/'.$teachers->image)) {
            Storage::disk('public')->delete('teacherImages/'.$teachers->image);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.teachers.index')->with('error', 'A Teacher has been removed !');
    }

    public function massDestroy(Request $request)
{
    $teacherIds = explode(',', $request->ids);

    // Fetch all teachers to be deleted
    $teachers = Teacher::whereIn('id', $teacherIds)->get();

    foreach ($teachers as $teacher) {
        // Delete the teacher and associated image if it exists
        $teacher->delete();

        if (Storage::disk('public')->exists('teacherImages/'.$teacher->image)) {
            Storage::disk('public')->delete('teacherImages/'.$teacher->image);
        }
    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.teachers.index')->with('status', 'Bulk delete success');
}
}

