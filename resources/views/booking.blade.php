<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($room->number) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden flex items-center">
                <div class="container mx-auto p-4 w-1/2">
                    <!-- Information section -->
                    <h1 class="text-2xl font-semibold mb-4">Upload Proof of Payment</h1>
                    <div class="mb-4">
                        <!-- Booking Details -->
                        <p class="font-medium text-gray-700">Booking Details:</p>
                        <!-- Total Price -->
                        <h2><i class="fa fa-tag text-blue-500"></i> Total Price: Rp.{{ number_format($totalPrice) }}</h2>
                        <!-- Date -->
                        <h2 class="text-md text-gray-700 font-semibold">
                            <i class="fa fa-calendar text-blue-500"></i> Date: @if(isset($parameters['daterange']))
                                {{ $parameters['daterange']}}
                            @else
                                Today
                            @endif
                        </h2>
                    </div>
                    <p class="mb-4 font-medium text-gray-700">Bank Account for Transfer:</p>
                    <p><strong>Bank Name:</strong> Bank BCA</p>
                    <p><strong>Account Name:</strong> BlueDoorz ltd</p>
                    <p><strong>Account Number:</strong> 023109836282</p>
                </div>

                <div class="w-1/2" style="height: 300px; max-width: 500px;">
                    <!-- Image Carousel -->
                    <div style="padding: 20px;"> <!-- Adjust the padding value as needed -->
                        <div class="owl-carousel owl-theme">
                            @foreach($room->images as $image)
                                <div class="item">
                                    <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="room-images">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $room->name }}"
                                             class="w-full h-full object-cover rounded-lg shadow-lg">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <!-- Form section -->
            <form action="/" method="post" enctype="multipart/form-data" class="container mx-auto p-4 w-1/2">
                @csrf
                <div class="mb-4 overflow-hidden items-center flex flex-col"> <!-- Center the label and input vertically -->
                    <label for="payment_proof" class="block font-medium text-gray-700 text-center mb-2">Payment Proof</label>
                    <div class="flex justify-center"> <!-- Center the displayed image horizontally -->
                        <img id="selectedImage" src="" alt="Selected Image" class="mt-4" style="max-width: 100%; max-height: 200px; display: none; margin: auto; border-radius: 10px;">
                    </div>
                    <br>
                    <div class="flex items-center justify-center">
                        <input type="file" name="payment_proof" id="payment_proof" accept=".png, .jpg, .jpeg"
                               class="border rounded w-full p-2 py-3" onchange="displayImage(this);">
                    </div>
                </div>
                <div class="flex justify-center"> <!-- Center the button horizontally -->
                    <x-primary-button>{{ __('Submit Payment') }}</x-primary-button>
                </div>
            </form>
            <script>
                function displayImage(input) {
                    const selectedImage = document.getElementById('selectedImage');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            selectedImage.style.display = 'block';
                            selectedImage.src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        selectedImage.style.display = 'none';
                        selectedImage.src = '';
                    }
                }
            </script>


            <br>
        </div>
    </div>

    <style>
        .owl-carousel .item img {
            height: 400px;
            object-fit: cover;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 4000, // Set autoplay interval to 2 seconds (2000 milliseconds)
            });
        });
    </script>
</x-app-layout>
