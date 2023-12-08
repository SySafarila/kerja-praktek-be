@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5">
    <img src="{{ asset('images/ppdb.png') }}" alt="" class="w-full">
</div>
<form action="{{ route('ppdb.store') }}" method="POST" class="max-w-screen-lg mx-auto p-5">
    @if (session('error'))
        <div class="bg-red-200 p-3 border border-red-300 mb-2">
            {{ session('error') }}
        </div>
    @endif
    @csrf
    <h1 class="text-2xl font-bold mb-5">Penerimaan Peserta Didik Baru</h1>
    <div class="grid lg:grid-cols-2 gap-5">
        <div class="grid grid-cols-1 gap-2.5">
            <h2 class="text-xl font-semibold">Data Pribadi Calon Siswa</h2>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="NISN" class="font-semibold capitalize">
                    Nomor induk siswa nasional (NISN)
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="student[nisn]" class="w-full border-gray-500 border outline-none rounded-lg" id="NISN" value="{{ old('student.nisn') }}" required>
                @error('student.nisn')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="fullname" class="font-semibold capitalize">
                    Nama lengkap
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="student[full_name]" class="w-full border-gray-500 border outline-none rounded-lg" id="fullname" value="{{ old('student.full_name') }}" required>
                @error('student.full_name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="gender" class="font-semibold capitalize">
                    Jenis kelamin
                    <span class="text-red-500">*</span>
                </label>
                <select name="student[gender]" class="w-full border-gray-500 border outline-none rounded-lg" id="gender" required>
                    <option value="0" selected disabled>Pilih</option>
                    <option value="male" @if(old('student.gender') == 'male') selected @endif>Laki-Laki</option>
                    <option value="female" @if(old('student.gender') == 'female') selected @endif>Perempuan</option>
                </select>
                @error('student.gender')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tempatlahir" class="font-semibold capitalize">
                    Tempat lahir
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="student[birth_place]" class="w-full border-gray-500 border outline-none rounded-lg" value="{{ old('student.birth_place') }}" id="tempatlahir" required>
                @error('student.birth_place')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tanggallahir" class="font-semibold capitalize">
                    Tanggal lahir
                    <span class="text-red-500">*</span>
                </label>
                <input type="date" name="student[birth_date]" class="w-full border-gray-500 border outline-none rounded-lg" value="{{ old('student.birth_date') }}" required id="tanggallahir">
                @error('student.birth_date')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="agama" class="font-semibold capitalize">
                    Agama
                    <span class="text-red-500">*</span>
                </label>
                <select type="text" name="student[religion]" class="w-full border-gray-500 border outline-none rounded-lg" id="agama" required>
                    <option value="0" selected> Pilih</option>
                    <option value="islam" @if(old('student.religion') == 'islam') selected @endif>islam</option>
                    <option value="hindu" @if(old('student.religion') == 'hindu') selected @endif>Hindu</option>
                    <option value="kristen" @if(old('student.religion') == 'kristen') selected @endif>Kristen</option>
                    <option value="Etc" @if(old('student.religion') == 'etc') selected @endif>Etc</option>
                </select>
                @error('student.birth_date')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="alamat" class="font-semibold capitalize">
                    alamat
                    <span class="text-red-500">*</span>
                </label>
                <textarea name="student[address]" class="w-full border-gray-500 border outline-none rounded-lg" id="alamat" required>{{ old('student.address') }}</textarea>
                @error('student.address')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="whatsapp" class="font-semibold capitalize">
                    whatsapp
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="student[whatsapp]" class="w-full border-gray-500 border outline-none rounded-lg" id="whatsapp" value="{{ old('student.whatsapp') }}" required>
                @error('student.whatsapp')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="email" class="font-semibold capitalize">
                    email
                    <span class="text-red-500">*</span>
                </label>
                <input type="email" name="student[email]" class="w-full border-gray-500 border outline-none rounded-lg" value="{{ old('student.email') }}" id="email" required>
                @error('student.email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="asalsekolah" class="font-semibold capitalize">
                    asal sekolah
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="student[last_school]" class="w-full border-gray-500 border outline-none rounded-lg" value="{{ old('student.last_school') }}" id="asalsekolah" required>
                @error('student.last_school')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="PengalamanBeroganisasi" class="font-semibold capitalize">Pengalaman Beroganisasi</label>
                <textarea type="text" name="student[org_experience]" class="w-full border-gray-500 border outline-none rounded-lg" id="PengalamanBeroganisasi">{{ old('student.org_experience') }}</textarea>
                @error('student.org_experience')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tinggibadan" class="font-semibold capitalize">
                    tinggi badan (CM)
                    <span class="text-red-500">*</span>
                </label>
                <input type="number" name="student[height]" class="w-full border-gray-500 border outline-none rounded-lg" id="tinggibadan" value="{{ old('student.height') }}" required>
                @error('student.height')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="beratbadan" class="font-semibold capitalize">
                    berat badan (KG)
                    <span class="text-red-500">*</span>
                </label>
                <input type="number" name="student[weight]" class="w-full border-gray-500 border outline-none rounded-lg" value="{{ old('student.weight') }}" id="beratbadan" required>
                @error('student.weight')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="RiwayatPenyakit" class="font-semibold capitalize">Riwayat Penyakit</label>
                <textarea type="text" name="student[history_illness]" class="w-full border-gray-500 border outline-none rounded-lg" id="RiwayatPenyakit">{{ old('student.history_illness') }}</textarea>
                @error('student.history_illness')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div>
            <div class="grid grid-cols-1 gap-2.5">
                <h2 class="text-xl font-semibold">Data Pribadi Wali Calon Siswa</h2>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="fullname2" class="font-semibold capitalize">
                        Nama lengkap
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="parent[full_name]" class="w-full border-gray-500 border outline-none rounded-lg" id="fullname2" value="{{ old('parent.full_name') }}" required>
                    @error('parent.full_name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="gender2" class="font-semibold capitalize">
                        Jenis kelamin
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="parent[gender]" class="w-full border-gray-500 border outline-none rounded-lg" id="gender2" required>
                        <option value="0" selected disabled>Pilih</option>
                        <option value="male" @if(old('parent.gender') == 'male') selected @endif>Laki-Laki</option>
                        <option value="female" @if(old('parent.gender') == 'female') selected @endif>Perempuan</option>
                    </select>
                    @error('parent.gender')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="pekerjaan" class="font-semibold capitalize">
                        Pekerjaan
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="parent[job]" class="w-full border-gray-500 border outline-none rounded-lg" id="pekerjaan" value="{{ old('parent.job') }}" required>
                    @error('parent.job')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="penghasilanperbulan" class="font-semibold capitalize">
                        penghasilan perbulan
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="parent[income_per_month]" class="w-full border-gray-500 border outline-none rounded-lg" id="penghasilanperbulan" value="{{ old('parent.income_per_month') }}" required>
                    @error('parent.income_per_month')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="whatsapp2" class="font-semibold capitalize">
                        whatsapp
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="parent[whatsapp]" class="w-full border-gray-500 border outline-none rounded-lg" id="whatsapp2" value="{{ old('parent.whatsapp') }}" required>
                    @error('parent.whatsapp')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="email2" class="font-semibold capitalize">
                        email
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="parent[email]" class="w-full border-gray-500 border outline-none rounded-lg" id="email2" value="{{ old('parent.email') }}" required>
                    @error('parent.email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 gap-2.5 mt-3">
                <h2 class="text-xl font-semibold">Biaya Pendaftaran</h2>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="price" class="font-semibold capitalize">Jumlah yang harus dibayar <span
                            class="text-red-500">*</span></label>
                    <input type="text" class="w-full border-gray-500 border outline-none rounded-lg cursor-default"
                        id="price" value="Rp 150,000" readonly>
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="paymentmethod" class="font-semibold capitalize">Metode Pembayaran <span
                            class="text-red-500">*</span></label>
                    <select class="w-full border-gray-500 border outline-none rounded-lg" name="payment_method" id="paymentmethod">
                        <option value="" selected disabled>Pilih</option>
                        <option value="qris" @if(old('payment_method') == 'qris') selected @endif>QRIS</option>
                        <option value="va_bca" @if(old('payment_method') == 'va_bca') selected @endif>BCA Virtual Account</option>
                        <option value="va_bni" @if(old('payment_method') == 'va_bni') selected @endif>BNI Virtual Account</option>
                        <option value="va_bri" @if(old('payment_method') == 'va_bri') selected @endif>BRI Virtual Account</option>
                        <option value="va_permata" @if(old('payment_method') == 'va_permata') selected @endif>Permata Virtual Account</option>
                        <option value="va_cimb" @if(old('payment_method') == 'va_cimb') selected @endif>CIMB Virtual Account</option>
                        <option value="gopay" @if(old('payment_method') == 'gopay') selected @endif>GoPay</option>
                        <option value="shopeepay" @if(old('payment_method') == 'shopeepay') selected @endif>ShopeePay</option>
                        <option value="offline" @if(old('payment_method') == 'offline') selected @endif>Bayar Di Sekolah</option>
                    </select>
                    <p>*Gratis batik untuk 50 pendaftar pertama</p>
                </div>
            </div>
        </div>
    </div>
    <button class="btn bg-accent-1 text-accent-4 mt-5 w-full lg:w-auto">Daftar</button>
</form>
@endsection

@section('script')
@endsection
