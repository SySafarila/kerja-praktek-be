<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    private $image_path = 'blogs/';
    private $disk = 'public';

    public function __construct()
    {
        $this->middleware('can:blogs-create')->only(['create', 'store']);
        $this->middleware('can:blogs-read')->only(['index', 'show']);
        $this->middleware('can:blogs-update')->only(['edit', 'update']);
        $this->middleware('can:blogs-delete')->only(['destroy', 'massDestroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Blog::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'blogs.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        $body = $request->body;

        $body = $this->process_html_upload($body);

        $blog = Blog::create([
            'title' => $request->title,
            'body' => $body,
            'slug' => 'slug'
        ]);

        $slug = Str::of($request->title)->slug('-');

        $blog->update([
            'slug' => $slug
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog uploaded !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', compact('blog'));
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
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        $blog = Blog::findOrFail($id);

        $oldImages = [];
        $newImages = [];

        // start old images sorting
        $body = $blog->body;
        $oldImages = $this->images_sorting($body);
        // end old images sorting

        // start new images sorting
        $body2 = $request->body;
        $newImages = $this->images_sorting($body2);
        // end new images sorting

        // start unset $oldImages if new images appear in old images
        foreach ($newImages as $image) {
            if (($key = array_search($image, $oldImages)) !== false) {
                unset($oldImages[$key]);
            }
        }
        // end unset $oldImages if new images appear in old images

        // start upload new images
        $body3 = $request->body;
        $body3 = $this->process_html_upload($body3);
        // end upload new images

        // delete unused images
        foreach ($oldImages as $image) {
            // Storage::delete($this->image_path . $image);
            $delete_unused_images[] = $this->image_path . $image;
        }

        if (@$delete_unused_images && count($delete_unused_images) > 0) {
            Storage::disk($this->disk)->delete(@$delete_unused_images);
        }
        // end delete unused images

        $slug = Str::of($request->title)->slug('-');

        $blog->update([
            'title' => $request->title,
            'body' => $body3,
            'slug' => $slug
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $body = $blog->body;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, $this->image_path)) {
                    $imageName = explode($this->image_path, $data)[1];

                    $images_will_deleted[] = $this->image_path . $imageName;
                }
            }
        }

        $blog->delete();

        if (@$images_will_deleted && count($images_will_deleted) > 0) {
            Storage::disk($this->disk)->delete(@$images_will_deleted);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted !');
    }

    public function massDestroy(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $id) {
            $blog = Blog::find($id);

            if ($blog) {
                $body = $blog->body;
                $dom = new DOMDocument();
                @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');

                if ($images->count() >= 1) {
                    foreach ($images as $image) {
                        $data = $image->getAttribute('src');

                        if (str_contains($data, $this->image_path)) {
                            $imageName = explode($this->image_path, $data)[1];

                            $images_will_deleted[] = $this->image_path . $imageName;
                        }
                    }
                }

                $blogs_will_deleted[] = $blog->id;
            }
        }

        Blog::destroy($blogs_will_deleted);

        if (@$images_will_deleted && count($images_will_deleted) > 0) {
            Storage::disk($this->disk)->delete(@$images_will_deleted);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Posts deleted !');
    }

    private function process_html_upload($body)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (Str::startsWith($data, 'data:image')) {
                    $make_image = Image::make($data);
                    $image_ext = explode('/', $make_image->mime())[1];
                    $image_quality = 75;

                    $image_compress = $make_image->encode($image_ext)->resize(720, 576, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $path = $this->image_path;
                    $image_file_name = uniqid() . ".$image_ext";

                    Storage::disk($this->disk)->put(
                        $path . $image_file_name,
                        $image_compress->stream($image_ext, $image_quality),
                        'public'
                    );

                    $image->setAttribute('src', Storage::disk($this->disk)->url($path . $image_file_name));
                }
            }
        }

        $body = $dom->saveHTML();

        return $body;
    }

    private function images_sorting($body)
    {
        $sorted_array = [];
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, $this->image_path)) {
                    $imageName = explode($this->image_path, $data)[1];

                    array_push($sorted_array, $imageName);
                }
            }
        }

        return $sorted_array;
    }
}
