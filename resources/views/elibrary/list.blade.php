@extends('layouts.public')
@section('content')
<div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
    <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
        <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
            <div
                class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">E-Library SMA MA'ARIF PACET</h1>

                <div class="flex justify-between text-sm pt-8">
                    <span class="text-white">
                        {{-- Display user's local date and time in Indonesian format --}}
                        <p class="text-accent-4" id="user-local-date-time"></p>
                        {{-- Add a space if both date/time and location are displayed --}}
                        <p class="text-accent-4" id="user-location"></p>
                    </span>

                </div>
            </div>
        </div>
    </div>
</div>

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
    <div class="content grid grid-cols-3 gap-4 py-4">
        @foreach ($elibraries->sortByDesc('created_at')->take(6) as $item)
            <a href="{{ route('elibrary.show', ['id' => $item->id]) }}" class="max-w-md bg-white p-4 rounded-md shadow-md">
                <div class="relative">
                    <img src="{{ asset($item->foto_buku ? 'storage/elibrary-fotobuku/'.$item->foto_buku : 'path/to/default-image.jpg') }}"
                         alt="" class="w-full h-[400px] object-cover mb-2 rounded-md">
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
                    <h3 class="p-0">{{ $item->nama_buku }}</h3>
                    <h6 class="text-sm">Jumlah : {{ $item->jumlah_buku }}</h6>
                    <h6 class="text-xs">{{ $item->created_at->format('l, d - F - Y') }}</h6>
                </div>
            </a>
        @endforeach
    </div>

</div>
@endsection
