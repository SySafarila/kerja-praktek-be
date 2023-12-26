@extends('layouts.public')
@section('content')
<div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
    <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
        <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
            <div
                class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">{{ $elibrary->nama_buku }}</h1>

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

<div class="max-w-screen-lg mx-auto p-5 grid lg:grid-cols-12 gap-5">
    <div class="bg-white lg:col-span-8 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">{{ $elibrary->nama_buku }}</h2>
        <div class="mt-5 flex flex-col gap-5">


            <div class="text-center justify-center items-center">
                <img src="{{ asset($elibrary->foto_buku ? 'storage/elibrary-fotobuku/'.$elibrary->foto_buku : 'path/to/default-image.jpg') }}" alt="Buku Cover" class="mx-auto w-[250px] h-[360px] object-cover mb-4 rounded-lg">
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500"><span class="font-semibold">Nama Buku :</span> {{ $elibrary->nama_buku }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Ditulis oleh :</span> {{ $elibrary->penulis }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Penerbit :</span> {{ $elibrary->penerbit }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Jumlah Buku:</span> {{ $elibrary->jumlah_buku }}</p>
                <p class="text-sm text-gray-500  max-w-[500px]"><span class="font-semibold">Deskripsi Buku:</span> {{ $elibrary->deskripsi}}</p>
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
                                <div class="bg-lime-500 p-2 rounded-lg w-[80px] mb-2 text-center">
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
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Pranara Luar</h2>
        <div class="mt-5 flex flex-col ">
            <a href="" class="hover:text-accent-1">Facebook</a>
            <a href="" class="hover:text-accent-1">Instagram</a>
            <a href="" class="hover:text-accent-1">YouTube</a>
        </div>

    </div>

</div>




@endsection
