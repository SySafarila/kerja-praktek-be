<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    @yield('head')

    @vite('resources/css/app.css')
</head>

<body>
    <x-public.navbar />

    <main class="mt-[64px] lg:mt-[60px]">
        @yield('content')
    </main>

    <x-public.footer />

    @vite('resources/js/app.js')

    @yield('script')
</body>

</html>
