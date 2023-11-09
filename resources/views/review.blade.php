<!-- Latest compiled and minified CSS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold mb-6 text-gray-900">Write a Review</h1>

                <div style="max-width: 100%; display: flex; flex-direction: column;">
                    <!-- Image Carousel -->
                    <div style="padding: 20px; flex: 1;">
                        <div class="owl-carousel owl-theme" style="flex: 1;">
                            @foreach($reservation->room->images as $image)
                                <div class="item">
                                    <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="room-images">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" style="height: 300px"
                                             class="w-full h-full object-cover rounded-lg shadow-lg">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Room and Reservation Details -->
                    <div class="mb-4">
                        <h2 class="text-2xl font-semibold mb-2">Room Details</h2>
                        <p>Room Number: {{ $reservation->room->number }}</p>
                        <p>Room Type: {{ $reservation->room->type->name }}</p>
                        <p>Hotel Address: {{ $reservation->room->branchAddress->street_address }}
                            , {{ $reservation->room->branchAddress->city }}
                            , {{ $reservation->room->branchAddress->state }}</p>

                        <h2 class="text-2xl font-semibold mb-2 mt-4">Reservation Details</h2>
                        <p>Check-in Date: {{ $reservation->checkin }}</p>
                        <p>Check-out Date: {{ $reservation->checkout }}</p>
                        <p>Total Price: Rp.{{ number_format($reservation->total_price) }}</p>
                        <!-- Add other reservation details as needed -->
                    </div>

                    <!-- Review Form -->
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                        <div class="mb-4">
                            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                            <div id="rating" style="width: 200px;"></div>
                            <input type="hidden" name="rating" id="rating_input" value="" />
                        </div>


                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                            <textarea id="comment" name="comment" rows="4" class="border rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $("#rating").rateYo({
                rating: 4,
                starWidth: "50px",
                fullStar: true,
                onChange: function (rating, rateYoInstance) {
                    // Update a hidden input field with the selected rating
                    $("#rating_input").val(rating);
                }
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 4000, // Set autoplay interval to 4 seconds
            });
        });
    </script>


</x-app-layout>


