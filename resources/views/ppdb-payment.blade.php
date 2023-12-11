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
                        <li>
                            <a href="#upload-files" class="font-semibold underline">Upload berkas yang diperlukan</a>
                        </li>
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
                    <div class="absolute left-0 top-12 w-full hidden flex-col gap-2 bg-white p-3 rounded-lg group-focus-within:flex lg:max-h-72 lg:overflow-y-auto border border-gray-200 z-10">
                        <form action="{{ route('ppdb.payment-update') }}" method="post" id="update-payment-method-form">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="update_payment_method" value="" required>
                        </form>
                        <button type="submit" data-payment="qris" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">QRIS</button>
                        <button type="submit" data-payment="va_bca" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">BCA Virtual Account</button>
                        <button type="submit" data-payment="va_bni" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">BNI Virtual Account</button>
                        <button type="submit" data-payment="va_bri" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">BRI Virtual Account</button>
                        <button type="submit" data-payment="va_permata" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">Permata Virtual Account</button>
                        <button type="submit" data-payment="va_cimb" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">CIMB Virtual Account</button>
                        <button type="submit" data-payment="gopay" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">GoPay</button>
                        <button type="submit" data-payment="shopeepay" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">ShopeePay</button>
                        <button type="submit" data-payment="offline" class="bg-white text-accent-1 btn border border-accent-1 text-center" id="update-payment-method">Bayar Di Sekolah</button>
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
        <form action="#" method="POST" class="flex flex-col gap-3 relative" id="upload-files">
            @if ($transaction->transaction_status != 'settlement')
                <div class="-left-2.5 -top-2.5 w-[calc(100%+15px)] h-[calc(100%+15px)] backdrop-blur-[2px] absolute"></div>
            @endif
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

<div id="student_detail_modal" class="left-0 top-0 fixed z-[100] bg-black/30 backdrop-blur-[2px] w-full h-full flex items-center justify-center hidden">
    <div class="bg-white m-5 p-5 flex flex-col gap-5 max-h-[calc(100%-10rem)] lg:max-h-[calc(100%-20rem)] overflow-y-auto max-w-screen-lg w-full" id="content">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h2 class="font-bold text-xl">Detail</h2>
                <span>|</span>
                <a href="#edit" class="text-accent-1 hover:underline" id="edit-ppdb">Edit</a>
            </div>
            <button type="button" class="material-icons" id="close-detail">close</button>
        </div>
        @if ($errors->any())
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
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
                    <td class="border border-slate-500 p-2" data-value="{{ $student->nisn ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[nisn]">{{ $student->nisn ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Full Name</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->full_name ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[full_name]">{{ $student->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Gender</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->gender ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="gender" data-name="student[gender]">{{ $student->gender == 'male' ? 'L' : 'P' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Birth Place</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->birth_place ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[birth_place]">{{ $student->birth_place ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Birth Date</td>
                    <td class="border border-slate-500 p-2" data-value="{{ \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') }}" data-required="1" data-typeinput="date" data-name="student[birth_date]">{{ \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Religion</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->religion ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="religion" data-name="student[religion]">{{ $student->religion ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Address</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->address ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[address]">{{ $student->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Email</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->email ?? '-' }}" data-value="{{ $student->email ?? '-' }}" data-required="1" data-typeinput="email" data-name="student[email]">{{ $student->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Whatsapp</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->whatsapp ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[whatsapp]">{{ $student->whatsapp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Last School</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->last_school ?? '-' }}" data-required="1" data-typeinput="text" data-name="student[last_school]">{{ $student->last_school ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Organitaion Experience</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->org_experience ?? '-' }}" data-required="0" data-typeinput="text" data-name="student[org_experience]">{{ $student->org_experience ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Height (CM)</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->height ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[height]">{{ $student->height ?? '-' }}cm</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Weight (KG)</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->weight ?? '-' }}" data-required="1" data-typeinput="number" data-name="student[weight]">{{ $student->weight ?? '-' }}kg</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">History Illness</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->history_illness ?? '-' }}" data-required="0" data-typeinput="text" data-name="student[history_illness]">{{ $student->history_illness ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="border border-slate-500 p-2" colspan="2">Parent</th>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Full Name</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->full_name ?? '-' }}" data-required="1" data-typeinput="text" data-name="parent[full_name]">{{ $student->parent->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Gender</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->gender ?? '-' }}" data-required="1" data-typeinput="select" data-selecttype="gender" data-name="parent[gender]">{{ $student->parent->gender == 'male' ? 'L' : 'P' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Job</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->job ?? '-' }}" data-required="1" data-typeinput="text" data-name="parent[job]">{{ $student->parent->job ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Income Per Month</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->income_per_month ?? '-' }}" data-required="1" data-typeinput="number" data-name="parent[income_per_month]">Rp {{ number_format($student->parent->income_per_month, 0) }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Whatsapp</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->whatsapp ?? '-' }}" data-required="1" data-typeinput="number" data-name="parent[whatsapp]">{{ $student->parent->whatsapp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-500 p-2">Email</td>
                    <td class="border border-slate-500 p-2" data-value="{{ $student->parent->email ?? '-' }}" data-required="1" data-typeinput="email" data-name="parent[email]">{{ $student->parent->email ?? '-' }}</td>
                </tr>
            </table>
            <button type="submit" class="bg-accent-1 btn mt-4 text-accent-4 hidden" id="update-ppd-button" disabled>Update</button>
        </form>
    </div>
</div>
@endsection

@section('script')
    @if (session('update-error'))
        <script>
            setTimeout(() => {
                document.getElementById('student-detail-toggle').click();
            }, 500);
        </script>
    @endif
    @isset($transaction)
        @if (in_array($transaction->payment_method, ['va_bca', 'va_bni', 'va_bri', 'va_permata', 'va_cimb']) && $transaction->transaction_status == 'pending')
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
    @endisset
@endsection
