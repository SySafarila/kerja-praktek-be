@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | News'
])
@section('head')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }

    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">Edit News</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></li>
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
                    <form action="{{ route('admin.news.update', $news) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title" class="text-capitalize">title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Some Title Here"
                                value="{{ old('title') ?? $news->title }}" required>
                            @error('title')
                                <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body" class="text-capitalize">body</label>
                            <textarea name="body" id="body" rows="10" class="form-control">{{ old('body') ?? $news->body }}</textarea>
                            @error('body')
                                <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {

                licenseKey: '',



            })
            .then(editor => {
                window.editor = editor;




            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: 8ubb9kaqv8bd-mk6bg6wswnw1');
                console.error(error);
            });
    </script>
@endsection
