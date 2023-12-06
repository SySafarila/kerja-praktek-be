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

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Extracurricular::query())
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
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
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
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
