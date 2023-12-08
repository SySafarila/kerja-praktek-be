<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class TestimonialController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:testimonials-create')->only(['create', 'store']);
        $this->middleware('can:testimonials-read')->only(['index', 'show']);
        $this->middleware('can:testimonials-update')->only(['edit', 'update']);
        $this->middleware('can:testimonials-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Testimonial::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'testimonials.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('testimonials.index');
    }

    public function create()
    {
        return view('testimonials.create',);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'feedback' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        // Upload and store the image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        // Adjust the image directory path according to your actual storage path
        $imageDir = 'testimonialImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        // Create a new testimonial instance
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'status' => $request->status,
            'feedback' => $request->feedback,
            'image' => $imageName,
        ]);

        // Redirect to a success page or show a success message
        return redirect()->route('admin.testimonials.index')->with('success', 'Staff member created successfully');
    }
    public function edit($id)
    {
        // Retrieve the testimonial by ID
        $testimonial = Testimonial::findOrFail($id);

        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'feedback' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Retrieve the testimonial by ID
        $testimonial = Testimonial::findOrFail($id);

        // Update testimonial data
        $testimonial->name = $request->name;
        $testimonial->status = $request->status;
        $testimonial->feedback = $request->feedback;

        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Upload and store the new image
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imageDir = 'testimonialImages';
            $request->file('image')->storeAs($imageDir, $imageName, 'public');

            // Delete the old image if it exists
            if ($testimonial->image && Storage::disk('public')->exists($imageDir . '/' . $testimonial->image)) {
                Storage::disk('public')->delete($imageDir . '/' . $testimonial->image);
            }

            // Update the testimonial image
            $testimonial->image = $imageName;
        }

        // Save the updated testimonial
        $testimonial->save();

        // Redirect to a success page or show a success message
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        //
        $testimonials = Testimonial::findOrFail($id);
        $testimonials->delete();

        if (Storage::disk('public')->exists('testimonialImages/'.$testimonials->image)) {
            Storage::disk('public')->delete('testimonialImages/'.$testimonials->image);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.testimonials.index')->with('error', 'A Testimony has been removed !');
    }

    public function massDestroy(Request $request)
{
    $testimonialIds = explode(',', $request->ids);

    // Fetch all testimonials to be deleted
    $testimonials = Testimonial::whereIn('id', $testimonialIds)->get();

    foreach ($testimonials as $testimonial) {
        // Delete the testimonial and associated image if it exists
        $testimonial->delete();

        if (Storage::disk('public')->exists('testimonialImages/'.$testimonial->image)) {
            Storage::disk('public')->delete('testimonialImages/'.$testimonial->image);
        }
    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.testimonials.index')->with('status', 'Bulk delete success');
}

}
