<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:subjects-create')->only(['create', 'store']);
        $this->middleware('can:subjects-read')->only(['index', 'show']);
        $this->middleware('can:subjects-update')->only(['edit', 'update']);
        $this->middleware('can:subjects-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Subject::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'subjects.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('subjects.index');
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|in:10,11,12',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'grade' => $request->grade,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'A Subject added successfully');
    }

    public function edit($id)
{
    // Retrieve the subject record from the database
    $subject = Subject::findOrFail($id);

    // Pass the $subject variable to the view
    return view('subjects.edit', compact('subject'));
}

    public function update(Request $request, $id)
    {
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'grade' => 'required|in:10,11,12',
    ]);

    $subject = Subject::findOrFail($id);

    // Update the subject instance with the validated data
    $subject->update([
        'name' => $request->name,
        'grade' => $request->grade,
    ]);

    // Redirect to a success page or show a success message
    return redirect()->route('admin.subjects.index')->with('success', 'A Subject updated successfully');
    }

    public function destroy($id)
    {
        //
        $subjects = Subject::findOrFail($id);
        $subjects->delete();

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.subjects.index')->with('error', 'A Subject has been removed !');
    }

    public function massDestroy(Request $request)
{
    $subjectIds = explode(',', $request->ids);

    // Fetch all subjects to be deleted
    $subjects = Subject::whereIn('id', $subjectIds)->get();

    foreach ($subjects as $subject) {
        // Delete the subject and associated image if it exists
        $subject->delete();

    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.subjects.index')->with('status', 'Bulk delete success');
}
}

