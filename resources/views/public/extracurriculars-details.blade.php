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
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-screen-lg mx-auto p-5 grid lg:grid-cols-12 gap-5">
        <div class="bg-white lg:col-span-8">

            <img src="{{ asset('storage/extracurricularImages/' . $extracurriculars->image) }}" class="w-full"
                alt="">
            <div class="mt-2 flex flex-col p-5">
                <p class="-my-2 text-sm"><i class="fa fa-calendar text-sm text-accent-1"></i>
                    {{ Carbon\Carbon::parse($extracurriculars->created_at)->format('d F Y') }}</p>
                <p class="whitespace-pre-line">
                    {{ $extracurriculars->description }}
                </p>
                <p class="mt-4">Extrakurikuler Lainnnya :</p>
                <div class="flex flex-col font-semibold">
                    @foreach ($eskul as $item)
                        <span>-
                            <a class="hover:underline"
                                href="{{ route('extracurriculars.show', ['id' => $item->id]) }}">{{ $item->name }}</a>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
            <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">{{ $extracurriculars->name }}</h2>
            <div class="flex flex-col mt-5">
                <p class="font-semibold ">Pembimbing :</p>

                @if($extracurriculars->mentor)
                    <img src="{{ asset('storage/teacherImages/' . $extracurriculars->mentor->image) }}"
                        class="w-full h-80 px-5 my-2 object-cover" alt="">
                    <p class="text-sm align-middle">{{ $extracurriculars->mentor->name }}</p>
                    <p class="text-sm align-middle">NUPTK : {{ $extracurriculars->mentor->nuptk }}</p>
                @else
                    <div class="text-red-500">No mentor assigned yet</div>
                @endif

                <p class="font-semibold mt-2">Jadwal & Lokasi :</p>
                <p class="text-sm align-middle"><i class="fas fa-map-marker-alt text-accent-1"></i>
                    {{ $extracurriculars->location }} - SMA Ma'arif Pacet</p>

                    @if(is_array($extracurriculars->schedule))
                    <p class="text-sm align-middle"><i class="fas fa-calendar text-accent-1"></i>
                        {{ implode(', ', $extracurriculars->schedule) }}
                    </p>
                @else
                    @php
                        $scheduleArray = json_decode($extracurriculars->schedule);
                    @endphp
                    <p class="text-sm align-middle"><i class="fas fa-calendar text-accent-1"></i>
                        {{ implode(', ', $scheduleArray) }}
                    </p>
                @endif
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
