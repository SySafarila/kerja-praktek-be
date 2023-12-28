<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elibrary;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ElibraryController extends Controller
{

    public function index()
    {
        $elibraries = Elibrary::all();
        return view('elibrary.index', compact('elibraries'));
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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        // Mendapatkan buku sesuai dengan ID yang diberikan
    $elibrary = Elibrary::findOrFail($id);

    // Mendapatkan beberapa buku terbaru (kecuali buku yang sedang ditampilkan)
    $latestBooks = Elibrary::where('id', '!=', $id)->orderBy('created_at', 'desc')->take(6)->get();

    return view('elibrary.show', compact('elibrary', 'latestBooks'));
    }

    public function list(string $jenis_buku)
    {
        $elibraries = Elibrary::where('jenis_buku', $jenis_buku)->orderBy('created_at', 'desc')->paginate(12);

        return view('elibrary.list', compact('elibraries'));
    }





    // public function list(string $jenis_buku)
    // {
    //     $elibraries = Elibrary::where('jenis_buku', $jenis_buku)->get();

    //     return view('elibrary.list', compact('elibraries'));
    // }

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
