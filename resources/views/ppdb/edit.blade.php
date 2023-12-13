@extends('layouts.adminlte')

@section('head')
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-center">
                <h1 class="m-0">Edit Data PPDB</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ppdb.index') }}">PPDB</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content pb-3">
    <div class="container-fluid">
        <div class="card m-0">
            <div class="card-body">
                <form action="{{ route('admin.ppdb.update', $student) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2 class="text-xl font-semibold">Data Pribadi Calon Siswa</h2>
                            <div class="form-group">
                                <label for="NISN" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Nomor induk siswa nasional (NISN)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="student[nisn]" class="form-control" id="NISN"
                                    value="{{ old('student.nisn') ?? $student->nisn }}" required>
                                @error('student.nisn')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fullname" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Nama lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="student[full_name]" class="form-control" id="fullname"
                                    value="{{ old('student.full_name') ?? $student->full_name }}" required>
                                @error('student.full_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Jenis kelamin
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="student[gender]" class="custom-select" id="gender" required>
                                    <option value="0" selected disabled>Pilih</option>
                                    <option value="male" @if(old('student.gender') ?? $student->gender == 'male' )
                                        selected @endif>Laki-Laki
                                    </option>
                                    <option value="female" @if(old('student.gender') ?? $student->gender == 'female' )
                                        selected @endif>
                                        Perempuan</option>
                                </select>
                                @error('student.gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tempatlahir" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Tempat lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="student[birth_place]" class="form-control"
                                    value="{{ old('student.birth_place') ?? $student->birth_place }}" id="tempatlahir"
                                    required>
                                @error('student.birth_place')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggallahir" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Tanggal lahir
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="student[birth_date]" class="form-control"
                                    value="{{ old('student.birth_date') ?? $student->birth_date }}" required
                                    id="tanggallahir">
                                @error('student.birth_date')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="agama" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Agama
                                    <span class="text-danger">*</span>
                                </label>
                                <select type="text" name="student[religion]" class="custom-select" id="agama" required>
                                    <option value="0" selected disabled> Pilih</option>
                                    <option class="capitalize" value="islam" @if(old('student.religion') ?? $student->
                                        religion =='islam' )
                                        selected @endif>islam</option>
                                    <option class="capitalize" value="kristen_protestan" @if(old('student.religion') ??
                                        $student->religion =='kristen_protestan' ) selected @endif>
                                        Kristen Protestan</option>
                                    <option class="capitalize" value="kristen_katolik" @if(old('student.religion') ??
                                        $student->religion =='kristen_katolik' ) selected @endif>Kristen Katolik
                                    </option>
                                    <option class="capitalize" value="hindu" @if(old('student.religion') ?? $student->
                                        religion =='hindu' )
                                        selected @endif>Hindu</option>
                                    <option class="capitalize" value="buddha" @if(old('student.religion') ?? $student->
                                        religion =='buddha' )
                                        selected @endif>Buddha</option>
                                    <option class="capitalize" value="khonghucu" @if(old('student.religion') ??
                                        $student->religion =='khonghucu' ) selected @endif>Khonghucu</option>
                                </select>
                                @error('student.birth_date')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    alamat
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="student[address]" class="form-control" id="alamat"
                                    required>{{ old('student.address') ?? $student->address }}</textarea>
                                @error('student.address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="whatsapp" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    whatsapp
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="student[whatsapp]" class="form-control" id="whatsapp"
                                    value="{{ old('student.whatsapp') ?? $student->whatsapp }}" required>
                                @error('student.whatsapp')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="student[email]" class="form-control"
                                    value="{{ old('student.email') ?? $student->email }}" id="email" required>
                                @error('student.email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="asalsekolah" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    asal sekolah
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="student[last_school]" class="form-control"
                                    value="{{ old('student.last_school') ?? $student->last_school }}" id="asalsekolah"
                                    required>
                                @error('student.last_school')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="PengalamanBeroganisasi" class="font-semibold capitalize" style="text-transform: capitalize;">Pengalaman
                                    Beroganisasi</label>
                                <textarea type="text" name="student[org_experience]" class="form-control"
                                    id="PengalamanBeroganisasi">{{ old('student.org_experience') ?? $student->org_experience }}</textarea>
                                @error('student.org_experience')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tinggibadan" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    tinggi badan (CM)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="student[height]" class="form-control" id="tinggibadan"
                                    value="{{ old('student.height') ?? $student->height }}" required>
                                @error('student.height')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="beratbadan" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    berat badan (KG)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="student[weight]" class="form-control"
                                    value="{{ old('student.weight') ?? $student->weight }}" id="beratbadan" required>
                                @error('student.weight')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="RiwayatPenyakit" class="font-semibold capitalize" style="text-transform: capitalize;">Riwayat Penyakit</label>
                                <textarea type="text" name="student[history_illness]" class="form-control"
                                    id="RiwayatPenyakit">{{ old('student.history_illness') ?? $student->history_illness }}</textarea>
                                @error('student.history_illness')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h2 class="text-xl font-semibold">Data Pribadi Wali Calon Siswa</h2>
                            <div class="form-group">
                                <label for="fullname2" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Nama lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="parent[full_name]" class="form-control" id="fullname2"
                                    value="{{ old('parent.full_name') ?? $student->parent->full_name }}" required>
                                @error('parent.full_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender2" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Jenis kelamin
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="parent[gender]" class="custom-select" id="gender2" required>
                                    <option value="0" selected disabled>Pilih</option>
                                    <option value="male" @if(old('parent.gender') ?? $student->parent->gender
                                        =='male' ) selected @endif>
                                        Laki-Laki</option>
                                    <option value="female" @if(old('parent.gender') ?? $student->parent->gender
                                        =='female' ) selected @endif>
                                        Perempuan</option>
                                </select>
                                @error('parent.gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    Pekerjaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="parent[job]" class="form-control" id="pekerjaan"
                                    value="{{ old('parent.job') ?? $student->parent->job }}" required>
                                @error('parent.job')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="penghasilanperbulan" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    penghasilan perbulan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="parent[income_per_month]" class="form-control"
                                    id="penghasilanperbulan"
                                    value="{{ old('parent.income_per_month') ?? $student->parent->income_per_month }}"
                                    required>
                                @error('parent.income_per_month')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="whatsapp2" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    whatsapp
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="parent[whatsapp]" class="form-control" id="whatsapp2"
                                    value="{{ old('parent.whatsapp') ?? $student->parent->whatsapp }}" required>
                                @error('parent.whatsapp')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email2" class="font-semibold capitalize" style="text-transform: capitalize;">
                                    email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="parent[email]" class="form-control" id="email2"
                                    value="{{ old('parent.email') ?? $student->parent->email }}" required>
                                @error('parent.email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h2 class="text-xl font-semibold">Berkas</h2>
                            <div class="form-group" id="form-kk">
                                <label id="kk" class="font-semibold capitalize flex items-center gap-2">
                                    Kartu Keluarga
                                    {!! $student->files->where('file_type', 'kk')->first() ? '' : '<span
                                        class="text-danger">*</span>' !!}
                                </label>
                                <input type="file" name="kk" id="kk" accept="application/pdf,image/*"
                                    class="form-control p-0 border-0 {{ $student->files->where('file_type', 'kk')->first() ? 'hidden' : '' }}"
                                    {{ $student->files->where('file_type', 'kk')->first() ? '' : 'required' }}>
                                @if ($student->files->where('file_type', 'kk')->first())
                                <p class="flex flex-col">
                                    <span class="d-flex align-items-start" style="gap: .5rem;">{{
                                        $student->files->where('file_type',
                                        'kk')->first()->original_file_name }} {!! $student->files->where('file_type',
                                        'kk')->first() ? '<span class="material-icons text-primary">check_circle</span>'
                                        : '' !!}</span>
                                </p>
                                @endif
                                @error('kk')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group" id="form-akta">
                                <label id="akta" class="font-semibold capitalize flex items-center gap-2">
                                    Akta Kelahiran
                                    {!! $student->files->where('file_type', 'akta')->first() ? '' : '<span
                                        class="text-danger">*</span>' !!}
                                </label>
                                <input type="file" name="akta" id="akta" accept="application/pdf,image/*"
                                    class="form-control p-0 border-0 {{ $student->files->where('file_type', 'akta')->first() ? 'hidden' : '' }}"
                                    {{ $student->files->where('file_type', 'akta')->first() ? '' : 'required' }}>
                                @if ($student->files->where('file_type', 'akta')->first())
                                <p class="flex flex-col">
                                    <span class="d-flex align-items-start" style="gap: .5rem;">{{
                                        $student->files->where('file_type',
                                        'akta')->first()->original_file_name }} {!! $student->files->where('file_type',
                                        'akta')->first() ? '<span
                                            class="material-icons text-primary">check_circle</span>' : '' !!}</span>
                                </p>
                                @endif
                                @error('akta')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group" id="form-kip">
                                <label id="kip" class="font-semibold capitalize flex items-center gap-2">
                                    KIP
                                </label>
                                <input type="file" name="kip" id="kip" accept="application/pdf,image/*"
                                    class="form-control p-0 border-0 {{ $student->files->where('file_type', 'kip')->first() ? 'hidden' : '' }}">
                                @if ($student->files->where('file_type', 'kip')->first())
                                <p class="flex flex-col">
                                    <span class="d-flex align-items-start" style="gap: .5rem;">{{
                                        $student->files->where('file_type',
                                        'kip')->first()->original_file_name }} {!! $student->files->where('file_type',
                                        'kip')->first() ? '<span
                                            class="material-icons text-primary">check_circle</span>' : '' !!}</span>
                                </p>
                                @endif
                                @error('kip')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group" id="form-pkh">
                                <label id="pkh" class="font-semibold capitalize flex items-center gap-2">
                                    PKH
                                </label>
                                <input type="file" name="pkh" id="pkh" accept="application/pdf,image/*"
                                    class="form-control p-0 border-0 {{ $student->files->where('file_type', 'pkh')->first() ? 'hidden' : '' }}">
                                @if ($student->files->where('file_type', 'pkh')->first())
                                <p class="flex flex-col">
                                    <span class="d-flex align-items-start" style="gap: .5rem;">{{
                                        $student->files->where('file_type',
                                        'pkh')->first()->original_file_name }} {!! $student->files->where('file_type',
                                        'pkh')->first() ? '<span
                                            class="material-icons text-primary">check_circle</span>' : '' !!}</span>
                                </p>
                                @endif
                                @error('pkh')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
