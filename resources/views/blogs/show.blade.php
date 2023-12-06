@extends('layouts.adminlte')

@section('head')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
@endsection

@section('content_header')
    <h1>Blog Details</h1>
@stop

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content pt-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h2>{{ $blog->title }}</h2>
                    <p>Published on {{ $blog->created_at->format('M d, Y') }}</p>

                    <div class="mt-4">
                        {!! $blog->body !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
