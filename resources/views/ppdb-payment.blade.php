@php
    function exchange($payment_method) {
        switch ($payment_method) {
            case 'va_bca':
                return 'BCA Virtual Account';
                break;

            case 'va_bni':
                return 'BNI Virtual Account';
                break;

            case 'va_bri':
                return 'BRI Virtual Account';
                break;

            case 'va_permata':
                return 'Permata Virtual Account';
                break;

            case 'va_cimb':
                return 'CIMB Virtual Account';
                break;

            case 'gopay':
                return 'GoPay';
                break;

            case 'shopeepay':
                return 'ShopeePay';
                break;

            case 'qris':
                return 'QRIS';
                break;

            case 'offline':
                return 'Bayar di sekolah';
                break;

            default:
                return '-';
                break;
        }
    }
@endphp
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
    @if (session('success'))
        <div class="bg-accent-1/25 p-3 border border-accent-1 mb-2">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-2xl font-bold mb-5">Pembayaran</h1>
    <div class="grid lg:grid-cols-3 gap-5">
        <div class="flex flex-col gap-3">
            <div class="flex flex-col gap-3">
                @if (in_array($transaction->transaction_status, ['pending', 'expire', 'cancel']))
                    <span class="text-xl font-semibold">Ayo selesaikan pendaftaran kamu</span>
                @else
                    <span class="text-xl font-semibold border-l-4 border-accent-1 pl-2.5 rounded-[4px]">Pembayaran telah selesai</span>
                @endif
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
                @if ($transaction->payment_method == 'qris')
                    <div class="flex flex-col" id="payment_qris_detail">
                        <span class="block text-center">Scan QR Code</span>
                        <img src="{{ $transaction->link_qr_code }}" alt="" class="w-60 mx-auto">
                        <p class="text-center">Dapat digunakan dengan GoPay, OVO, dan aplikasi lain yang memiliki fitur QRIS</p>
                    </div>
                @endif
                @if ($transaction->payment_method == 'gopay')
                    <div class="flex flex-col" id="payment_qris_detail">
                        <span class="block text-center">Scan QR Code</span>
                        <img src="{{ $transaction->link_qr_code }}" alt="" class="w-60 mx-auto">
                        <p class="text-center">Dapat digunakan dengan GoPay, OVO, dan aplikasi lain yang memiliki fitur QRIS</p>
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
                    @if ($files->where('file_type', 'kk')->first() && $files->where('file_type', 'akta')->first())
                        <p><b>Pembayaran</b> dan <b>Berkas</b> kamu telah kami terima.</p>
                        @if (!$files->where('file_type', 'kip')->first() || !$files->where('file_type', 'pkh')->first())
                            <p>Silahkan tambahkan <b>Berkas</b> KIP/PKH jika ada.</p>
                        @endif
                    @else
                        <p><b>Pembayaran</b> telah diterima, langkah selanjutnya:</p>
                    @endif
                    <ul class="list-disc list-inside">
                        @if (!$files->where('file_type', 'kk')->first())
                            <li>
                                <a href="#upload-files" class="font-semibold underline">Upload berkas Kartu Kelahiran</a>
                            </li>
                        @endif
                        @if (!$files->where('file_type', 'akta')->first())
                            <li>
                                <a href="#upload-files" class="font-semibold underline">Upload berkas Akta Kelahiran</a>
                            </li>
                        @endif
                        @if (!$files->where('file_type', 'kip')->first())
                            <li>
                                <a href="#upload-files" class="font-semibold underline">Upload berkas KIP (Jika Ada)</a>
                            </li>
                        @endif
                        @if (!$files->where('file_type', 'pkh')->first())
                            <li>
                                <a href="#upload-files" class="font-semibold underline">Upload berkas PKH (Jika Ada)</a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            @if ($transaction->transaction_status == 'expire')
                <div class="bg-red-200 p-3 border border-red-300" id="settlement">
                    <p>Pembayaran telah kadaluarsa, mohon perbarui metode pembayaranmu untuk melanjutkan pendaftaran.</p>
                </div>
            @endif
            <div>
                <span>Nomor Pendaftaran</span>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-semibold">{{ $transaction->order_id ?? '-' }}</span>
                </div>
            </div>
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
                @if (!$transaction->settlement_time)
                    <button type="button" class="btn bg-white border border-accent-1 text-accent-1 w-full text-center capitalize" onclick="event.preventDefault();location.reload()">Refresh</button>
                @endif
            </div>
            @if (in_array($transaction->transaction_status, ['pending', 'expire']))
                <div class="group relative">
                    <button type="button" class="btn bg-accent-1 border border-accent-1 text-accent-4 w-full text-center capitalize" onclick="event.preventDefault();">Ganti Metode Pembayaran</button>
                    <div class="absolute left-0 top-12 w-full hidden flex-col gap-2 bg-white p-3 rounded-lg group-focus-within:flex lg:max-h-72 lg:overflow-y-auto border border-gray-200 z-10">
                        <form action="{{ route('ppdb.payment-update') }}" method="post" id="update-payment-method-form">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="update_payment_method" value="" required>
                        </form>
                        @foreach (explode(',', $payment_methods->value) as $payment_method)
                            <button type="{{ $transaction->payment_method == $payment_method ? 'button' : 'submit' }}" data-payment="{{ $payment_method }}" class="{{ $transaction->payment_method == $payment_method ? 'hidden' : '' }} bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">{{ exchange($payment_method) }}</button>
                        @endforeach
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
            <button type="button" class="btn bg-accent-1 text-accent-4 w-full text-center capitalize" id="student-detail-toggle">Lihat Detail</button>
        </div>
        <form action="{{ route('ppdb.upload-files') }}" method="POST" class="flex flex-col gap-3 relative" id="upload-files" enctype="multipart/form-data">
            @csrf
            @if ($transaction->transaction_status != 'settlement')
                <div class="-left-2.5 -top-2.5 w-[calc(100%+15px)] h-[calc(100%+15px)] backdrop-blur-[2px] absolute"></div>
            @endif
            <span class="text-xl font-semibold">Upload Berkas</span>
            <div class="flex flex-col gap-1.5" id="form-kk">
                <label id="kk" class="font-semibold capitalize flex items-center gap-2">
                    Kartu Keluarga
                    {!! $files->where('file_type', 'kk')->first() ? '' : '<span class="text-red-500">*</span>' !!}
                </label>
                <input type="file" name="kk" id="kk" accept="application/pdf,image/*"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5 {{ $files->where('file_type', 'kk')->first() ? 'hidden' : '' }}" {{ $files->where('file_type', 'kk')->first() ? '' : 'required' }}>
                @if ($files->where('file_type', 'kk')->first())
                    <p class="flex flex-col">
                        <span class="flex items-start break-all gap-1.5">{{ $files->where('file_type', 'kk')->first()->original_file_name }} {!! $files->where('file_type', 'kk')->first() ? '<span class="material-icons text-accent-1">check_circle</span>' : '' !!}</span> <small class="text-accent-1 cursor-pointer" id="reupload">Upload Ulang?</small>
                    </p>
                @endif
                @error('kk')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex flex-col gap-1.5" id="form-akta">
                <label id="akta" class="font-semibold capitalize flex items-center gap-2">
                    Akta Kelahiran
                    {!! $files->where('file_type', 'akta')->first() ? '' : '<span class="text-red-500">*</span>' !!}
                </label>
                <input type="file" name="akta" id="akta" accept="application/pdf,image/*"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5 {{ $files->where('file_type', 'akta')->first() ? 'hidden' : '' }}" {{ $files->where('file_type', 'akta')->first() ? '' : 'required' }}>
                @if ($files->where('file_type', 'akta')->first())
                <p class="flex flex-col">
                    <span class="flex items-start break-all gap-1.5">{{ $files->where('file_type', 'akta')->first()->original_file_name }} {!! $files->where('file_type', 'akta')->first() ? '<span class="material-icons text-accent-1">check_circle</span>' : '' !!}</span> <small class="text-accent-1 cursor-pointer" id="reupload">Upload Ulang?</small>
                </p>
                @endif
                @error('akta')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex flex-col gap-1.5" id="form-kip">
                <label id="kip" class="font-semibold capitalize flex items-center gap-2">
                    KIP
                </label>
                <input type="file" name="kip" id="kip" accept="application/pdf,image/*"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5 {{ $files->where('file_type', 'kip')->first() ? 'hidden' : '' }}">
                @if ($files->where('file_type', 'kip')->first())
                <p class="flex flex-col">
                    <span class="flex items-start break-all gap-1.5">{{ $files->where('file_type', 'kip')->first()->original_file_name }} {!! $files->where('file_type', 'kip')->first() ? '<span class="material-icons text-accent-1">check_circle</span>' : '' !!}</span> <small class="text-accent-1 cursor-pointer" id="reupload">Upload Ulang?</small>
                </p>
                @endif
                @error('kip')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex flex-col gap-1.5" id="form-pkh">
                <label id="pkh" class="font-semibold capitalize flex items-center gap-2">
                    PKH
                </label>
                <input type="file" name="pkh" id="pkh" accept="application/pdf,image/*"
                    class="file:bg-white file:border file:border-accent-1 file:rounded-md file:px-5 file:py-1.5 {{ $files->where('file_type', 'pkh')->first() ? 'hidden' : '' }}">
                @if ($files->where('file_type', 'pkh')->first())
                <p class="flex flex-col">
                    <span class="flex items-start break-all gap-1.5">{{ $files->where('file_type', 'pkh')->first()->original_file_name }} {!! $files->where('file_type', 'pkh')->first() ? '<span class="material-icons text-accent-1">check_circle</span>' : '' !!}</span> <small class="text-accent-1 cursor-pointer" id="reupload">Upload Ulang?</small>
                </p>
                @endif
                @error('pkh')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn bg-accent-1 text-accent-4 @if($files->where('file_type', 'kk')->first() && $files->where('file_type', 'akta')->first() && $files->where('file_type', 'kip')->first() && $files->where('file_type', 'pkh')->first()) cursor-not-allowed @endif" @if($files->where('file_type', 'kk')->first() && $files->where('file_type', 'akta')->first() && $files->where('file_type', 'kip')->first() && $files->where('file_type', 'pkh')->first()) disabled @endif>Upload</button>
        </form>
    </div>
</div>

<div id="student_detail_modal" class="left-0 top-0 fixed z-[100] bg-black/30 backdrop-blur-[2px] w-full h-full flex items-center justify-center hidden">
    <div class="bg-white m-5 p-5 flex flex-col gap-5 max-h-[calc(100%-10rem)] lg:max-h-[calc(100%-20rem)] overflow-y-auto max-w-screen-lg w-full overscroll-contain" id="content">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h2 class="font-bold text-xl">Detail</h2>
                <span>|</span>
                <a href="#edit" class="text-accent-1 hover:underline" id="edit-ppdb">Edit</a>
            </div>
            <button type="button" class="material-icons" id="close-detail">close</button>
        </div>
        @if (session('update-error'))
            @if ($errors->any())
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        @endif
        <form action="{{ route('ppdb.update', 'update') }}" method="post">
            @csrf
            @method('PATCH')
            <table class="border-collapse border border-slate-500 w-full">
                <tr>
                    <th class="border border-slate-500 p-2" colspan="2">Student</th>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">NISN</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->nisn ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[nisn]">{{ $student->nisn ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Full Name</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->full_name ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[full_name]">{{ $student->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Gender</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->gender ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="gender" data-name="student[gender]">{{ $student->gender == 'male' ? 'L' : 'P' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Birth Place</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->birth_place ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[birth_place]">{{ $student->birth_place ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Birth Date</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') }}" data-required="1" data-typeinput="date" data-name="student[birth_date]">{{ \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Religion</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->religion ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="religion" data-name="student[religion]">{{ $student->religion ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Address</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->address ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[address]">{{ $student->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Email</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->email ?? '-' }}" data-value="{{ $student->email ?? '-' }}" data-required="1" data-typeinput="email" data-name="student[email]">{{ $student->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Whatsapp</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->whatsapp ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[whatsapp]">{{ $student->whatsapp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Last School</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->last_school ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[last_school]">{{ $student->last_school ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Organitaion Experience</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->org_experience ?? '-' }}" data-required="0" data-typeinput="text" data-name="student[org_experience]">{{ $student->org_experience ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Height (CM)</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->height ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[height]">{{ $student->height ?? '-' }}cm</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Weight (KG)</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->weight ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[weight]">{{ $student->weight ?? '-' }}kg</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">History Illness</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->history_illness ?? '-' }}" data-required="0" data-typeinput="text" data-name="student[history_illness]">{{ $student->history_illness ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="border border-slate-500 p-2" colspan="2">Parent</th>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Full Name</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->full_name ?? '-' }}" data-required="1" data-typeinput="text" data-name="parent[full_name]">{{ $student->parent->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Gender</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->gender ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="gender" data-name="parent[gender]">{{ $student->parent->gender == 'male' ? 'L' : 'P' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Job</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->job ?? '-' }}" data-required="1" data-typeinput="text" data-name="parent[job]">{{ $student->parent->job ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Income Per Month</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->income_per_month ?? '-' }}" data-required="1" data-typeinput="number" data-name="parent[income_per_month]">Rp {{ number_format($student->parent->income_per_month, 0) }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Whatsapp</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->whatsapp ?? '-' }}" data-required="1" data-typeinput="number" data-name="parent[whatsapp]">{{ $student->parent->whatsapp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Email</td>
                    <td class="border border-slate-500 p-2" style="word-break: break-all;" data-value="{{ $student->parent->email ?? '-' }}" data-required="1" data-typeinput="email" data-name="parent[email]">{{ $student->parent->email ?? '-' }}</td>
                </tr>
            </table>
            <button type="submit" class="bg-accent-1 btn mt-4 text-accent-4 hidden" id="update-ppd-button" disabled>Update</button>
        </form>
    </div>
</div>
@endsection

@section('script')
    @vite('resources/js/ppdb.js')
    @if (session('update-error'))
        <script>
            setTimeout(() => {
                document.getElementById('student-detail-toggle').click();
            }, 500);
        </script>
    @endif
@endsection
