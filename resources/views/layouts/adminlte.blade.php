<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard | SMA Maarif Pacet' }}</title>

    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/dist/css/adminlte.min.css') }}">

    {{-- custom style for select2 --}}
    <style>
        ul.select2-selection__rendered {
            padding: 0 0.7rem !important;
        }

        li[aria-selected=true] {
            border-left: solid 4px #007BFF;
        }
    </style>
    {{-- custom style for select2 --}}

    @yield('head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <x-adminlte.navbar />
        <x-adminlte.main-sidebar />

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            @yield('content')
        </div>
        {{-- content-wrapper --}}

        <x-adminlte.control-sidebar />
        <x-adminlte.footer />
        <form action="{{ route('logout') }}" method="post" id="logoutForm">
            @csrf
        </form>
    </div>

    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ asset('adminlte-3.2.0/dist/js/adminlte.min.js') }}"></script>
    {{-- Sweetalert --}}
    <script src="{{ asset('js/sweatalert@2.1.2.js') }}"></script>
    @yield('script')
</body>

</html>
