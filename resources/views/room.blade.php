<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Vf538c87W63D6F5szc/0lRtPpz2tnw0tm41LrB/Hdi5r5X2b6Nc8J6mKSp3F7If6" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($room->number) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-semibold mb-4">Room Details</h1>
                    <div class="flex flex-wrap items-start">
                        <div class="w-full">
                            <div class="owl-carousel owl-theme">
                                @foreach($room->images as $image)
                                    <div class="item">
                                        <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="room-images">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 alt="{{ $room->name }}"
                                                 class="w-full object-cover rounded-lg shadow-lg h-400">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <h2 class="text-xl font-semibold">{{ $room->name }}</h2>
                            <p class="text-gray-500">{{ $room->description }}</p>
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 font-semibold">
                                    <i class="fas fa-bed text-blue-500"></i> Room Number: {{ $room->number }}
                                </p>
                                <p class="text-sm text-gray-700 font-semibold">
                                    <i class="fas fa-map-marker-alt text-green-500"></i> Branch Address: {{ $room->branchAddress->street_address}}, {{$room->branchAddress->city}}, {{$room->branchAddress->state}}
                                </p>
                                <p class="text-sm text-gray-700 font-semibold">
                                    <i class="fas fa-users text-red-500"></i> Capacity: {{ $room->capacity }} people
                                </p>
                            </div>
                            <div class="mt-4">
                                <div class="text-sm text-gray-700 flex justify-between">
                                    <p>
                                        <i class="fas fa-bed text-blue-500"></i> Room Type: {{ $room->type->name }}
                                    </p>
                                    <p class="font-semibold">Price: ${{ $room->type->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .owl-carousel .item img {
            height: 400px;
            object-fit: cover;
        }
    </style>

    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                items: 1,
                nav: true,
                dots: true,
            });
        });
    </script>
</x-app-layout>
