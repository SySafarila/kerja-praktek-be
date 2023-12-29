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
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl">BERITA SMA MA'ARIF PACET</h1>

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
        <div class="bg-white lg:col-span-8 p-5">
            <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Berita Terbaru</h2>
            <div class="mt-5 flex flex-col gap-5">
                @if ($latestNews->isEmpty())
                    <p class="text-center mt-8 text-xl text-accent-3/50">There's no news published yet</p>
                @else
                    @foreach ($latestNews as $item)
                        <a href="{{ route('news.show', ['id' => $item->id]) }}"
                            class="flex gap-5 flex-col lg:flex-row group pb-4 border-b-2">
                            @php
                                $firstImage = '';
                                preg_match('/<img[^>]+src="([^"]+)"[^>]*>/i', $item->body, $matches);
                                if (!empty($matches[1])) {
                                    $firstImage = $matches[1];
                                }
                            @endphp
                            <img src="{{ $firstImage ?: asset('images/dummy/news.png') }}" alt=""
                                class="w-full lg:w-60 aspect-video object-cover">
                            <div class="flex flex-col justify-between gap-5 py-2">
                                <div class="flex flex-col gap-3">
                                    <h1 class="font-semibold group-hover:underline">{{ $item->title }}</h1>
                                    <p class="line-clamp-3">
                                        {{ implode(' ', array_slice(str_word_count(strip_tags($item->body), 1), 0, 16)) }}
                                    </p>

                                </div>
                                <span class="text-sm">{{ $item->created_at->format('F d, Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="bg-white lg:col-start-9 lg:col-end-13 p-5">
            <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Berita Lainnya</h2>
            <div class="flex flex-col gap-3 mt-5">
                @foreach ($randomNews as $item)
                    <a href="{{ route('news.show', ['id' => $item->id]) }}"
                        class="hover:text-accent-1">{{ $item->title }}</a>
                @endforeach
            </div>
            <h2 class="text-accent-1 font-bold text-2xl border-b-4 border-accent-1 w-fit">Pranara Luar</h2>
            <div class="mt-5 flex flex-col ">
                <a href="" class="hover:text-accent-1">Facebook</a>
                <a href="" class="hover:text-accent-1">Instagram</a>
                <a href="" class="hover:text-accent-1">YouTube</a>
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
        });
    </script>
@endsection
