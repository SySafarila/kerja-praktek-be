@extends('layouts.public')
@section('content')


<div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">


    <div class="content flex justify-center items-center">
        @if ($elibraries->isNotEmpty() && $elibraries->first()->jenis_buku)
            @php
                $jenis_buku = $elibraries->first()->jenis_buku; // Mengambil jenis buku dari item pertama
            @endphp
            <h1 class="font-bold text-3xl">Daftar Buku {{ ucfirst($jenis_buku) }}</h1>
        @else
            <h1 class="font-bold text-3xl">Daftar Buku</h1>
        @endif
    </div>
    <div class="flex justify-center items-center gap-3 mt-5">
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Kelas 10']) }}" class="bg-green-500 rounded px-4 py-2 text-white">Kelas 10</a>
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Kelas 11']) }}" class="bg-green-500 rounded px-4 py-2 text-white">Kelas 11</a>
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Kelas 12']) }}" class="bg-green-500 rounded px-4 py-2 text-white">Kelas 12</a>
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Makalah']) }}" class="bg-green-500 rounded px-4 py-2 text-white">Makalah</a>
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Lainnya']) }}" class="bg-green-500 rounded px-4 py-2 text-white">Lainnya</a>
    </div>

    <div class="content grid grid-cols-4 gap-4 py-4">
        @foreach ($elibraries->sortByDesc('created_at') as $item)
            <a href="{{ route('elibrary.show', ['id' => $item->id]) }}" class="max-w-md bg-white p-4 rounded-md shadow-md">
                <div class="relative">
                    <img src="{{ asset($item->foto_buku ? 'storage/elibrary-fotobuku/'.$item->foto_buku : 'path/to/default-image.jpg') }}"
                         alt="" class="w-full h-[300px] object-cover mb-2 rounded-md">
                    <div class="bg-lime-500 p-2 rounded-lg w-[100px] mb-2 flex items-center justify-center">
                        <p class="text-white text-xs font-bold">
                            @if ($item->jenis_buku == 'Kelas 10' || $item->jenis_buku == 'Kelas 11' || $item->jenis_buku == 'Kelas 12')
                                Buku Pelajaran
                            @elseif ($item->jenis_buku == 'Makalah')
                                Makalah
                            @else
                                Lainnya
                            @endif
                        </p>
                    </div>
                    <h3 class="p-0">{{ ucwords($item->nama_buku) }}</h3>
                    <h6 class="text-sm">Jumlah : {{ $item->jumlah_buku }}</h6>
                    <h6 class="text-xs">{{ $item->created_at->format('l, d - F - Y') }}</h6>
                </div>
            </a>
        @endforeach
    </div>



</div>
@endsection


