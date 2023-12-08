<!doctype html>
<html lang="en" class="scroll-pt-[72px] lg:scroll-pt-[68px] scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="shortcut icon" href="{{asset('images/logos/logo1a.png')}}" type="image/x-icon">
    <title>SMA MA'ARIF PACET CIANJUR</title>

    @yield('head')

    @vite('resources/css/app.css')
</head>

<body>
    <x-public.navbar />

    <main class="mt-[72px] lg:mt-[68px]">
        @yield('content')
    </main>

    <x-public.footer />

    @vite('resources/js/app.js')

    @yield('script')
</body>

</html>
