@extends('layouts.public')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        body {
            background: #ECECEC;
        }

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
    <div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
        <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
            <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
                <div
                    class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">GALERI KEGIATAN SMA MA'ARIF PACET</h1>

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

    <div class="max-w-screen-lg mx-auto my-8">
        <div class="splide" id="splide1" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 1.png') }}" alt=""
                            class="aspect-video w-full h-[400px] object-cover">
                    </li>
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 2.png') }}" alt=""
                            class="aspect-video w-full h-[400px] object-cover">
                    </li>
                    <li class="splide__slide">
                        <img src="{{ asset('images/banners/Welcome 3.png') }}" alt=""
                            class="aspect-video w-full h-[400px] object-cover">
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="max-w-screen-lg mx-auto my-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-4">
            @foreach ($galleries as $item)
            <a href="{{route('galleries.show', ['id' => $item->id])}}" class="block transition-transform transform hover:scale-105 ">
                <div class="relative">
                    <img class="w-full h-58 object-cover z-0" src="{{ asset('storage/galleryThumbnails/' . $item->thumbnail) }}" alt="">
                    <div class="absolute bottom-0 left-0 right-0 bg-accent-1/50 z-10 text-accent-2 text-center py-1 ">
                        {{$item->title}}
                    </div>
                </div>
            </a>
            @endforeach
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userLocalDateTimeElement = document.getElementById('user-local-date-time');
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                timeZoneName: 'short'
            };
            const userLocalDateTime = new Date().toLocaleDateString('id-ID', options);
            userLocalDateTimeElement.textContent = userLocalDateTime;

            const userLocationElement = document.getElementById('user-location');
            const userLocation = 'Your Location';
            userLocationElement.textContent = userLocation ? ` ${userLocation}` : '';
        });
    </script>
@endsection
