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

        #splide3 .splide__pagination__page .is-active {
            background: black !important;
        }

        #splide3 .splide__pagination__page {
            background: black !important;
        }

        #splide4 .splide__pagination__page .is-active {
            background: black !important;
        }

        #splide4 .splide__pagination__page {
            background: black !important;
        }

        .splide__arrow svg {
            fill: white !important;
        }

        #splide2 .splide__pagination {
            bottom: -1.5rem !important;
        }

        #splide3 .splide__pagination {
            bottom: -1.5rem !important;
        }

        #splide4 .splide__pagination {
            bottom: -1.5rem !important;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="mx-auto">
    <div class="splide" id="splide1" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <img src="{{asset('images/banners/Welcome 1.png')}}"
                        alt="" class="aspect-video w-full object-cover lg:h-[25rem] xl:h-[30rem] 2xl:h-[45rem]">
                </li>
                <li class="splide__slide">
                    <img src="{{asset('images/banners/Welcome 2.png')}}"
                        alt="" class="aspect-video w-full object-cover lg:h-[25rem] xl:h-[30rem] 2xl:h-[45rem]">
                </li>
                <li class="splide__slide">
                    <img src="{{asset('images/banners/Welcome 3.png')}}"
                        alt="" class="aspect-video w-full object-cover lg:h-[25rem] xl:h-[30rem] 2xl:h-[45rem]">
                </li>
            </ul>
        </div>
    </div>
    </div> --}}
    <div class="max-w-screen-lg mx-auto lg:px-5 ">
        <div class="splide" id="splide1" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 1.png') }}" alt=""
                            class="aspect-video w-full object-cover">
                    </li>
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 2.png') }}" alt=""
                            class="aspect-video w-full object-cover">
                    </li>
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 3.png') }}" alt=""
                            class="aspect-video w-full object-cover">
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ppdb --}}
    <div class="bg-accent-2 lg:py-10">
        <div class="max-w-screen-lg mx-auto p-5 flex flex-col gap-4">
            <h1 class="text-3xl text-center"><span class="text-accent-5">Informasi &</span> Pendaftaran Siswa/i Baru</h1>
            <h1 class="text-accent-5 text-3xl text-center">Tahun Ajaran 2024/2025</h1>
            <p class="text-center mx-auto max-w-screen-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos
                quisquam ut possimus
                nulla, cupiditate odio illum. </p>
        </div>
    </div>

    {{-- sambutan --}}


    {{-- programme --}}
    <div class="max-w-screen-lg mx-auto lg:py-10 p-5 flex flex-col gap-5">
        <h1 class="text-accent-1 uppercase font-bold text-center text-3xl -mb-4">Program Kami</h1>
        {{-- <h2 class="text-center text-3xl mb-4">Lorem, ipsum dolor sit amet </h2> --}}
        <div class="grid lg:grid-cols-3 text-accent-3 gap-5">
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
                <a href="#" class="block text-center my-4 hover:text-accent-1 font-semibold">Info Detail</a>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
                <a href="#" class="block text-center my-4 hover:text-accent-1 font-semibold">Info Detail</a>
            </div>
            {{-- <div class="flex flex-col justify-center gap-3 p-5 lg:p-2 bg-accent-1 text-white rounded-lg">
                <img src="{{ asset('icons/takhasus.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center text-accent-2">Lorem ipsum</h3>
                <p class="text-center text-accent-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam
                    ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
                <a href="#" class="block text-center my-4">Info Detail</a>
            </div> --}}
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
                <a href="#" class="block text-center my-4 hover:text-accent-1 font-semibold">Info Detail</a>
            </div>
        </div>
    </div>


    {{-- <div class="max-w-full bg-cover "
        style="background-image: url({{ asset('images/backgrounds/bg1.png') }}); background-position: center;">
        <div class="bg-[#356F11]/0">
            <div class="max-w-screen-lg mx-auto ">
                <div class="p-5 py-8 lg:py-20 text-accent-4  flex flex-col gap-4">
                    <h1 class="text-3xl text-center text-white uppercase font-bold">Pendaftaran Peserta Didik Baru</h1>
                    <p class="text-white text-center">Kami mengundang putra terbaik Negeri untuk bergabung bersama SMA
                        Ma’arif Pacet</p>
                    <a href="#"
                        class="bg-accent-1 transition hover:bg-yellow-200 hover:text-black mx-auto btn">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- featured videos --}}
    <div class="max-w-full bg-cover" style="background-image: url({{ asset('images/backgrounds/bg1.png') }});">
        <div class="max-w-screen-lg mx-auto p-5 lg:py-10 text-accent-4">
            <h1 class="text-3xl text-center text-accent-2">Sambutan Kepala Sekolah</h1>
            <div class="grid lg:grid-cols-2 lg:px-10 mt-5 lg:mt-10 gap-5">
                <div class="flex flex-col gap-3">
                    <p class="text-accent-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis non rerum
                        voluptates corrupti temporibus
                        doloremque ad beatae sit hic quasi veritatis inventore vero atque, aut similique esse, saepe eveniet
                        soluta.</p>
                    <p class="text-accent-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, similique,
                        rerum,
                        ut incidunt cum
                        necessitatibus esse sed error velit ea amet cumque itaque fugit illo culpa! Eveniet incidunt
                        quisquam
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
    </div>

    {{-- features --}}
    <div class="max-w-screen-lg mx-auto p-5 py-8 lg:py-10">
        <h1 class="text-3xl text-center text-accent-1">Mengapa Memilih SMA Ma'arif Pacet?</h1>
        <div class="grid lg:grid-cols-3 text-accent-3 mt-5 lg:mt-10">
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
            <div class="flex flex-col justify-center gap-3 p-5">
                <img src="{{ asset('icons/boarding school.svg') }}" alt="" class="w-[100px] mx-auto">
                <h3 class="font-bold text-xl text-center">Lorem ipsum</h3>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus
                    nulla, cupiditate odio illum. Quam voluptatibus unde, praesentium quisquam cupiditate doloremque.
                    Impedit reiciendis suscipit facere. Distinctio, aspernatur suscipit.</p>
            </div>
        </div>
    </div>

    {{-- ppdb 2 --}}
    <div class="max-w-full bg-cover "
        style="background-image: url({{ asset('images/photos/photo1.png') }}); background-position: center;">
        <div class="bg-[#356F11]/75">
            <div class="max-w-screen-lg mx-auto ">
                <div class="p-5 py-8 lg:py-20 text-accent-4  flex flex-col gap-4">
                    <h1 class="text-3xl text-center text-white uppercase font-bold">Pendaftaran Peserta Didik Baru</h1>
                    <p class="text-white text-center">Kami mengundang putra terbaik Negeri untuk bergabung bersama SMA
                        Ma’arif
                        Pacet</p>
                    <a href="#"
                        class="bg-accent-1 transition hover:bg-yellow-200 hover:text-black mx-auto btn">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    {{-- news --}}
    <div class="max-w-screen-lg mx-auto p-5 lg:py-10">
        <h1 class="text-3xl text-center uppercase font-bold text-accent-3"><span class="text-accent-1">Berita <span> & </span> Artikel</span>
            </h1>

        @if ($news->isEmpty())
            <p class="text-center my-32 text-xl text-accent-3/50">There's no news published yet</p>
        @else
            <div class="grid lg:grid-cols-3 lg:grid-rows-2 mt-5 gap-5">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', ['id' => $item->id]) }}" class="border rounded-t-xl overflow-hidden">
                        <div class="relative">
                            @php
                                // Extract the first image from the CKEditor body
                                $firstImage = ''; // Default value if no image is found
                                preg_match('/<img[^>]+src="([^"]+)"[^>]*>/i', $item->body, $matches);
                                if (!empty($matches[1])) {
                                    $firstImage = $matches[1];
                                }
                            @endphp
                            <img src="{{ $firstImage ?: asset('images/dummy/news.png') }}" alt=""
                                class="w-full aspect-video object-cover">
                            <div class="w-full h-full absolute top-0"
                                style="background: linear-gradient(180deg, rgba(32,33,36,0) 70%, rgba(91,168,43,1) 100%);">
                            </div>
                            <img src="{{ asset('images/logos/logo2a.png') }}" alt=""
                                class="absolute w-12 left-5 -bottom-3">
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold">{{ $item->title }}</h3>
                        </div>
                        <div class="p-5 pt-0 flex justify-between text-sm">
                            <span class="text-gray-400">{{ $item->created_at->format('F d, Y') }}</span>
                            <span class="text-gray-400">No Comment</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-center mt-5 gap-3 text-lg">
                <a href="{{ route('news') }}" class=" text-accent-1 hover:text-yellow-700">Lihat Semua</a>
            </div>
        @endif
    </div>

    {{-- youtube channel --}}
    <div class="max-w-full bg-cover"
        style="background-image: url({{ asset('images/backgrounds/bg1.png') }}); background-position: center;">
        <div class="max-w-screen-lg mx-auto p-5 py-8 lg:py-10 text-accent-4">
            <h1 class="text-3xl text-center text-accent-2">Youtube Channel SMA Ma'arif Pacet</h1>
            <div class="splide mt-5" id="splide2" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        {{-- <li class="splide__slide">
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
                    </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- testimonials --}}
    <div class="max-w-screen-lg mx-auto p-5 py-8 lg:py-10">
        <h1 class="text-3xl text-center text-accent-1">Sebaran Alumni</h1>
        <div class="splide mt-5" id="splide3" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($testimonials as $testimonial)
                        <li class="splide__slide">
                            <div class="flex flex-col gap-2 p-3">
                                <p class="text-center">"{{ $testimonial->feedback }}"</p>
                                <div class="flex gap-2 mt-2">
                                    <img src="{{ asset('storage/testimonialImages/' . $testimonial->image) }}"
                                        alt="" class="w-[50px] h-[50px] rounded-full object-cover">
                                    <div class="flex flex-col">
                                        <span>{{ $testimonial->name }}</span>
                                        <span class="text-accent-1">{{ $testimonial->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- alumni --}}
    <div class="p-5 py-8 lg:py-10"
        style="background-image: url({{ asset('images/svgs/Wave.svg') }});
            background-position: bottom;
            background-size: contain;
            background-repeat: repeat-x;
    ">
        <h1 class="text-3xl text-center text-accent-1">Sponsors</h1>
        <div class="max-w-screen-lg mx-auto">
            <div class="splide mt-5 " id="splide4" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                        <li class="splide__slide">
                            <img src="{{ asset('images/logos/logo1a.png') }}" alt=""
                                class="w-full aspect-square">
                        </li>
                    </ul>
                </div>
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
        new Splide('#splide2', {
            perPage: 3,
            gap: 10,
            breakpoints: {
                640: {
                    perPage: 1
                }
            }
        }).mount();
        new Splide('#splide3', {
            type: 'loop',
            arrows: false,
            perPage: 2,
            gap: 10,
            breakpoints: {
                640: {
                    perPage: 1
                }
            }
        }).mount();
        new Splide('#splide4', {
            type: 'loop',
            autoplay: true,
            arrows: false,
            perPage: 5,
            gap: 20,
            breakpoints: {
                640: {
                    perPage: 4
                }
            }
        }).mount();
    </script>
@endsection
