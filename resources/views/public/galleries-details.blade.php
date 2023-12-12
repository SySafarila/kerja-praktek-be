@extends('layouts.public')

@section('head')
    <style>
        body {
            background: #ECECEC;
        }

        /* Style for the image modal */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            width: auto;
            height: 80%;
            max-width: 80%;
            max-height: 80%;
            margin: auto;
            display: block;
        }

        .close-btn {
            color: white;
            font-size: 30px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div style="background-image: url({{ asset('images/photos/photo2.png') }})" class="w-full">
        <div class="bg-[#356F11]/70 backdrop-blur-[1px]">
            <div class="max-w-screen-lg mx-auto lg:px-5 relative h-40 lg:h-60">
                <div
                    class="lg:w-[calc(100%-40px)] w-full lg:left-5 h-full left-0 top-0 absolute p-5 lg:px-10 flex flex-col justify-center gap-y-5">
                    <h1 class="text-accent-4 font-semibold text-xl lg:text-3xl uppercase">{{ $galleries->title }} SMA MA'ARIF
                        PACET</h1>

                    <div class="flex justify-between text-sm pt-8">
                        <span class="text-white">
                            {{-- Display user's local date and time in Indonesian format --}}
                            <p class="text-accent-4" id="user-local-date-time"></p>
                            {{-- Add a space if both date/time and location are displayed --}}
                            <p class="text-accent-4" id="user-location"></p>
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-lg mx-auto  my-8">
        <div class="flex flex-col bg-white px-16 py-8">
            <h1 class="font-bold text-5xl px-8 py-2 uppercase">{{ $galleries->title }} SMA MA'ARIF PACET </h1>
            <span class="px-8">{{ Carbon\Carbon::parse($galleries->created_at)->format('d F Y') }} - Cianjur</span>
            <img src="{{ asset('storage/galleryThumbnails/' . $galleries->thumbnail) }}"
                class="w-full h-96 object-cover my-4" alt="">
            <p class="whitespace-pre-line px-8">{{ $galleries->description }}</p>
            <div class="grid grid-cols-3 gap-x-3 px-8 mt-4">
                @foreach ($galleries->images as $image)
                    <img src="{{ asset('storage/galleryImages/' . $image->images) }}"
                        class="w-full h-40 object-cover my-4 image-modal-trigger" alt="">

                    <!-- Image modal for each image -->
                    <div class="image-modal" data-image="{{ asset('storage/galleryImages/' . $image->images) }}">
                        <span class="close-btn" onclick="closeImageModal()">&times;</span>
                        <img src="{{ asset('storage/galleryImages/' . $image->images) }}" class="modal-content"
                            alt="">
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection

@section('script')
    <script>
        // Function to open the image modal
        function openImageModal() {
            const modal = this.nextElementSibling; // Get the next sibling, which is the modal
            modal.style.display = 'block';
        }

        // Function to close the image modal
        function closeImageModal() {
            document.querySelectorAll('.image-modal').forEach(function(modal) {
                modal.style.display = 'none';
            });
        }

        // Attach a click event to each image to open the respective modal
        document.querySelectorAll('.image-modal-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', openImageModal);
        });

        // Close the modal if the user clicks outside the image or on the close button
        document.querySelectorAll('.image-modal').forEach(function(modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === this || event.target.classList.contains('close-btn')) {
                    closeImageModal();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userLocalDateTimeElement = document.getElementById('user-local-date-time');
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                timeZoneName: 'short'
            };
            const userLocalDateTime = new Date().toLocaleDateString('id-ID', options);
            userLocalDateTimeElement.textContent = userLocalDateTime;

            const userLocationElement = document.getElementById('user-location');
            const userLocation = 'Your Location';
            userLocationElement.textContent = userLocation ? ` ${userLocation}` : '';
        });
    </script>
@endsection
