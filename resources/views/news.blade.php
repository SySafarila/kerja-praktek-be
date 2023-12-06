@extends('layouts.public')

@section('head')
<style>
    body {
        background: #ECECEC;
    }
</style>
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
    <img src="{{ asset('images/news.png') }}" alt="" class="w-full h-full object-cover">
    <div
        class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 bg-accent-1/70 absolute backdrop-blur-[2px] p-5 lg:px-10 flex flex-col justify-center gap-y-5">
        <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">BERITA SMA MA'ARIF PACET</h1>
        <span class="text-accent-4">20 September 2023 - Cianjur - SMA Ma'Arif</span>
    </div>
</div>
<div class="max-w-screen-lg mx-auto p-5 grid lg:grid-cols-12 gap-5">
    <div class="bg-white lg:col-span-8 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Berita Terbaru</h2>
        <div class="mt-5 flex flex-col gap-5">
            <a href="#" class="flex gap-5 flex-col lg:flex-row group">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="w-full lg:w-60 aspect-video object-cover">
                <div class="flex flex-col justify-between gap-5 py-2">
                    <div class="flex flex-col gap-3">
                        <h1 class="font-semibold group-hover:underline">SMA Ma'arif Pacet Rayakan Hari Guru Nasional 2023 </h1>
                        <p class="">Tanggal 25 November diperingati sebagai Hari Guru Nasional. Peringatan tersebut sebagai wujud
                            penghormatan dan penghargaan terhadap peran</p>
                    </div>
                    <span class="text-sm">25 November 2023 - Cianjur </span>
                </div>
            </a>
            <a href="#" class="flex gap-5 flex-col lg:flex-row group">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="w-full lg:w-60 aspect-video object-cover">
                <div class="flex flex-col justify-between gap-5 py-2">
                    <div class="flex flex-col gap-3">
                        <h1 class="font-semibold group-hover:underline">SMA Ma'arif Pacet Rayakan Hari Guru Nasional 2023 </h1>
                        <p class="">Tanggal 25 November diperingati sebagai Hari Guru Nasional. Peringatan tersebut sebagai wujud
                            penghormatan dan penghargaan terhadap peran</p>
                    </div>
                    <span class="text-sm">25 November 2023 - Cianjur </span>
                </div>
            </a>
            <a href="#" class="flex gap-5 flex-col lg:flex-row group">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="w-full lg:w-60 aspect-video object-cover">
                <div class="flex flex-col justify-between gap-5 py-2">
                    <div class="flex flex-col gap-3">
                        <h1 class="font-semibold group-hover:underline">SMA Ma'arif Pacet Rayakan Hari Guru Nasional 2023 </h1>
                        <p class="">Tanggal 25 November diperingati sebagai Hari Guru Nasional. Peringatan tersebut sebagai wujud
                            penghormatan dan penghargaan terhadap peran</p>
                    </div>
                    <span class="text-sm">25 November 2023 - Cianjur </span>
                </div>
            </a>
            <a href="#" class="flex gap-5 flex-col lg:flex-row group">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="w-full lg:w-60 aspect-video object-cover">
                <div class="flex flex-col justify-between gap-5 py-2">
                    <div class="flex flex-col gap-3">
                        <h1 class="font-semibold group-hover:underline">SMA Ma'arif Pacet Rayakan Hari Guru Nasional 2023 </h1>
                        <p class="">Tanggal 25 November diperingati sebagai Hari Guru Nasional. Peringatan tersebut sebagai wujud
                            penghormatan dan penghargaan terhadap peran</p>
                    </div>
                    <span class="text-sm">25 November 2023 - Cianjur </span>
                </div>
            </a>
        </div>
    </div>
    <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
        <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Berita Lainnya</h2>
        <div class="flex flex-col gap-3 mt-5">
            <a href="#" class="hover:underline">SMA Ma’arif Pacet Rayakan Hari Guru Nasional 2023</a>
            <a href="#" class="hover:underline">Lorem, ipsum dolor.</a>
            <a href="#" class="hover:underline">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
            <a href="#" class="hover:underline">SMA Ma’arif Pacet Rayakan Hari Guru Nasional 2023</a>
            <a href="#" class="hover:underline">Lorem, ipsum dolor.</a>
            <a href="#" class="hover:underline">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
            <a href="#" class="hover:underline">SMA Ma’arif Pacet Rayakan Hari Guru Nasional 2023</a>
            <a href="#" class="hover:underline">Lorem, ipsum dolor.</a>
            <a href="#" class="hover:underline">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
