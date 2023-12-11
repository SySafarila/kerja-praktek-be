<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
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

    $teachers = Teacher::all();
    return view('teachers.index', compact('teachers'));
}

    public function create()
    {
        $subjects = Subject::all();
        $teacher = null;
        return view('teachers.create',compact('subjects','teacher'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'nullable|integer|exists:subjects,id',
            'nip' => 'nullable|string|max:255',
            'nuptk' => 'nullable|string|max:255',
        ]);

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        $imageDir = 'teacherImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        $teacher = Teacher::create([
            'name' => $request->name,
            'image' => $imageName,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
        ]);

    if ($request->has('subject_id')) {
        $teacher->subjects()->sync($request->input('subject_id'));
    }

        return redirect()->route('admin.teachers.index')->with('success', 'A Teacher added successfully');
    }

    public function edit($id)
{
    $teacher = Teacher::findOrFail($id);
    $subjects = Subject::all();

    return view('teachers.edit', compact('teacher','subjects'));
}

    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'subject_id' => 'nullable|array',
        'subject_id.*' => 'nullable|integer|exists:subjects,id',
        'nip' => 'nullable|string|max:255',
        'nuptk' => 'nullable|string|max:255',
    ]);

    $teacher = Teacher::findOrFail($id);

    if ($request->hasFile('image')) {
        $request->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageDir = 'teacherImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');
        if (Storage::disk('public')->exists($imageDir . '/' . $teacher->image)) {
            Storage::disk('public')->delete($imageDir . '/' . $teacher->image);
        }
        $teacher->image = $imageName;
    }

    $teacher->update([
        'name' => $request->name,
        'nip' => $request->nip,
        'nuptk' => $request->nuptk,
    ]);

    if ($request->has('subject_id')) {
        $teacher->subjects()->sync($request->input('subject_id'));
    } else {
        $teacher->subjects()->detach();
    }

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

