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
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">MATA PELAJARAN SMA MA'ARIF PACET</h1>

                    <div class="flex justify-between text-sm pt-8">
                        <span class="text-white">
                            {{-- Display user's local date and time in Indonesian format --}}
                            <p class="text-accent-4" id="user-local-date-time"></p>
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-lg mx-auto">
        <img src="{{ asset('images/photos/photo4.png') }}" class="w-full h-72 lg:h-96 object-cover mt-8" alt="">
        <div class="bg-white p-4 my-8 font-semibold">
            <h1 class="text-xl text-center">MATA PELAJARAN</h1>
            <div class="grid grid-cols-3 text-center px-8 py-4">
                @foreach (['10', '11', '12'] as $grade)
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">Kelas {{ $grade }}</h2>
                        @foreach ($subjects->where('grade', $grade) as $subject)
                            <span>{{ $subject->name }}</span><br>
                        @endforeach
                    </div>
                @endforeach
            </div>

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

        });
    </script>
@endsection
