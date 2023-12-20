<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elibrary;
use App\Models\Peminjaman;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ElibraryAdminPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('can:peminjaman-create')->only(['create', 'store']);
         $this->middleware('can:peminjaman-read')->only(['index', 'show']);
         $this->middleware('can:peminjaman-update')->only(['edit', 'update']);
         $this->middleware('can:peminjaman-delete')->only(['destroy', 'massDestroy']);
     }
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Peminjaman::query())
                ->addColumn('created_at', function ($model) {
                    return $model->created_at->diffForHumans();
                })
                ->addColumn('options', 'elibraryadminpeminjaman.datatables.options')
                ->setRowAttr([
                    'data-model-id' => function ($model) {
                        return $model->id;
                    }
                ])
                ->rawColumns(['options'])
                ->toJson();
        }

        return view('elibraryadminpeminjaman.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Elibrary::all();
        return view('elibraryadminpeminjaman.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'book_id' => 'required|exists:elibrary,id',
            'jenis' => 'required|in:Kelas 10,Kelas 11,Kelas 12,Makalah,Lainnya',
            'jumlah' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date|max:255',

        ]);

        $peminjaman = Peminjaman::create([
            'nama' => $request->nama,
            'book_id' => $request->book_id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,

        ]);

        return redirect()->route('admin.elibraryadminpeminjaman.index')->with('success', 'Data Peminjaman Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $peminjaman = Peminjaman::find($id);

    //     return view('elibraryadminpeminjaman.show', compact('peminjaman'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Peminjaman::findOrFail($id);

        return view('elibraryadminpeminjaman.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'book_id' => 'required|exists:elibrary,id',
            'jenis' => 'required|in:Kelas 10,Kelas 11,Kelas 12,Makalah,Lainnya',
            'jumlah' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date|max:255',
        ]);

        $peminjaman->update([
            'nama' => $request->nama,
            'book_id' => $request->book_id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
        ]);

        return redirect()->route('admin.elibraryadminpeminjaman.index')->with('success', 'Data Berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $elibrary = Peminjaman::findOrFail($id);
        $elibrary->delete();

        return redirect()->route('admin.elibraryadminpeminjaman.index')->with('error', 'Data Sudah Dihapus');
    }


    public function massDestroy(Request $request)
    {
        $peminjamanIds = explode(',', $request->ids);

    // Fetch all subjects to be deleted
    $peminjamans = Peminjaman::whereIn('id', $peminjamanIds)->get();

    foreach ($peminjamans as $peminjaman) {
        // Delete the subject and associated image if it exists
        $peminjaman->delete();

    }

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.elibraryadminpeminjaman.index')->with('status', 'Bulk delete success');
    }
}
