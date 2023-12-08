@extends('layouts.public')

@section('head')
    <title class="uppercase">{{ $news->title }} | SMA MA'ARIF PACET CIANJUR</title>
    <style>
        body {
            background: #ECECEC;
        }
    </style>
@endsection

@section('content')
    <div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
        <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
            <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">>
                <div
                    class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl uppercase">{{ $news->title }}
                    </h1>
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
        <div class="bg-white lg:col-span-8">
                {{-- <img src="{{ asset('images/dummy/news.png') }}" alt="" class="w-full aspect-video object-cover"> --}}
                <img src="{{ $imageUrl ?: asset('images/dummy/news.png') }}" alt="" class="w-full aspect-video object-cover">
            <div class="p-5">
                <div class="flex justify-center gap-2 flex-col mb-3">
                    <div class="flex items-center gap-2">
                        <div class="flex lg:items-center gap-2">
                            <span class="material-icons-outlined text-accent-1 text-sm lg:-mt-0.5">
                                calendar_today
                            </span>
                            <span class="text-sm">{{ $news->created_at->format('d F Y') }}</span>

                        </div>
                        <div class="flex lg:items-center gap-2">
                            <span class="material-icons text-accent-1 text-sm lg:-mt-0.5">
                                location_on
                            </span>
                            <span class="text-sm">Cianjur - SMA Ma'arif</span>
                        </div>
                    </div>
                    {{-- <div class="flex lg:items-center gap-2">
                        <span class="material-icons text-accent-1 text-sm lg:-mt-0.5">
                            folder_open
                        </span>
                        <span class="text-sm capitalize">{{ $news->title }}</span>
                    </div> --}}
                </div>
                <p class="whitespace-pre-line">
                    {!! $news->body !!}
                </p>
            </div>
        </div>
        <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
            <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Berita Lainnya</h2>
            <div class="flex flex-col gap-3 mt-5">
                @foreach ($randomNews as $item)
                    <a href="{{ route('news.show', ['id' => $item->id]) }}" class="hover:underline">{{ $item->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Display user's local date and time in Indonesian format
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

            // Add a space if both date/time and location are displayed
            const userLocationElement = document.getElementById('user-location');
            const userLocation = 'Your Location'; // Replace with actual user location if available
            userLocationElement.textContent = userLocation ? ` ${userLocation}` : '';
        });
    </script>
@endsection
