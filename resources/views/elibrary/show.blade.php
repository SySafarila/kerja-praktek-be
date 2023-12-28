@extends('layouts.public')
@section('content')


<div class="max-w-screen-lg mx-auto p-5 grid lg:grid-cols-12 gap-5">
    <div class="bg-white lg:col-span-8 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">{{ ucwords($elibrary->nama_buku) }}</h2>
        <div class="mt-5 flex flex-col gap-5">


            <div class="text-center justify-center items-center">
                <img src="{{ asset($elibrary->foto_buku ? 'storage/elibrary-fotobuku/'.$elibrary->foto_buku : 'path/to/default-image.jpg') }}" alt="Buku Cover" class="mx-auto w-[250px] h-[360px] object-cover mb-4 rounded-lg">
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500"><span class="font-semibold">Nama Buku :</span> {{ ucwords($elibrary->nama_buku) }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Ditulis oleh :</span> {{ ucwords($elibrary->penulis) }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Penerbit :</span> {{ ucwords ($elibrary->penerbit) }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Jumlah Buku:</span> {{ $elibrary->jumlah_buku }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Rak :</span> {{ getRakCategory($elibrary->nama_buku) }}</p>

                <p class="text-sm text-gray-500  max-w-[500px]"><span class="font-semibold">Deskripsi Buku : </span>{{ ucfirst($elibrary->deskripsi) }}
                </p>
            </div>
            @if ($elibrary->file)
        <div class="mt-4">
            <a href="{{ asset('storage/elibrary-pdf/' . $elibrary->file) }}" class="bg-lime-500 text-white px-4 py-2 rounded-md" download>
                Download PDF
            </a>
        </div>
    @endif
        </div>
    </div>
    <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Buku Terbaru</h2>
        <div class="flex flex-col gap-3 mt-5">
            @foreach ($latestBooks->take(2) as $book)
                <a href="{{ route('elibrary.show', ['id' => $book->id]) }}" class="max-w-md bg-white p-4 rounded-md shadow-md">
                    <div class="max-w mx-auto bg-white">
                        <div class="content py-4 w-[250px] h-auto rounded overflow-hidden p-2">
                            <div class="relative">
                                <img src="{{ asset($book->foto_buku ? 'storage/elibrary-fotobuku/'.$book->foto_buku : 'path/to/default-image.jpg') }}" alt="" class="w-[150px] h-[220px] object-cover mb-2">
                                <div class="bg-lime-500 p-2 rounded-lg w-[100px] mb-2 text-center">
                                    <p class="text-white text-xs font-bold">
                                        @if ($book->jenis_buku == 'Kelas 10' || $book->jenis_buku == 'Kelas 11' || $book->jenis_buku == 'Kelas 12')
                                            Buku Pelajaran
                                        @elseif ($book->jenis_buku == 'Makalah')
                                            Makalah
                                        @else
                                            Lainnya
                                        @endif
                                    </p>
                                </div>

                                <h3 class="text-base">{{ $book->nama_buku }}</h3><br>
                                <h6 class="text-sm">Jumlah : {{ $book->jumlah_buku }}</h6>

                                <h6 class="text-xs">{{ $book->created_at->format('l, d - F - Y') }}</h6>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>


    </div>

</div>

<?php

// Add this function to your existing code

function getRakCategory($nama_buku) {
    $categories = [
        'Bahasa Inggris', 'Matematika', 'Bahasa Indonesia', 'Olahraga', 'Seni Budaya',
        'Fisika', 'Kimia', 'Biologi', 'Geografi', 'Sejarah', 'Ekonomi', 'Sosiologi',
        'Bahasa Asing (Bahasa Jawa, Bahasa Arab, dll.)', 'Pendidikan Agama', 'Kewarganegaraan',
        'Komputer dan Informatika', 'Seni Musik', 'Seni Tari', 'Seni Rupa', 'Ketrampilan',
        'Pendidikan Jasmani', 'Pemrograman', 'Manajemen Bisnis', 'Akuntansi', 'Kesehatan Reproduksi',
        'Kesehatan Jiwa', 'Pendidikan Kewarganegaraan', 'Sastra', 'Hukum', 'Manajemen Pemasaran',
        'Ilmu Komunikasi', 'Pendidikan Matematika', 'Pendidikan Bahasa Inggris', 'Pendidikan Seni Rupa',
        'Pendidikan Fisika', 'Pendidikan Biologi', 'Pendidikan IPS', 'Pendidikan Agama', 'Pendidikan Olahraga',
        'Pendidikan Kesenian', 'Pendidikan Teknik Elektro', 'Pendidikan Teknik Mesin', 'Pendidikan Kesehatan',
        'Pendidikan Jasmani', 'Pendidikan Bahasa Asing', 'Pendidikan Kewarganegaraan',
        'Pendidikan Keterampilan', 'Pendidikan Teknologi Informasi', 'Pendidikan Pancasila', 'PPKN', 'PKN'
        ];

    $novelKeywords = ['novel'];
    $majalahKeywords = ['majalah'];

    // Check for Mapel category
    foreach ($categories as $category) {
        if (stripos($nama_buku, $category) !== false) {
            return 'Rak Buku Mapel';
        }
    }

    // Check for Novel category
    foreach ($novelKeywords as $keyword) {
        if (stripos($nama_buku, $keyword) !== false) {
            return 'Rak Novel';
        }
    }

    // Check for Majalah category
    foreach ($majalahKeywords as $keyword) {
        if (stripos($nama_buku, $keyword) !== false) {
            return 'Rak Majalah';
        }
    }

    // Default category if no match is found
    return 'Tidak Ada Keterangan';
}
?>



@endsection
