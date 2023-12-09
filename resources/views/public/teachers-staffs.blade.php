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
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">GURU DAN STAFF SMA MA'ARIF PACET</h1>

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

    <h1 class="text-5xl border-b-2 border-accent-1 w-fit mx-auto my-8">Staffs</h1>
    {{-- <div class="max-w-screen-lg mx-auto">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 mt-4 mb-2 mx-auto justify-center">
            @foreach ($staffs as $staff)
                <div class="w-72 h-96 relative">
                    <div
                        class="flex flex-col bg-gradient-to-t from-[#356f11bb] to-transparent absolute text-center bottom-0 left-0 right-0">
                        <h3 class="text-accent-2 text-2xl font-light">{{ $staff->name }}</h3>
                        <div class="border-b-2 border-yellow-300 mx-12"></div>
                        <span class="text-accent-2 text-sm mt-1">{{ $staff->position }}</span>
                        <span class="text-accent-2 text-sm mb-2">NIP: {{ $staff->nip }}</span>
                    </div>
                    <img src="{{ asset('storage/staffImages/' . $staff->image) }}" class="w-full h-full object-cover" />
                </div>
            @endforeach
        </div>
    </div> --}}

    <div class="max-w-screen-lg mx-auto">
        <div
            class="grid grid-cols-1 mx-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 mt-4 mb-2 mx-auto justify-center">
            @foreach ($staffs as $staff)
                <div class="relative bg-gradient-to-t from-[#356f11bb] to-transparent overflow-hidden rounded-md">
                    <img src="{{ asset('storage/staffImages/' . $staff->image) }}" class="w-full h-96 object-cover" />
                    <div class="absolute inset-0 flex flex-col justify-end p-4">
                        <h3 class="text-accent-2 text-xl font-light mb-1">{{ $staff->name }}</h3>
                        <div class="border-b-2 border-yellow-300 mb-1"></div>
                        <span class="text-accent-2 text-sm">{{ $staff->position }}</span>
                        <span class="text-accent-2 text-sm mb-2 block">NIP: {{ $staff->nip }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h1 class="text-5xl border-b-2 border-accent-1 w-fit mx-auto my-8">Teachers</h1>
    {{-- <div class="max-w-screen-lg mx-auto mb-8">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 mt-4 mb-2 mx-auto justify-center">
            @foreach ($teachers as $teacher)
                <div class="w-72 h-96 relative">
                    <div
                        class="flex flex-col bg-gradient-to-t from-[#356f11bb] to-transparent absolute text-center bottom-0 left-0 right-0">
                        <h3 class="text-accent-2 text-2xl font-light">{{ $teacher->name }}</h3>
                        <div class="border-b-2 border-yellow-300 mx-12"></div>
                        <span class="text-accent-2 text-sm mt-1">Guru

                            @if ($teacher->subjects->isNotEmpty())
                                {{ $teacher->subjects->first()->name }}
                            @else
                                No subjects assigned
                            @endif
                        </span>
                        <span class="text-accent-2 text-sm mb-2">{{ $teacher->nuptk }}</span>
                    </div>
                    <img src="{{ asset('storage/teacherImages/' . $teacher->image) }}"
                        class="w-full h-full object-cover" />
                </div>
            @endforeach
        </div>
    </div> --}}

    <div class="max-w-screen-lg mx-auto">
        <div
            class="grid grid-cols-1 mx-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 mt-4 mb-2 mx-auto justify-center">
            @foreach ($teachers as $teacher)
                <div class="relative bg-gradient-to-t from-[#356f11bb] to-transparent overflow-hidden rounded-md">
                    <img src="{{ asset('storage/teacherImages/' . $teacher->image) }}" class="w-full h-96 object-cover" />
                    <div class="absolute inset-0 flex flex-col justify-end p-4">
                        <h3 class="text-accent-2 text-xl font-light mb-1">{{ $teacher->name }}</h3>
                        <div class="border-b-2 border-yellow-300 mb-1"></div>
                        <span class="text-accent-2 text-sm">@if ($teacher->subjects->isNotEmpty())
                            {{ $teacher->subjects->first()->name }}
                        @else
                            No subjects assigned
                        @endif</span>
                        <span class="text-accent-2 text-sm mb-2 block">NUPTK: {{ $teacher->nuptk }}</span>
                    </div>
                </div>
            @endforeach
        </div>
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
