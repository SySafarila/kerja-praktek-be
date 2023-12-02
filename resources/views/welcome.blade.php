@extends('layouts.public')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

<style>
    .splide__pagination__page .is-active {
        background: white !important;
    }

    .splide__pagination__page {
        background: white !important;
    }

    .splide__arrow svg {
        fill: white !important;
    }

    #splide2 .splide__pagination {
        bottom: -1.5rem !important;
    }
</style>
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5">
    <div class="splide" id="splide1" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/16x9_by_Pengo.svg/800px-16x9_by_Pengo.svg.png"
                        alt="" class="aspect-video w-full object-cover">
                </li>
                <li class="splide__slide">
                    <img src="https://biteable.com/wp-content/uploads/2023/05/Screen-Shot-2023-05-22-at-11.36.44-am-1024x519.jpg"
                        alt="" class="aspect-video w-full object-cover">
                </li>
                <li class="splide__slide">
                    <img src="https://t3.ftcdn.net/jpg/05/00/93/52/360_F_500935221_tsBI0GrKhmZtaUJc9rqBohOTMplI8Uil.jpg"
                        alt="" class="aspect-video w-full object-cover">
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="bg-accent-2 lg:py-10">
    <div class="max-w-screen-lg mx-auto p-5 flex flex-col gap-4">
        <h1 class="text-3xl text-center"><span class="text-accent-5">Informasi &</span> Pendaftaran Siswa/i Baru</h1>
        <h1 class="text-accent-5 text-3xl text-center">Tahun Ajaran 2024,2025</h1>
        <p class="text-center mx-auto max-w-screen-sm">SMA Ma’arif Pacet sudah berhasil mengirimkan para siswa/i untuk
            melanjutkan Pendidikan di Perguruan Tinggi Nasional dan Internasional</p>
    </div>
</div>
<div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">
    <h1 class="text-accent-1 text-center">Program Kami</h1>
    <h2 class="text-center text-3xl"><span class="text-accent-1">Pendidikan</span> Berbasis Sekolah</h2>
    <div class="grid lg:grid-cols-3 text-accent-3 gap-5">
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            <a href="#" class="block text-center underline">Info Detail</a>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5 lg:p-2 bg-accent-1 text-white rounded-lg">
            <img src="{{ asset('icons/takhasus.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center text-accent-2">Boarding School</h3>
            <p class="text-center text-accent-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam
                ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            <a href="#" class="block text-center underline">Info Detail</a>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/full day school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            <a href="#" class="block text-center underline">Info Detail</a>
        </div>
    </div>
</div>
<div class="max-w-screen-lg mx-auto p-5 lg:py-10 text-accent-4"
    style="background-image: url({{ asset('images/bg1.png') }}); background-position: center;">
    <h1 class="text-3xl text-center text-accent-2">Selayang Pandang</h1>
    <div class="grid lg:grid-cols-2 lg:px-10 mt-5 lg:mt-10 gap-5">
        <div class="flex flex-col gap-3">
            <p class="text-accent-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis non rerum
                voluptates corrupti temporibus
                doloremque ad beatae sit hic quasi veritatis inventore vero atque, aut similique esse, saepe eveniet
                soluta.</p>
            <p class="text-accent-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, similique, rerum,
                ut incidunt cum
                necessitatibus esse sed error velit ea amet cumque itaque fugit illo culpa! Eveniet incidunt quisquam
                dolorem?</p>
        </div>
        <div>
            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
    </div>
</div>
<div class="max-w-screen-lg mx-auto p-5 py-8 lg:py-10">
    <h1 class="text-3xl text-center text-accent-1">Mengapa Memilih SMA Ma'arif Pacet?</h1>
    <div class="grid lg:grid-cols-3 text-accent-3 mt-5 lg:mt-10">
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
        <div class="flex flex-col justify-center gap-3 p-5">
            <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
            <h3 class="font-bold text-xl text-center">Boarding School</h3>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
        </div>
    </div>
</div>
<div class="max-w-screen-lg mx-auto"
    style="background-image: url({{ asset('images/bg2.png') }}); background-position: center;">
    <div class="p-5 py-8 lg:py-20 text-accent-4 bg-[#356F11]/75 flex flex-col gap-4">
        <h1 class="text-3xl text-center text-white uppercase font-bold">Pendaftaran Peserta Didik Baru</h1>
        <p class="text-white text-center">Kami mengundang putra terbaik Negeri untuk bergabung bersama SMA Ma’arif
            Pacet</p>
        <a href="#" class="bg-accent-1 mx-auto px-5 py-2 rounded-lg">Daftar Sekarang</a>
    </div>
</div>
<div class="max-w-screen-lg mx-auto p-5 lg:py-10">
    <h1 class="text-3xl text-center uppercase font-bold text-accent-3"><span class="text-accent-1">Berita &</span>
        Artikel</h1>
    <div class="grid lg:grid-cols-3 mt-5 gap-5">
        <a href="#" class="border rounded-t-xl overflow-hidden">
            <div class="relative">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/16x9_by_Pengo.svg/800px-16x9_by_Pengo.svg.png"
                    alt="" class="w-full aspect-video">
                <div class="w-full h-full absolute top-0"
                    style="background: linear-gradient(180deg, rgba(32,33,36,0) 70%, rgba(91,168,43,1) 100%);"></div>
                <img src="{{ asset('images/logo.png') }}" alt="" class="absolute w-8 left-5 -bottom-3">
            </div>
            <div class="p-5">
                <h3 class="font-bold">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
            </div>
            <div class="p-5 pt-0 flex justify-between text-sm">
                <span class="text-gray-400">Oktober 03, 2023</span>
                <span class="text-gray-400">No Comment</span>
            </div>
        </a>
        <a href="#" class="border rounded-t-xl overflow-hidden">
            <div class="relative">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/16x9_by_Pengo.svg/800px-16x9_by_Pengo.svg.png"
                    alt="" class="w-full aspect-video">
                <div class="w-full h-full absolute top-0"
                    style="background: linear-gradient(180deg, rgba(32,33,36,0) 70%, rgba(91,168,43,1) 100%);"></div>
                <img src="{{ asset('images/logo.png') }}" alt="" class="absolute w-8 left-5 -bottom-3">
            </div>
            <div class="p-5">
                <h3 class="font-bold">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
            </div>
            <div class="p-5 pt-0 flex justify-between text-sm">
                <span class="text-gray-400">Oktober 03, 2023</span>
                <span class="text-gray-400">No Comment</span>
            </div>
        </a>
        <a href="#" class="border rounded-t-xl overflow-hidden">
            <div class="relative">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/16x9_by_Pengo.svg/800px-16x9_by_Pengo.svg.png"
                    alt="" class="w-full aspect-video">
                <div class="w-full h-full absolute top-0"
                    style="background: linear-gradient(180deg, rgba(32,33,36,0) 70%, rgba(91,168,43,1) 100%);"></div>
                <img src="{{ asset('images/logo.png') }}" alt="" class="absolute w-8 left-5 -bottom-3">
            </div>
            <div class="p-5">
                <h3 class="font-bold">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
            </div>
            <div class="p-5 pt-0 flex justify-between text-sm">
                <span class="text-gray-400">Oktober 03, 2023</span>
                <span class="text-gray-400">No Comment</span>
            </div>
        </a>
    </div>
    <div class="flex justify-center mt-5 gap-3 text-lg">
        <a href="#" class="text-black">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
    </div>
</div>
<div class="max-w-screen-lg mx-auto p-5 py-8 lg:py-10 text-accent-4"
    style="background-image: url({{ asset('images/bg1.png') }}); background-position: center;">
    <h1 class="text-3xl text-center text-accent-2">Murottal Merdu Santri SMA Ma'arif Pacet</h1>
    <div class="splide mt-5" id="splide2" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </li>
                <li class="splide__slide">
                    <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </li>
                <li class="splide__slide">
                    <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </li>
                <li class="splide__slide">
                    <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </li>
                <li class="splide__slide">
                    <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/sTTiTTr12a8?si=5NSxvqRjwOtu_Ueg" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
    new Splide('#splide1', {
        type: 'loop',
        autoplay: true,
        pauseOnHover: true
    }).mount();
</script>
<script>
    new Splide('#splide2', {
        perPage: 3,
        gap: 10,
        breakpoints: {
            640: {
                perPage: 2
            }
        }
    }).mount();
</script>
@endsection
