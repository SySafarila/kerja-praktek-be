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
        <div class="text-container">
            <h1 class="display-4 font-bold text-5xl">Jelajahi Dunia, <br>Bacalah Buku</h1>
            <button type="button" class="text-white bg-lime-500 hover:bg-lime-900 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mt-2">Jelajahi Koleksi</button>
        </div>
        <img src="{{ asset('images/elibrary/flatdesignelibrary.png') }}" alt="" class="w-[400px] h-auto object-cover">
    </div>

    <div class="" >
    <h5 class="flex items-center">"Selamat datang di E-Library SMA Maarif, tempat di mana pengetahuan bertemu teknologi. Nikmati akses tak terbatas ke berbagai buku yang menjangkau segala minat dan level pendidikan. Dari sastra hingga ilmu pengetahuan, kami menyediakan koleksi yang menginspirasi.</h5>
    <br>
    <h5 class="flex items-center ">Jelajahi beragam makalah yang dihasilkan oleh siswa dan guru kami, mencerminkan dedikasi terhadap riset dan pemahaman mendalam. Dengan E-Library, kami membuka pintu menuju pembelajaran yang lebih luas dan lebih mendalam.</h5>
    <Br>
    </div>

    <div class="content flex justify-center items-center">
        <h1 class=" font-bold text-3xl "> Daftar Buku Terbaru </h1>
    </div>
    <div class="content flex flex-wrap inline-block py-4">
        <div class=" max-w mx-auto bg-white ">
            <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
                <div class="relative">
                    <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                    <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                        <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                    </div>
                    <h3 class="p-0">Kelas 12 SMA Buku Siswa PPKN</h3>
                    <h6 class="text-sm">Ditulis Oleh</h6>
                    <h6 class="text-xs">Rak 13</h6>
                </div>
            </div>
       </div>
       <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    </div>
    <div class="content flex justify-center items-center">
        <h1 class=" font-bold text-3xl "> Daftar Buku Pelajaran </h1>
    </div>
    <div class="content flex flex-wrap inline-block py-4">
        <div class=" max-w mx-auto bg-white ">
            <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
                <div class="relative">
                    <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                    <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                        <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                    </div>
                    <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                    <h6 class="text-sm">Ditulis Oleh</h6>
                    <h6 class="text-xs">Rak 13</h6>
                </div>
            </div>
       </div>
       <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>

    </div>
    <div class="flex items-center justify-center">
        <a href="#" class="font-bold text-lime-500">Lihat Semua</a>
    </div>
</div>
<div class="flex items-center">
    <div class="flex relative">
        <img class="w-[1920px] h-[380px]" src="{{ asset('images/backgrounds/bgelibrary.png') }}" alt="">
        <div class=" max-w-screen-lg mx-auto lg:py-10 p-5 flex gap-5 absolute inset-0 text-white ">
            <div>
            <h1 class="text-5xl  font-bold text-white mt-20 mb 5"> Tahukah Kamu ? </h1>
            <h6 class="text-lg text-white max-w-[400px]">Temukan dunia baru di setiap halaman. Mari bersama merajut cerita dan menemukan hikmah dalam keajaiban buku</h6>
            </div>
            <div class="mt-4 ml-60">
                <button class="bg-white mb-5 text-black text-2xl uppcase-text font-bold py-0 px-3 w-[300px] flex items-center">
                    <img class="w-20 h-20 mr-2" src="{{ asset('images/elibrary/tanggal.png') }}" alt="Buku Icon">
                    Buku Terbaru
                </button>
                <button class="bg-white mb-5 text-black text-2xl uppcase-text font-bold py-0 px-3 w-[300px] flex items-center">
                    <img class="w-20 h-20 mr-2" src="{{ asset('images/elibrary/sekolah.png') }}" alt="Buku Icon">
                    Buku Sekolah
                </button>
                <button class="bg-white mb-5 text-black text-2xl uppcase-text font-bold py-0 px-3 w-[300px] flex items-center">
                    <img class="w-20 h-20 mr-2" src="{{ asset('images/elibrary/siswa.png') }}" alt="Buku Icon">
                    Makalah Siswa
                </button>

            </div>
        </div>

    </div>
</div><br>
<div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">



    <div class="content flex justify-center items-center">
        <h1 class=" font-bold text-3xl "> Daftar Makalah Siswa/i </h1>
    </div>
    <div class="content flex flex-wrap inline-block py-4">
        <div class=" max-w mx-auto bg-white ">
            <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
                <div class="relative">
                    <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                    <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                        <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                    </div>
                    <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                    <h6 class="text-sm">Ditulis Oleh</h6>
                    <h6 class="text-xs">Rak 13</h6>
                </div>
            </div>
       </div>
       <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div><div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>
    <div class=" max-w mx-auto bg-white ">
        <div class="content   py-4 w-[250px] h-[550px] rounded overflow-hidden  p-2">
            <div class="relative">
                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[250px] h-[360px] mb-2  ">
                <div class=" bg-lime-500 p-2 rounded-lg w-[100px] mb-2">
                    <p class="text-white text-xs font-bold items-center justify-center ">Buku Sekolah</p>
                </div>
                <h3 class="absolute ">Kelas 12 SMA Buku Siswa PPKN</h3><br>
                <h6 class="text-sm">Ditulis Oleh</h6>
                <h6 class="text-xs">Rak 13</h6>
            </div>
        </div>

    </div>

    </div>
    <div class="flex items-center justify-center">
        <a href="#" class="font-bold text-lime-500">Lihat Semua</a>
    </div>
</div>
@endsection
