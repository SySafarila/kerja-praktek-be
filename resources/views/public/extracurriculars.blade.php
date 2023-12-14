@extends('layouts.public')

@section('head')
    <style>
        body {
            background: #ECECEC;
        }
    </style>
@endsection

@section('content')
    <div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
        <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
            <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
                <div
                    class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">EKSTRAKURIKULER SMA MA'ARIF PACET</h1>

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
    <div class="my-10">
        @if ($extracurriculars->isEmpty())
            <p class="text-center my-32 text-xl text-accent-3/50">There's no extracurriculars published yet</p>
        @else
            <div class="max-w-screen-lg mx-auto bg-white">
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl mt-4 font-bold text-accent-1">EKSTRAKURIKULER</h1>
                    <div class="border-b-4 border-accent-1 mb w-[400px] mb-1"></div>
                    <div class="border-b-4 border-accent-1 mb w-[300px]"></div>
                </div>
                <div class="grid grid-cols-2 gap-x-8 gap-y-6 mx-8 py-8">
                    @foreach ($extracurriculars as $item)
                        <a href="{{ route('extracurriculars.show', ['id' => $item->id]) }}"
                            class="group relative block transition-transform transform hover:scale-105">
                            <img src="{{ asset('storage/extracurricularImages/' . $item->image) }}"
                                class="w-full h-72 object-cover rounded-lg " alt="">
                            <div
                                class="absolute bottom-0 left-0 w-full bg-accent-1/70 text-center text-white p-2 font-semibold rounded-b-lg">
                                {{ $item->name }}
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
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
