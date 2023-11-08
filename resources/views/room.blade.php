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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-semibold mb-4">Room Details</h1>
                    <div class="flex flex-wrap items-start">
                        <div class="w-full">
                            <div class="owl-carousel owl-theme">
                                @foreach($room->images as $image)
                                    <div class="item">
                                        <a href="{{ asset('storage/' . $image->image_path) }}"
                                           data-lightbox="room-images">
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
                                    <i class="fas fa-map-marker-alt text-green-500"></i> Branch
                                    Address: {{ $room->branchAddress->street_address}}, {{$room->branchAddress->city}}
                                    , {{$room->branchAddress->state}}
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
                                <br>
                                <form action="/" method="get" style="direction: rtl">
                                    <div class="w-1/4 flex-fill">
                                        <x-input-label for="daterange" :value="__('Date')"/>
                                        <input type="text" name="daterange" class="text-center datepicker-input"
                                               style="width: 100%;" @if(isset($parameters['daterange']))
                                                   value="{{ $parameters['daterange']}}" @endif
                                        />

                                        <script>
                                            $(function () {
                                                $('input.datepicker-input').daterangepicker({
                                                    opens: 'left'
                                                }, function (start, end, label) {
                                                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="text-right mt-4 flex">
                                        <x-primary-button>{{ __('Book Now') }}</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="w-full mt-8">
                            <h2 class="text-2xl font-semibold mb-4">User Reviews</h2>
                            <div class="grid grid-cols-1">
                                <!-- Dummy Review 1 -->
                                <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 mb-4">
                                    <div class="flex justify-between">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ asset('storage/statics/user.png') }}" alt="User 2" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-fill">
                                            <div class="text-right">
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="text-right mt-4">
                                                <p class="ml-2">2023-11-08</p>

                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold mt-2">User 2</h3>
                                    <p class="text-gray-600">Enjoyed my stay. Highly recommended!</p>
                                </div>

                                <!-- Dummy Review 2 -->
                                <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 mb-4">
                                    <div class="flex justify-between">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ asset('storage/statics/user.png') }}" alt="User 2" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-fill">
                                            <div class="text-right">
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star text-yellow-500"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="text-right mt-4">
                                                <p class="ml-2">2023-11-08</p>

                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold mt-2">User 2</h3>
                                    <p class="text-gray-600">Enjoyed my stay. Highly recommended!</p>
                                </div>


                                <!-- Add more dummy reviews here -->
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
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                items: 1,
                nav: true,
                dots: true,
            });
        });
    </script>
</x-app-layout>
