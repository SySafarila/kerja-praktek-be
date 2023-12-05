@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-sm mx-auto p-5">
    <div class="flex flex-col items-center gap-4">
        <img src="{{ asset('images/logo.png') }}" alt="" class="w-[184px] aspect-square">
        <h1 class="uppercase font-bold text-4xl text-black">SMA Ma'arif</h1>
        <h2 class="border-b border-accent-5 px-5 text-2xl">Masuk</h2>
        <form action="#" method="post" class="flex flex-col gap-3 w-full" id="login">
            <input type="email" class="w-full border-gray-500 border outline-none rounded-lg" placeholder="Email">
            <input type="password" class="w-full border-gray-500 border outline-none rounded-lg" id="password"
                placeholder="Password">
            <div class="flex items-center gap-2 justify-end" id="password-toggle">
                <input type="checkbox" class="rounded" name="" id="password-toggle-status">
                <label class="select-none" for="password-toggle">Tampilkan Password</label>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <input type="checkbox" class="rounded" name="" id="remember">
                    <label class="select-none" for="remember">Ingat Saya</label>
                </div>
                <a href="#">Lupa password?</a>
            </div>
            <button class="btn bg-accent-1 uppercase text-accent-4">Masuk</button>
        </form>
    </div>
</div>
<div class="max-w-screen-sm mx-auto p-5">
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
