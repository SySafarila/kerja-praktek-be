@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="flex flex-col gap-y-8 my-28 ">
        <div class="flex gap-x-8 max-w-screen-lg mx-auto">
            <div class="mx-auto justify-center">
                <h1 class="font-semibold text-xl">HUBUNGI KAMI</h1>
                <div class="border-b-2 border-accent-3 my-1"></div>
                <p class="max-w-screen-lg text-justify">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus nulla,
                    cupiditate
                    odioLorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus nulla,
                    cupiditate
                    odioLorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus nulla,
                    cupiditate
                    odioLorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quisquam ut possimus nulla,
                    cupiditate
                </p>
                <ul style="list-style-type: circle;" class="pl-6 mt-1">
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dicta sed maiores voluptates maxime,
                        officiis perspiciatis fugit illum, minus earum velit aut quasi, quas cum provident? Dolorum odit
                        eius corrupti!
                    </li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dicta sed maiores voluptates maxime,
                        officiis perspiciatis fugit illum, minus earum velit aut quasi, quas cum provident? Dolorum odit
                        eius corrupti!
                    </li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dicta sed maiores voluptates maxime,
                        officiis perspiciatis fugit illum, minus earum velit aut quasi, quas cum provident? Dolorum odit
                        eius corrupti!
                    </li>
                </ul>
                <h1 class="font-semibold text-xl mt-6">PETA LOKASI</h1>
                <div class="border-b-2 border-accent-3 my-1 mb-2"></div>
                <div style="max-width:100%;list-style:none; transition: none;overflow:hidden;width:100%;height:320px;">
                    <div id="embed-map-display" style="height:100%; width:100%;max-width:100%;"><iframe
                            style="height:100%;width:100%;border:0;" frameborder="0"
                            src="https://www.google.com/maps/embed/v1/place?q=SMA+MA'ARIF+PACET,+Cipendawa,+Cianjur+Regency,+West+Java,+Indonesia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                    </div><a class="googlecoder" rel="nofollow" href="https://www.bootstrapskins.com/themes"
                        id="grab-map-info">premium bootstrap themes</a>
                    <style>
                        #embed-map-display img {
                            max-height: none;
                            max-width: none !important;
                            background: none !important;
                        }
                    </style>
                </div>
            </div>
            <div class="flex flex-col gap-y-4">
                <img src="{{ asset('images/logos/logo1a.png') }}" class="object-cover max-w-screen-sm w-full"
                    alt="">
                <p class="max-w-screen-sm text-justify">
                    <b>NPSN :</b> 20252047
                    <br>
                    <b>Status :</b> Swasta
                    <br>
                    <b>Alamat :</b> Jl.Raya Pacet No.30 RT/RW 04/04 Kp. Pasircina Desa Cipendawa Kecamatan Pacet Kabupate
                    Cianjur Jawa Barat 43253
                    <br>
                    <i class="far fa-envelope text-lg mr-1"></i><a class="hover:text-accent-1 transition"
                        href="mailto:sma.maarif.pacet@gmail.com">
                        sma.maarif.pacet@gmail.com</a>
                    <br>
                    <i class="fa fa-phone text-lg mr-2"></i><a class="hover:text-accent-1 transition" href="tel:+6285624857093">085624857093</a>
                    <br>
                    <i class="fab fa-whatsapp text-xl font-semibold mr-2"></i>081808415141
                </p>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
