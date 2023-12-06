@extends('layouts.public')

@section('head')
@endsection

@section('content')
<div class="max-w-screen-lg mx-auto lg:px-5">
    <img src="{{ asset('images/ppdb.png') }}" alt="" class="w-full">
</div>
<div class="max-w-screen-lg mx-auto p-5">
    <h1 class="text-2xl font-bold mb-5">Penerimaan Peserta Didik Baru</h1>
    <div class="grid lg:grid-cols-2 gap-5">
        <div class="grid grid-cols-1 gap-2.5">
            <h2 class="text-xl font-semibold">Data Pribadi Calon Siswa</h2>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="NISN" class="font-semibold capitalize">Nomor induk siswa nasional (NISN) <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="NISN">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="fullname" class="font-semibold capitalize">Nama lengkap <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="fullname">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="gender" class="font-semibold capitalize">Jenis kelamin <span
                        class="text-red-500">*</span></label>
                <select class="w-full border-gray-500 border outline-none rounded-lg" id="gender">
                    <option value="0" selected>Pilih</option>
                    <option value="l">Laki-Laki</option>
                    <option value="p">Perempuan</option>
                </select>
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tempatlahir" class="font-semibold capitalize">Tempat lahir <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="tempatlahir">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tanggallahir" class="font-semibold capitalize">Tanggal lahir <span
                        class="text-red-500">*</span></label>
                <input type="date" class="w-full border-gray-500 border outline-none rounded-lg" id="tanggallahir">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="agama" class="font-semibold capitalize">Agama <span class="text-red-500">*</span></label>
                <select type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="agama">
                    <option value="0" selected> Pilih</option>
                    <option value="islam">islam</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Etc">Etc</option>
                </select>
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="alamat" class="font-semibold capitalize">alamat <span class="text-red-500">*</span></label>
                <textarea class="w-full border-gray-500 border outline-none rounded-lg" id="alamat">
                </textarea>
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="whatsapp" class="font-semibold capitalize">whatsapp <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="whatsapp">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="email" class="font-semibold capitalize">email <span class="text-red-500">*</span></label>
                <input type="email" class="w-full border-gray-500 border outline-none rounded-lg" id="email">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="asalsekolah" class="font-semibold capitalize">asal sekolah <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="asalsekolah">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="PengalamanBeroganisasi" class="font-semibold capitalize">Pengalaman Beroganisasi <span
                        class="text-red-500">*</span></label>
                <textarea type="text" class="w-full border-gray-500 border outline-none rounded-lg"
                    id="PengalamanBeroganisasi">
                </textarea>
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="tinggibadan" class="font-semibold capitalize">tinggi badan (CM)<span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="tinggibadan">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="beratbadan" class="font-semibold capitalize">berat badan (KG)<span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="beratbadan">
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="RiwayatPenyakit" class="font-semibold capitalize">Riwayat Penyakit <span
                        class="text-red-500">*</span></label>
                <textarea type="text" class="w-full border-gray-500 border outline-none rounded-lg"
                    id="RiwayatPenyakit">
                </textarea>
            </div>
            <div class="grid grid-cols-1 gap-1.5">
                <label for="NoPendaftaran" class="font-semibold capitalize">Nomor pendaftaran <span
                        class="text-red-500">*</span></label>
                <input type="text" class="w-full border-gray-500 border outline-none rounded-lg cursor-default"
                    id="NoPendaftaran" value="By System" readonly>
            </div>
        </div>
        <div>
            <div class="grid grid-cols-1 gap-2.5">
                <h2 class="text-xl font-semibold">Data Pribadi Wali Calon Siswa</h2>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="fullname2" class="font-semibold capitalize">Nama lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="fullname2">
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="gender2" class="font-semibold capitalize">Jenis kelamin <span
                            class="text-red-500">*</span></label>
                    <select class="w-full border-gray-500 border outline-none rounded-lg" id="gender2">
                        <option value="0" selected>Pilih</option>
                        <option value="l">Laki-Laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="pekerjaan" class="font-semibold capitalize">Pekerjaan <span
                            class="text-red-500">*</span></label>
                    <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="pekerjaan">
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="penghasilanperbulan" class="font-semibold capitalize">penghasilan perbulan <span
                            class="text-red-500">*</span></label>
                    <input type="text" class="w-full border-gray-500 border outline-none rounded-lg"
                        id="penghasilanperbulan">
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="whatsapp2" class="font-semibold capitalize">whatsapp <span
                            class="text-red-500">*</span></label>
                    <input type="text" class="w-full border-gray-500 border outline-none rounded-lg" id="whatsapp2">
                </div>
                <div class="grid grid-cols-1 gap-1.5">
                    <label for="email2" class="font-semibold capitalize">email <span
                            class="text-red-500">*</span></label>
                    <input type="email" class="w-full border-gray-500 border outline-none rounded-lg" id="email2">
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
                    <select class="w-full border-gray-500 border outline-none rounded-lg" id="paymentmethod">
                        <option value="0" selected>Pilih</option>
                        <option value="">BCA Virtual Account</option>
                        <option value="">QRIS</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button class="btn bg-accent-1 text-accent-4 mt-5 w-full lg:w-auto">Daftar</button>
</div>
@endsection

@section('script')
@endsection
