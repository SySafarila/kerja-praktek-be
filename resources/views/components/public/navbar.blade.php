<nav class="bg-accent-1 fixed w-full top-0 left-0 z-50">
    <div class="max-w-screen-lg mx-auto flex flex-col lg:flex-row justify-between px-5 py-2 lg:py-1.5">
        <div class="flex justify-between w-full">
            <a href="/" class="flex gap-2 items-center hover:no-underline">
                <img src="{{ asset('images/logo-white-text.png') }}" alt="" class="h-12 w-auto">
                <div class="flex flex-col justify-center">
                    <span class="font-light text-sm text-accent-2">Lembaga Pendidikan NU</span>
                    <span class="font-bold text-accent-2 -mt-1">SMA MA'ARIF PACET</span>
                </div>
            </a>
            <button type="button" class="material-icons lg:hidden text-accent-4" id="navbar-menu">menu</button>
        </div>
        <div class="flex flex-col lg:flex lg:flex-row lg:items-center lg:gap-8 gap-2 py-2.5 lg:py-0 hidden"
            id="navbar-menus" style="text-decoration: none">
            <a href="/" class="text-accent-2" style="text-decoration: none">Home</a>
            <a href="#" class="text-accent-2" style="text-decoration: none">News</a>
            <a href="#" class="text-accent-2" style="text-decoration: none">About</a>
            <a href="#" class="text-accent-2" style="text-decoration: none">Contact</a>
            <a href="#" class="text-accent-2" style="text-decoration: none">eLibrary</a>

        </div>
    </div>
</nav>
