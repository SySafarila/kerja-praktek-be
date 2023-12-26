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
    <div class="content flex py-2">
        <div class="text-container flex flex-col justify-center items-center">
            <h1 class="display-4 font-bold text-5xl ">Jelajahi Dunia, <br>Bacalah Buku</h1>
            <button onclick="scrollToDaftarBuku()" type="button" class="text-white bg-lime-500 hover:bg-lime-900 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mt-2">Jelajahi Koleksi</button>
        </div>
        <img src="{{ asset('images/elibrary/flatdesignelibrary.png') }}" alt="" class="w-[600px] h-auto object-cover">
    </div>



    <div class="text-center" >
    <h5 class="flex items-center">"Selamat datang di E-Library SMA Maarif, tempat di mana pengetahuan bertemu teknologi. Nikmati akses tak terbatas ke berbagai buku yang menjangkau segala minat dan level pendidikan. Dari sastra hingga ilmu pengetahuan, kami menyediakan koleksi yang menginspirasi.</h5>
    <br>
    <h5 class="flex items-center ">Jelajahi beragam makalah yang dihasilkan oleh siswa dan guru kami, mencerminkan dedikasi terhadap riset dan pemahaman mendalam. Dengan E-Library, kami membuka pintu menuju pembelajaran yang lebih luas dan lebih mendalam.</h5>
    <Br>
    </div>

    <div class="content flex justify-center items-center">
        <div id="daftar-buku-terbaru" class="content flex justify-center items-center">
            <h1 class="font-bold text-3xl"> Daftar Buku Terbaru </h1>
        </div>
    </div>
    <div class="content grid grid-cols-3 gap-4 py-4">
        @foreach ($elibraries->sortByDesc('created_at')->take(6) as $item)
        <a href="{{ route('elibrary.show', ['id' => $item->id]) }}" class="max-w-md bg-white p-4 rounded-md shadow-md">

                <div class="relative ">
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

    <div class="content flex justify-center items-center">
        <h1 id="daftar-buku-pelajaran" class=" font-bold text-3xl "> Daftar Buku Pelajaran </h1>
    </div>
    <div class="content grid grid-cols-3 gap-4 py-4">
        @foreach ($elibraries->where('jenis_buku', 'Kelas 10')->merge($elibraries->where('jenis_buku', 'Kelas 11'))->merge($elibraries->where('jenis_buku', 'Kelas 12')) as $item)
            <a href="#" class="max-w-md bg-white p-4 rounded-md shadow-md">
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
                    <h6 class="text-xs">{{ $item->jenis_buku }}</h6>
                </div>
            </a>
        @endforeach
    </div>

    <div class="flex items-center justify-center">
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Kelas 10']) }}" class="font-bold text-lime-500">Lihat Semua</a>
    </div>
</div>
<div class="flex items-center">
    <div class="flex relative">
        <img class="w-[1920px] h-[400px]" src="{{ asset('images/backgrounds/bgelibrary.png') }}" alt="">
        <div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex gap-5 absolute inset-0 text-white ">
            <div>
                <h1 class="text-5xl font-bold text-white mt-20 mb-5"> Tahukah Kamu ? </h1>
                <h6 class="text-lg text-white max-w-[400px]">Temukan dunia baru di setiap halaman. Mari bersama merajut cerita dan menemukan hikmah dalam keajaiban buku</h6>
            </div>
            <div class="mt-4 ml-60 grid grid-cols-1 gap-3">
                <a href="{{ route('elibrary.list', ['jenis_buku' => 'Kelas 10']) }}" class="bg-white text-black text-xl uppercase font-bold py-2 px-5 w-full flex items-center justify-center">
                    <img class="w-10 h-10 mr-2" src="{{ asset('images/elibrary/sekolah.png') }}" alt="Buku Icon">
                    Buku Pelajaran
                </a>
                <a href="{{ route('elibrary.list', ['jenis_buku' => 'Makalah']) }}" class="bg-white text-black text-xl uppercase font-bold py-2 px-5 w-full flex items-center justify-center">
                    <img class="w-10 h-10 mr-2" src="{{ asset('images/elibrary/siswa.png') }}" alt="Buku Icon">
                    Makalah Siswa/i
                </a>
                <a href="{{ route('elibrary.list', ['jenis_buku' => 'Lainnya']) }}" class="bg-white text-black text-xl uppercase font-bold py-2 px-5 w-full flex items-center justify-center">
                    <img class="w-10 h-10 mr-2" src="{{ asset('images/elibrary/tanggal.png') }}" alt="Buku Icon">
                    Lainnya
                </a>

            </div>
        </div>
    </div>
</div><br>





<div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">
    <div class="content flex justify-center items-center">
        <h1 id="daftar-makalah" class=" font-bold text-3xl "> Daftar Makalah Siswa/i </h1>
    </div>
    <div class="content grid grid-cols-3 gap-4 py-4">
        @foreach ($elibraries->where('jenis_buku', 'Makalah') as $item)
            <a href="#" class="max-w-md bg-white p-4 rounded-md shadow-md">
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
                    <h6 class="text-xs">{{ $item->jenis_buku }}</h6>
                </div>
            </a>
        @endforeach
    </div>


</div>
    <div class="flex items-center justify-center">
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Makalah']) }}" class="font-bold text-lime-500">Lihat Semua</a>
    </div>
</div>

<div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">
    <div class="content flex justify-center items-center">
        <h1 id="daftar-makalah" class=" font-bold text-3xl "> Daftar Buku Lainnya </h1>
    </div>
    <div class="content grid grid-cols-3 gap-4 py-4">
        @foreach ($elibraries->where('jenis_buku', 'Lainnya') as $item)
            <a href="#" class="max-w-md bg-white p-4 rounded-md shadow-md">
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
                    <h6 class="text-xs">{{ $item->jenis_buku }}</h6>
                </div>
            </a>
        @endforeach
    </div>
    <div class="flex items-center justify-center">
        <a href="{{ route('elibrary.list', ['jenis_buku' => 'Lainnya']) }}" class="font-bold text-lime-500">Lihat Semua</a>
    </div>
</div><br>


<script>
    function scrollToDaftarBukuTerbaru() {
        var el = document.getElementById('daftar-buku-terbaru');
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function scrollToDaftarBukuPelajaran() {
        var el = document.getElementById('daftar-buku-pelajaran');
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function scrollToDaftarMakalah() {
        var el = document.getElementById('daftar-makalah');
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }


    function scrollToDaftarBuku() {
        var el = document.getElementById('daftar-buku-terbaru');
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

</script>
@endsection
