@extends('layouts.adminlte')

@section('head')
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <link rel="stylesheet" href="{{ asset('cropperjs-1.5.13/dist/cropper.min.css') }}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <x-adminlte.session-notifications />
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">Account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('landingpage') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card m-0">
                <div class="card-body table-responsive">
                    <div class="align-items-center d-flex flex-column mb-4">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile.png') }}"
                            alt="" class="mb-2"
                            style="width: 100px;border-radius: 50%;height: 100px;object-fit: cover;">
                        <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#photo">Change</button>
                    </div>
                    <table class="table-bordered mb-4 table">
                        <tr>
                            <td class="table-data-identifier">Name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="table-data-identifier">Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="table-data-identifier">Registered</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @can('roles-read')
                            <tr>
                                <td class="table-data-identifier">Roles</td>
                                <td>
                                    <div class="d-flex" style="gap: 10px">
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="text-capitalize">{{ $role->name }}{{ $loop->last ? '' : ',' }}</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endcan
                    </table>
                    <a href="{{ route('account.edit', $user) }}" class="btn btn-default">Edit</a>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="photo" tabindex="-1" aria-labelledby="photoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoLabel">Update Photo Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('account.update', ['account' => $user, 'update' => 'image']) }}" method="post"
                        id="updatePhotoProfile" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-0">
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" id="image" accept="image/*"
                                    name="image" onchange="previewImg(this)" required>
                                <label class="custom-file-label" for="image">Choose</label>
                            </div>
                            <b class="d-block mb-1">Preview</b>
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile.png') }}"
                                alt="preview" id="preview" class="w-100 d-none mt-3"
                                style="height: 15rem;object-fit: contain;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="uploadPhotoBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('adminlte-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('cropperjs-1.5.13/dist/cropper.min.js') }}"></script>
    <script>
        // cropper
        const uploadBtn = document.getElementById('uploadPhotoBtn');
        let cropper = new Cropper(document.getElementById('preview'), {
            aspectRatio: 1,
            viewMode: 2
        })

        function previewImg(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result
                    document.getElementById('preview').classList.remove('d-none')
                    cropper.replace(e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }

        function uploadCropped() {
            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();

                formData.append('image', blob);
                formData.append('_method', 'PATCH');

                $.ajax('{{ route('account.update', ['account' => $user, 'update' => 'image']) }}', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success() {
                        swal({
                            title: "Uploaded !",
                            icon: "success",
                            text: null
                        })
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error() {
                        swal({
                            title: "Uploade failed !",
                            icon: "error",
                            text: null
                        })
                    },
                });
            });
        }

        uploadBtn.addEventListener('click', (e) => {
            e.preventDefault()
            uploadBtn.disabled = true
            uploadCropped()
        })
    </script>
    <script>
        // bootstrap custom file upload
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
