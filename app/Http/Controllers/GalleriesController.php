<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Gallery::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'galleries.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }
        return view('galleries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'images' => 'nullable|max:3',
            'images.*' => 'image|max:2048',
        ], [
            'images.max' => 'You can only upload a maximum of 3 images.',
        ]);

        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Upload and store the thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $thumbnailDir = 'galleryThumbnails';
            $request->file('thumbnail')->storeAs($thumbnailDir, $thumbnailName, 'public');
            $gallery->thumbnail = $thumbnailName;
            $gallery->save();
        }

        // Upload and store the gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $imageDir = 'galleryImages';
                $image->storeAs($imageDir, $imageName, 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'images' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery created successfully');

    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $gallery = Gallery::findOrFail($id);
        $galleryImages = GalleryImage::all();

        // You can pass the $gallery and $galleryImages variables to the view or perform other actions as needed

        return view('galleries.edit', compact('gallery', 'galleryImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'thumbnail' => 'nullable|image|max:2048',
        'images' => 'nullable|max:3',
        'images.*' => 'image|max:2048',
    ], [
        'images.max' => 'You can only upload a maximum of 3 images.',
    ]);

    // Retrieve the gallery record from the database
    $gallery = Gallery::findOrFail($id);

    // Update the gallery instance with the validated data
    $gallery->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    // Check if a new thumbnail was provided and update it
    if ($request->hasFile('thumbnail')) {
        $thumbnailName = time() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnailDir = 'galleryThumbnails';

        $request->file('thumbnail')->storeAs($thumbnailDir, $thumbnailName, 'public');

        // Delete the old thumbnail
        if (Storage::disk('public')->exists($thumbnailDir . '/' . $gallery->thumbnail)) {
            Storage::disk('public')->delete($thumbnailDir . '/' . $gallery->thumbnail);
        }

        // Update the thumbnail path in the database
        $gallery->thumbnail = $thumbnailName;
        $gallery->save();
    }

    if ($request->hasFile('images')) {
        $imageDir = 'galleryImages';

        // Delete existing images
        foreach ($gallery->images as $image) {
            if (Storage::disk('public')->exists($imageDir . '/' . $image->images)) {
                Storage::disk('public')->delete($imageDir . '/' . $image->images);
            }
            $image->delete();
        }

        // Upload and store new images
        foreach ($request->file('images') as $imageFile) {
            $randomString = Str::random(10);
            $imageName = $randomString . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs($imageDir, $imageName, 'public');
            $gallery->images()->create(['images' => $imageName]);
        }
    }


    // Redirect to a success page or show a success message
    return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        foreach ($gallery->images as $image) {
            if (Storage::disk('public')->exists('galleryImages/' . $image->images)) {
                Storage::disk('public')->delete('galleryImages/' . $image->images);
            }
            $image->delete();
        }

        if (Storage::disk('public')->exists('galleryThumbnails/' . $gallery->thumbnail)) {
            Storage::disk('public')->delete('galleryThumbnails/' . $gallery->thumbnail);
        }
        $gallery->delete();

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.galleries.index')->with('error', 'Gallery deleted !');
    }

    public function massDestroy(Request $request)
    {
        $galleryIds = explode(',', $request->ids);

        foreach ($galleryIds as $galleryId) {
            $gallery = Gallery::findOrFail($galleryId);

            // Delete associated gallery images
            foreach ($gallery->images as $image) {
                if (Storage::disk('public')->exists('galleryImages/' . $image->images)) {
                    Storage::disk('public')->delete('galleryImages/' . $image->images);
                }
                $image->delete();
            }

            // Delete the gallery thumbnail
            if (Storage::disk('public')->exists('galleryThumbnails/' . $gallery->thumbnail)) {
                Storage::disk('public')->delete('galleryThumbnails/' . $gallery->thumbnail);
            }

            // Delete the gallery
            $gallery->delete();
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.galleries.index')->with('error', 'Gallery deleted !');
    }


    }

