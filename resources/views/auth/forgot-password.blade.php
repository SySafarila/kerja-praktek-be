@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="max-w-screen-sm mx-auto p-5 my-10">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('images/logos/logo1a.png') }}" alt="" class="w-[184px] aspect-square">
            <h1 class="uppercase font-bold text-4xl text-black">SMA Ma'arif Pacet</h1>
            <h2 class="border-b border-accent-5 px-5 text-2xl">Lupa Password</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <p class="text-sm pt-4">lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan
                mengirimkan email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.</p>

            <form action="{{ route('password.email') }}" method="post" class="flex flex-col gap-3 w-full" id="login">
                @csrf
                <input type="email" name="email" :value="old('email')" required autofocus id="email"
                    class="w-full border-gray-500 border outline-none rounded-lg" placeholder="Email address">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <button
                    class="btn bg-accent-1 uppercase text-accent-4 hover:text-accent-1 hover:bg-white border border-accent-1">Reset
                    Password</button>
            </form>
            <div class="flex flex-col w-full">

                <p class="text-sm mb-2">Belum mempunyai akun? <a href="{{ route('register') }}"
                        class="text-accent-1 hover:text-yellow-600 font-semibold">klik disini</a>.</p>
                {{-- <a href="{{ route('register') }}"
                    class="btn bg-white border text-center border-accent-1 text-accent-1 uppercase hover:bg-accent-1  hover:text-accent-4">Daftar</a> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
