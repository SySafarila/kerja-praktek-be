<?php

namespace App\Http\Controllers;

use App\Models\Article;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:articles-create')->only(['create', 'store']);
        $this->middleware('can:articles-read')->only(['index', 'show']);
        $this->middleware('can:articles-update')->only(['edit', 'update']);
        $this->middleware('can:articles-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {

        if (request()->ajax()) {
            return DataTables::of(Article::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'articles.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }
        return view('articles.index');
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'story' => 'required|string',
        ]);

        // Upload and store the image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        // Adjust the image directory path according to your actual storage path
        $imageDir = 'articleImages';
        $request->file('image')->storeAs($imageDir, $imageName, 'public');

        // Create a new article instance
        $article = Article::create([
            'title' => $request->title,
            'image' => $imageName,
            'story' => $request->story,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully!');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'required|string',
        ]);

        $article = Article::findOrFail($id);


        // Check if a new image was provided and update it
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max:2048']
            ]);

            // Upload and store the new image
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imageDir = 'articleImages';
            $request->file('image')->storeAs($imageDir, $imageName, 'public');
            if (Storage::disk('public')->exists($imageDir . '/' . $article->image)) {
                Storage::disk('public')->delete($imageDir . '/' . $article->image);
            }
            // Update the image path in the database
            $article->image = $imageName;
        }

        $article->update([
            'title' => $request->title,
            'story' => $request->story,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if (Storage::disk('public')->exists('articleImages/' . $article->image)) {
            Storage::disk('public')->delete('articleImages/' . $article->image);
        }

        $article->delete();

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }

    public function massDestroy(Request $request)
    {
        $articles = explode(',', $request->ids);

        // Fetch all articles to be deleted
        $articles = Article::whereIn('id', $articles)->get();

        foreach ($articles as $article) {
            // Delete the article and associated image if it exists
            $article->delete();

            if (Storage::disk('public')->exists('articleImages/'.$article->image)) {
                Storage::disk('public')->delete('articleImages/'.$article->image);
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.articles.index')->with('status', 'Bulk delete success');
    }
}
