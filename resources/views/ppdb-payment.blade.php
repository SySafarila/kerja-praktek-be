@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5">
    <img src="{{ asset('images/banners/PPDB.png') }}" alt="" class="w-full">
</div>
<div class="max-w-screen-lg mx-auto p-5">
    @if (session('error'))
        <div class="bg-red-200 p-3 border border-red-300 mb-2">
            {{ session('error') }}
        </div>
    @endif
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
            @if (in_array($transaction->transaction_status, ['pending', 'expire']))
                <div class="group relative">
                    <button type="button" class="btn bg-accent-1 border border-accent-1 text-accent-4 w-full text-center capitalize" onclick="event.preventDefault();">Ganti Metode Pembayaran</button>
                    <div class="absolute left-0 top-12 w-full hidden flex-col gap-2 bg-white p-3 rounded-lg group-focus-within:flex lg:max-h-72 lg:overflow-y-auto border border-gray-200">
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'qris']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">QRIS</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'va_bca']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">BCA Virtual Account</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'va_bni']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">BNI Virtual Account</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'va_bri']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">BRI Virtual Account</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'va_permata']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">Permata Virtual Account</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'va_cimb']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">CIMB Virtual Account</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'gopay']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">GoPay</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'shopeepay']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">ShopeePay</a>
                        <a href="{{ route('ppdb.payment', ['update_payment' => 'offline']) }}" class="bg-white text-accent-1 btn border border-accent-1 text-center">Bayar Di Sekolah</a>
                    </div>
                </div>
            @endif
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
    @if (in_array($transaction->payment_method, ['va_bca', 'va_bni', 'va_bri', 'va_permata', 'va_cimb']))
        <script>
            const copy_va = document.getElementById('copy_va')
            const va = document.getElementById('va')

            copy_va.addEventListener('click', (e) => {
                e.preventDefault()
                navigator.clipboard.writeText(va.innerText)

                alert('Virtual Account berhasil di copy!')
            })
        </script>
    @endif
@endsection
