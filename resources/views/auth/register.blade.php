@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-sm mx-auto p-5 my-10">
    <div class="flex flex-col items-center gap-4">
        <img src="{{ asset('images/logo.png') }}" alt="" class="w-[184px] aspect-square">
        <h1 class="uppercase font-bold text-4xl text-black">SMA Ma'arif</h1>
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
</div>
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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
