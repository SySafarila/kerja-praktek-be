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
                @if ($transaction->payment_method == 'va_bca')
                    <x-public.payment.va-bca />
                @endif
                @if ($transaction->payment_method == 'va_bni')
                    <x-public.payment.va-bni />
                @endif
                @if ($transaction->payment_method == 'va_bri')
                    <x-public.payment.va-bri />
                @endif
                @if ($transaction->payment_method == 'va_permata')
                    <x-public.payment.va-permata />
                @endif
                @if ($transaction->payment_method == 'offline')
                    <x-public.payment.school />
                @endif
                @if ($transaction->payment_method == 'qris')
                    <x-public.payment.qris />
                @endif
                @if ($transaction->payment_method == 'gopay')
                    <x-public.payment.gopay />
                @endif
                @if ($transaction->payment_method == 'shopeepay')
                    <x-public.payment.shopeepay />
                @endif
            </div>
            @if ($transaction->transaction_status == 'pending')
                @if (in_array($transaction->payment_method, ['va_bca', 'va_bni', 'va_bri', 'va_permata', 'va_cimb']))
                    <div class="flex flex-col" id="payment_va_detail">
                        <span>Nomor Virtual Account</span>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold" id="va">{{ $transaction->virtual_account }}</span>
                            <span class="uppercase cursor-pointer text-accent-1 font-semibold" id="copy_va">Copy</span>
                        </div>
                    </div>
                @endif
                @if ($transaction->payment_method == 'offline')
                    <div class="flex flex-col" id="payment_school_detail">
                        <span>Nomor Pendaftaran</span>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold">{{ $transaction->order_id }}</span>
                        </div>
                    </div>
                @endif
                @if ($transaction->payment_method == 'qris')
                    <div class="flex flex-col" id="payment_qris_detail">
                        <span class="block text-center">Scan QR Code</span>
                        <img src="{{ $transaction->link_qr_code }}" alt="" class="w-60 mx-auto">
                        <p class="text-center">Dapat digunakan dengan GoPay, OVO, dan aplikasi sejenis yang mendukung QRIS</p>
                    </div>
                @endif
                @if ($transaction->payment_method == 'gopay')
                    <div class="flex flex-col" id="payment_qris_detail">
                        <span class="block text-center">Scan QR Code</span>
                        <img src="{{ $transaction->link_qr_code }}" alt="" class="w-60 mx-auto">
                        <p class="text-center">Dapat digunakan dengan GoPay, OVO, dan aplikasi sejenis yang mendukung QRIS</p>
                        <p class="text-center py-2.5">Atau</p>
                        <a href="{{ $transaction->link_deeplink }}" class="bg-accent-1 btn mx-auto text-center flex items-center gap-1.5">
                            <span class="text-accent-4">Buka Aplikasi</span>
                            <span class="material-icons-outlined text-accent-4 text-sm">open_in_new</span>
                        </a>
                    </div>
                @endif
                @if ($transaction->payment_method == 'shopeepay')
                    <div class="flex flex-col" id="payment_qris_detail">
                        <a href="{{ $transaction->link_deeplink }}" class="bg-accent-1 btn mx-auto text-center flex items-center gap-1.5">
                            <span class="text-accent-4">Buka Aplikasi</span>
                            <span class="material-icons-outlined text-accent-4 text-sm">open_in_new</span>
                        </a>
                    </div>
                @endif
            @endif
            @if ($transaction->transaction_status == 'settlement')
                <div class="bg-accent-1/25 p-3 border border-accent-1" id="settlement">
                    <p>Pembayaran telah diterima, langkah selanjutnya:</p>
                    <ul class="list-disc list-inside">
                        <li>Upload berkas yang diperlukan</li>
                    </ul>
                </div>
            @endif
            @if ($transaction->transaction_status == 'expire')
                <div class="bg-red-200 p-3 border border-red-300" id="settlement">
                    <p>Pembayaran telah kadaluarsa, mohon perbarui metode pembayaranmu untuk melanjutkan pendaftaran.</p>
                </div>
            @endif
            <div class="flex justify-between">
                <div>
                    <span>Total Pembayaran</span>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">Rp {{ number_format($transaction->gross_amount, 0) }}</span>
                    </div>
                </div>
                @if ($transaction->transaction_status == 'pending')
                    <div>
                        <span>Berlaku Sampai</span>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->addDays(31)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                @endif
                @if ($transaction->transaction_status == 'settlement')
                    <div>
                        <span>Terverifikasi Pada</span>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold">{{ \Carbon\Carbon::parse($transaction->settlement_time)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex justify-between gap-5 lg:flex-col lg:gap-3">
                <a href="https://wa.me/6282117694132" target="__blank" class="btn bg-accent-1 text-accent-4 w-full text-center capitalize">Hubungi admin</a>
                <button type="button" class="btn bg-white border border-accent-1 text-accent-1 w-full text-center capitalize" onclick="event.preventDefault();location.reload()">Refresh</button>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <span class="text-xl font-semibold">Data Calon Siswa Terkait</span>
            <div class="flex flex-col">
                <span class="block">NISN</span>
                <span class="text-xl font-semibold block">{{ $student->nisn }}</span>
            </div>
            <div class="flex flex-col">
                <span class="block">Nama Siswa</span>
                <span class="text-xl font-semibold block">{{ $student->full_name }}</span>
            </div>
            <div class="flex flex-col">
                <span class="block">Asal Sekolah</span>
                <span class="text-xl font-semibold block">{{ $student->last_school }}</span>
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
