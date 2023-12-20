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
        <h1 class=" font-bold text-3xl "> Daftar Buku Sekolah </h1>
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
</div>
@endsection
