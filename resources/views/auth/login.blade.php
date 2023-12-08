@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="max-w-screen-sm mx-auto p-5 my-10">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('images/logos/logo1a.png') }}" alt="" class="w-[184px] aspect-square">
            <h1 class="uppercase font-bold text-4xl text-black">SMA Ma'arif Pacet</h1>
            <h2 class="border-b border-accent-5 px-5 text-2xl">Masuk</h2>

            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-3 w-full" id="login">
                @csrf

                <x-input-error :messages="$errors->get('email')" class=" text-red-600" />
                <x-input-error :messages="$errors->get('password')" class=" text-red-600" />
                {{-- email --}}
                <input type="email" class="w-full border-gray-500 border outline-none rounded-lg " placeholder="Email"
                    id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username">

                <input type="password" class="w-full border-gray-500 border outline-none rounded-lg" id="password"
                    placeholder="Password" name="password" required autocomplete="current-password">
                {{-- password --}}
                <div class="flex items-center gap-2 justify-end" id="password-toggle">
                    <input type="checkbox" class="rounded" name="" id="password-toggle-status" id="password">
                    <label class="select-none text-sm" for="password-toggle">Tampilkan Password</label>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" class="rounded" name="remember" id="remember_me">
                        <label class="select-none text-sm" for="remember" id="remember_me">Ingat Saya</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm hover:underline">Lupa password?</a>
                    @endif

                </div>
                <button class="btn bg-accent-1 uppercase text-accent-4 hover:text-accent-1 hover:bg-white border border-accent-1">Masuk</button>
            </form>
            <div class="flex flex-col w-full">

                <p class="text-sm mb-2">Belum mempunyai akun? <a href="{{ route('register') }}" class="text-accent-1 hover:text-yellow-600 font-semibold">klik disini</a>.</p>
                {{-- <a href="{{ route('register') }}"
                    class="btn bg-white border text-center border-accent-1 text-accent-1 uppercase hover:bg-accent-1  hover:text-accent-4">Daftar</a> --}}
            </div>
        </div>
    </div>
    {{-- <div class="max-w-screen-sm mx-auto p-5">
    <div class="flex flex-col items-center gap-4">
        <h2 class="border-b border-accent-5 px-5 text-2xl">Daftar</h2>
        <form action="#" method="post" class="flex flex-col gap-3 w-full" id="register">
            <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" placeholder="Nama Lengkap">
            <input type="email" class="w-full border-gray-500 border outline-none rounded-lg" placeholder="Email">
            <input type="password" class="w-full border-gray-500 border outline-none rounded-lg" placeholder="Password">
            <input type="password" class="w-full border-gray-500 border outline-none rounded-lg"
                placeholder="Konfirmasi Password">
            <div class="flex gap-2">
                <input type="checkbox" class="rounded mt-[5px]" name="" id="syarat-dan-ketentuan">
                <label class="select-none" for="syarat-dan-ketentuan">Dengan mencentang kotak, Anda telah setuju untuk
                    mematuhi <a href="#" class="text-accent-1">Syarat dan Ketentuan</a>. Saya juga menyatakan bahwa saya
                    adalah pemilik data yang sebenar-benarnya.</label>
            </div>
            <button class="btn bg-accent-1 uppercase text-accent-4">Daftar Sekarang</button>
        </form>
    </div>
</div> --}}
@endsection

@section('script')
    <script>
        const passwordToggle = document.getElementById('password-toggle');
        const passwordToggleStatus = document.getElementById('password-toggle-status');
        const password = document.querySelector('#login #password')

        passwordToggle.addEventListener('click', (e) => {
            if (password.type == 'password') {
                password.type = 'text'
                passwordToggleStatus.checked = true
            } else {
                password.type = 'password'
                passwordToggleStatus.checked = false
            }
        })
    </script>
@endsection

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
