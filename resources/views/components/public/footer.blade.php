<footer class="bg-accent-1 text-accent-2">
    <div class="max-w-screen-lg mx-auto grid lg:grid-cols-3 p-5 gap-5 lg:gap-8">
        <div>
            <h2 class="text-sm text-accent-2 uppercase">Lembaga Pendidikan Nahdatul Ulama</h2>
            <h3 class="font-semibold text-xl mb-4 text-accent-2 uppercase">SMA Ma'arif Pacet Cianjur</h3>
            <p class="text-accent-2"><b class="text-accent-2">Alamat : </b>Cipendawa, Pacet, Cianjur Regency, West Java
                43253</p>
            <div class="flex flex-col gap-2 mt-2">
                <div class="flex items-center gap-2.5">
                    <span class="material-icons text-accent-2">email</span>
                    <span class="text-accent-2">sma.maarif.pacet@gmail.com</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="material-icons text-accent-2">phone</span>
                    <span class="text-accent-2">+62 856-2485-7093</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="https://id-id.facebook.com/smarter83/">
                        <i class="fa-brands fa-square-facebook text-white hover:text-yellow-200 text-2xl"></i>
                    </a>
                    <a href="https://www.instagram.com/smamaarifpacet/">
                        <i class="fa-brands fa-instagram text-white text-2xl hover:text-yellow-200"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-youtube text-white text-2xl hover:text-yellow-200"></i>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <h3 class="font-semibold text-lg mb-2 text-accent-2">Profile</h3>
            <div class="flex flex-col gap-2">
                <a href="{{route('about-us')}}" class="text-accent-2">About Us</a>
                <a href="{{route('contact-us')}}" class="text-accent-2">Contact Us</a>
                <a href="{{route('teachers-staffs')}}" class="text-accent-2">Teachers & Staffs</a>
                <a href="{{route('subjects')}}" class="text-accent-2">Subjetcs</a>
            </div>
        </div>
        <div>
            <h3 class="font-semibold text-lg mb-2 text-accent-2">Link Terkait</h3>
            <div class="flex flex-col gap-2">
                <a href="#" class="text-accent-2">E-Library</a>
                <a href="#" class="text-accent-2">PPDB</a>
                <a href="{{route('extracurriculars')}}" class="text-accent-2">Extracurriculars</a>
                <a href="{{ route('galleries') }}" class="text-accent-2">Galleries</a>
            </div>
        </div>
    </div>
    <div class="max-w-screen-lg mx-auto p-5 flex flex-col lg:flex-row justify-between text-sm border-t gap-2 lg:gap-0">
        <p class="text-accent-2">&copy; 2023 The President and Fellows of Ma'arif High School</p>
        <div class="flex gap-5 justify-center lg:justify-end">
            <a href="#" class="text-accent-2">Privacy Policy</a>
            <a href="#" class="text-accent-2">Terms & Condition</a>
        </div>
    </div>
</footer>
