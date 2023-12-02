<nav class="bg-accent-1 text-accent-2 fixed w-full top-0 left-0">
    <div class="max-w-screen-lg mx-auto flex flex-col lg:flex-row justify-between px-5 py-2 lg:py-1.5">
        <div class="flex justify-between w-full">
            <div class="flex gap-2 items-center">
                <img src="{{ asset('images/logo.png') }}" alt="" class="h-12 w-auto">
                <div class="flex flex-col justify-center">
                    <span class="font-bold">SMA Ma'arif</span>
                    <span class="font-light -mt-1.5">Pacet Cianjur</span>
                </div>
            </div>
            <button type="button" class="material-icons lg:hidden" id="navbar-menu"
                onclick="document.getElementById('navbar-menus').classList.toggle('hidden')">menu</button>
        </div>
        <div class="flex flex-col lg:flex lg:flex-row lg:items-center lg:gap-8 gap-2 py-2.5 lg:py-0 hidden"
            id="navbar-menus">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">News</a>
            <a href="#">Contact</a>
        </div>
    </div>
</nav>
