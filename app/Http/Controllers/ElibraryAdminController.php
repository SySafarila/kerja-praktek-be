<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elibrary;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ElibraryAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:elibrary-create')->only(['create', 'store']);
        $this->middleware('can:elibrary-read')->only(['index', 'show']);
        $this->middleware('can:elibrary-update')->only(['edit', 'update']);
        $this->middleware('can:elibrary-delete')->only(['destroy', 'massDestroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Elibrary::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'elibraryadmin.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('elibraryadmin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elibraryadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'foto_buku' => 'required|image|max:2048',
            'jenis_buku' => 'required|in:Kelas 10,Kelas 11,Kelas 12,Makalah,Lainnya',
            'jumlah_buku' => 'nullable|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Upload foto buku
        $imageName = time() . '.' . $request->file('foto_buku')->getClientOriginalExtension();
        $imageDir = 'elibrary-fotobuku';
        $request->file('foto_buku')->storeAs($imageDir, $imageName, 'public');

        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $fileDir = 'elibrary-pdf';
            $request->file('file')->storeAs($fileDir, $fileName, 'public');
        }

        $elibrary = Elibrary::create([
            'nama_buku' => $request->nama_buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'foto_buku' => $imageName,
            'jenis_buku' => $request->jenis_buku,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi,
            'file' => $fileName ?? '',
        ]);

        return redirect()->route('admin.elibrary.index')->with('success', 'Buku Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */

     public function show($id)
     {
         $elibrary = Elibrary::findOrFail($id);

         return view('elibraryadmin.show', compact('elibrary'));
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $elibrary = Elibrary::findOrFail($id);

        return view('elibraryadmin.edit', compact('elibrary'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'jenis_buku' => 'required|in:Kelas 10,Kelas 11,Kelas 12,Makalah,Lainnya',
            'jumlah_buku' => 'nullable|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        $elibrary = Elibrary::findOrFail($id);

        if ($request->hasFile('foto_buku')) {
            $request->validate([
                'foto_buku' => ['required', 'image', 'max:2048']
            ]);

            $imageName = time() . '.' . $request->file('foto_buku')->getClientOriginalExtension();
            $imageDir = 'elibrary-fotobuku';
            $request->file('foto_buku')->storeAs($imageDir, $imageName, 'public');
            if (Storage::disk('public')->exists($imageDir . '/' . $elibrary->foto_buku)) {
                Storage::disk('public')->delete($imageDir . '/' . $elibrary->foto_buku);
            }
            $elibrary->foto_buku = $imageName;
        }

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => ['nullable', 'mimes:pdf', 'max:2048']
            ]);

            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $fileDir = 'elibrary-pdf';
            $request->file('file')->storeAs($fileDir, $fileName, 'public');
            if (Storage::disk('public')->exists($fileDir . '/' . $elibrary->file)) {
                Storage::disk('public')->delete($fileDir . '/' . $elibrary->file);
            }
            $elibrary->file = $fileName;
        }

        $elibrary->update([
            'nama_buku' => $request->nama_buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'jenis_buku' => $request->jenis_buku,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.elibrary.index')->with('success', 'Buku Berhasil di Perbarui');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        //
        $elibrary = Elibrary::findOrFail($id);
        $elibrary->delete();

        if (Storage::disk('public')->exists('elibrary-fotobuku/'.$elibrary->foto_buku)) {
            Storage::disk('public')->delete('elibrary-fotobuku/'.$elibrary->foto_buku);
        }

        if (Storage::disk('public')->exists('elibrary-pdf/'.$elibrary->file)) {
            Storage::disk('public')->delete('elibrary-pdf/'.$elibrary->file);
        }

        if (request()->ajax()) {
            return response()->json(true);
        }

        return redirect()->route('admin.elibrary.index')->with('error', 'A book has been removed !');
    }

    public function massDestroy(Request $request)
    {

    $elibraryId = explode(',', $request->ids);

    $elibrary = Elibrary::whereIn('id', $elibraryId)->get();

    foreach ($elibrary as $item) {
        $item->delete();


        if (Storage::disk('public')->exists('elibrary-fotobuku/'.$item->foto_buku)) {
            Storage::disk('public')->delete('elibrary-fotobuku/'.$item->foto_buku);
        }

        if (Storage::disk('public')->exists('elibrary-pdf/'.$item->file)) {
            Storage::disk('public')->delete('elibrary-pdf/'.$item->file);
        }
    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.elibrary.index')->with('status', 'Bulk delete success');
    }



}
