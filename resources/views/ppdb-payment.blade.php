@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5">
    <img src="{{ asset('images/ppdb.png') }}" alt="" class="w-full">
</div>
<div class="max-w-screen-lg mx-auto p-5">
    <h1 class="text-2xl font-bold mb-5">Pembayaran</h1>
    <div class="grid lg:grid-cols-3 gap-5">
        <div class="flex flex-col gap-3">
            <div class="flex flex-col gap-3">
                <span class="text-xl font-semibold">Ayo selesaikan pendaftaran kamu</span>
                <div class="flex justify-between items-center border-b border-accent-3 pb-3" id="payment_va">
                    <span class="font-semibold">BCA Virtual Account</span>
                    <img src="{{ asset('images/BCA.png') }}" alt="" class="h-[24px] w-auto">
                </div>
                <div class="flex justify-between items-center border-b border-accent-3 pb-3 hidden" id="payment_school">
                    <span class="font-semibold">Bayar Di Sekolah</span>
                    <img src="{{ asset('images/logo.png') }}" alt="" class="h-[24px] w-auto">
                </div>
                <div class="flex justify-between items-center border-b border-accent-3 pb-3 hidden" id="payment_qris">
                    <span class="font-semibold">QRIS</span>
                    <img src="{{ asset('images/qris.png') }}" alt="" class="h-[24px] w-auto">
                </div>
            </div>
            <div class="flex flex-col" id="payment_va_detail">
                <span>Nomor Virtual Account</span>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-semibold" id="va">80777082117694132</span>
                    <span class="uppercase cursor-pointer text-accent-1 font-semibold" id="copy_va">Copy</span>
                </div>
            </div>
            <div class="flex flex-col hidden" id="payment_school_detail">
                <span>Nomor Pendaftaran</span>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-semibold">123123</span>
                </div>
            </div>
            <div class="flex flex-col hidden" id="payment_qris_detail">
                <span class="block text-center">Scan QR Code</span>
                <img src="{{ asset('images/qr.png') }}" alt="" class="w-40 mx-auto">
                <p class="text-center">Dapat digunakan dengan GoPay, OVO, dan aplikasi sejenis yang mendukung QRIS</p>
            </div>
            <div class="flex justify-between">
                <div>
                    <span>Total Pembayaran</span>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">Rp 150,000</span>
                    </div>
                </div>
                <div>
                    <span>Berlaku Sampai</span>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">30 Oktober 2023</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-5 lg:flex-col lg:gap-3">
                <a href="#" class="btn bg-accent-1 text-accent-4 w-full text-center capitalize">Hubungi admin</a>
                <a href="#"
                    class="btn bg-white border border-accent-1 text-accent-1 w-full text-center capitalize">Refresh</a>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <span class="text-xl font-semibold">Data Calon Siswa Terkait</span>
            <div class="flex flex-col">
                <span class="block">NISN</span>
                <span class="text-xl font-semibold block">000 000 000</span>
            </div>
            <div class="flex flex-col">
                <span class="block">Nama Siswa</span>
                <span class="text-xl font-semibold block">Syahrul Safarila</span>
            </div>
            <div class="flex flex-col">
                <span class="block">Asal Sekolah</span>
                <span class="text-xl font-semibold block">SMP Negeri 1 Warungkondang</span>
            </div>
        </div>
        <form action="#" method="POST" class="flex flex-col gap-3">
            <span class="text-xl font-semibold">Upload Berkas</span>
            <div class="flex flex-col gap-1.5">
                <label id="kk" class="font-semibold capitalize">Kartu Keluarga <span
                        class="text-red-500">*</span></label>
                <input type="file" name="" id="kk"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5">
            </div>
            <div class="flex flex-col gap-1.5">
                <label id="akta" class="font-semibold capitalize">Akta Kelahiran <span
                        class="text-red-500">*</span></label>
                <input type="file" name="" id="akta"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5">
            </div>
            <div class="flex flex-col gap-1.5">
                <label id="kip" class="font-semibold capitalize">KIP</label>
                <input type="file" name="" id="kip"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5">
            </div>
            <div class="flex flex-col gap-1.5">
                <label id="pkh" class="font-semibold capitalize">PKH</label>
                <input type="file" name="" id="pkh"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5">
            </div>
            <button type="submit" class="btn bg-accent-1 text-accent-4 lg:w-fit">Upload</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    const copy_va = document.getElementById('copy_va')
    const va = document.getElementById('va')

    copy_va.addEventListener('click', (e) => {
        e.preventDefault()
        navigator.clipboard.writeText(va.innerText)

        alert('Virtual Account berhasil di copy!')
    })
</script>
@endsection
