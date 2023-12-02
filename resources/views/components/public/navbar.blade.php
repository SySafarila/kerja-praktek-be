<nav class="bg-accent-1 fixed w-full top-0 left-0 z-50">
    <div class="max-w-screen-lg mx-auto flex flex-col lg:flex-row justify-between px-5 py-2 lg:py-1.5">
        <div class="flex justify-between w-full">
            <a href="/" class="flex gap-2 items-center">
                <img src="{{ asset('images/logo.png') }}" alt="" class="h-12 w-auto">
                <div class="flex flex-col justify-center">
                    <span class="font-bold text-accent-2">SMA Ma'arif</span>
                    <span class="font-light -mt-1.5 text-accent-2">Pacet Cianjur</span>
                </div>
            </a>
            <button type="button" class="material-icons lg:hidden" id="navbar-menu">menu</button>
        </div>
        <div class="flex flex-col lg:flex lg:flex-row lg:items-center lg:gap-8 gap-2 py-2.5 lg:py-0 hidden"
            id="navbar-menus">
            <a href="/" class="text-accent-2">Home</a>
            <a href="#" class="text-accent-2">About</a>
            <a href="#" class="text-accent-2">News</a>
            <a href="#" class="text-accent-2">Contact</a>
        </div>
    </div>
</nav>
