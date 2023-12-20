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

<div class="max-w-screen-lg mx-auto p-5 grid lg:grid-cols-12 gap-5">
    <div class="bg-white lg:col-span-8 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Kelas 12 Buku PKN</h2>
        <div class="mt-5 flex flex-col gap-5">


            <div class="text-center justify-center items-center">

                <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="Buku Cover" class="justify-center w-[250px] h-[360px] items-center mb-4 rounded-lg">
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-500"><span class="font-semibold">Nama Buku :</span> 50</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Ditulis oleh :</span> A1</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Penerbit :</span> Buku ini berisi tentang...</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Jumlah Buku:</span> 50</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Rak Buku:</span> A1</p>
                <p class="text-sm text-gray-500  max-w-[500px]"><span class="font-semibold">Deskripsi Buku:</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel ante nibh. Praesent enim diam, posuere nec augue eu, lobortis euismod libero. Cras pellentesque eros lacus, eu pellentesque eros vulputate id. Aliquam efficitur eros et nibh pulvinar, vel aliquet nulla pellentesque. Nunc euismod diam mauris, eget vestibulum lacus accumsan a. Nam in tellus id eros consequat tempus. Curabitur imperdiet enim augue, a tempor ipsum consectetur quis.</p>
            </div>

        </div>
    </div>
    <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Buku Lainnya</h2>
        <div class="flex flex-col gap-3 mt-5">

            <div class=" max-w mx-auto bg-white ">
                <div class="content   py-4 w-[250px] h-auto rounded overflow-hidden  p-2">
                    <div class="relative">
                        <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="" class="w-[150px] h-auto mb-2  ">
                        <div class=" bg-lime-500 p-2 rounded-lg w-[80px] mb-2">
                            <p class="text-white text-[10px] font-bold items-center justify-center ">Buku Sekolah</p>
                        </div>
                        <h3 class=" text-base ">Kelas 12 SMA Buku Siswa PPKN Semester 2</h3><br>
                        <h6 class="text-sm">Ditulis Oleh</h6>
                        <h6 class="text-xs">Rak 13</h6>
                    </div>
                </div>
           </div>


        </div>
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Pranara Luar</h2>
        <div class="mt-5 flex flex-col ">
            <a href="" class="hover:text-accent-1">Facebook</a>
            <a href="" class="hover:text-accent-1">Instagram</a>
            <a href="" class="hover:text-accent-1">YouTube</a>
        </div>
    </div>
</div>


<div class="max-w-screen-lg bg-lime-500 mx-auto lg:py-10 p-5 gap-5 flex space-x-4 ">
    <div class="flex-1 bg-white p-4 rounded border border-gray-300">
        <!-- Konten div pertama -->

        <div class="text-center justify-center items-center">
            <h2 class=" text-xl font-bold mb-4">Kelas 12 Buku Siswa PKN</h2>
            <img src="{{ asset('images/elibrary/bukupkn.jpeg') }}" alt="Buku Cover" class="justify-center w-[250px] h-[360px] items-center mb-4 rounded-lg">
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-500"><span class="font-semibold">Nama Buku :</span> 50</p>
            <p class="text-sm text-gray-500"><span class="font-semibold">Ditulis oleh :</span> A1</p>
            <p class="text-sm text-gray-500"><span class="font-semibold">Penerbit :</span> Buku ini berisi tentang...</p>
            <p class="text-sm text-gray-500"><span class="font-semibold">Jumlah Buku:</span> 50</p>
            <p class="text-sm text-gray-500"><span class="font-semibold">Rak Buku:</span> A1</p>
            <p class="text-sm text-gray-500  max-w-[500px]"><span class="font-semibold">Deskripsi Buku:</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel ante nibh. Praesent enim diam, posuere nec augue eu, lobortis euismod libero. Cras pellentesque eros lacus, eu pellentesque eros vulputate id. Aliquam efficitur eros et nibh pulvinar, vel aliquet nulla pellentesque. Nunc euismod diam mauris, eget vestibulum lacus accumsan a. Nam in tellus id eros consequat tempus. Curabitur imperdiet enim augue, a tempor ipsum consectetur quis.</p>
        </div>
    </div>
    <div class="flex-1/2 bg-white p-4 rounded border border-gray-300">
        <!-- Konten div kedua -->
        <h2 class="text-xl font-bold mb-2">Div Kedua</h2>
        <p>Isi div kedua.</p>
    </div>
</div>

@endsection
