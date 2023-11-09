<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold mb-6 text-gray-900">Reservation History</h1>

                @if ($reservations->isEmpty())
                    <p class="text-gray-600">No reservations found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 shadow rounded">
                            <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">Reservation ID</th>
                                <th class="py-2 px-4 border-b">Check-in Date</th>
                                <th class="py-2 px-4 border-b">Check-out Date</th>
                                <th class="py-2 px-4 border-b">Total Price</th>
                                <th class="py-2 px-4 border-b">Room</th>
                                <th class="py-2 px-4 border-b">Type</th>
                                <th class="py-2 px-4 border-b">Hotel Location</th>
                                <th class="py-2 px-4 border-b">Payment Method</th>
                                <th class="py-2 px-4 border-b">Review</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="py-2 px-4">
                                        <div class="text-center">
                                            {{ $reservation->id }}
                                        </div>
                                    </td>
                                    <td class="py-2 px-4">{{ $reservation->checkin }}</td>
                                    <td class="py-2 px-4">{{ $reservation->checkout }}</td>
                                    <td class="py-2 px-4">Rp.{{ number_format($reservation->total_price) }}</td>
                                    <td class="py-2 px-4">{{ $reservation->room->number }}</td>
                                    <td class="py-2 px-4">{{ $reservation->room->type->name }}</td>
                                    <td class="py-2 px-4">{{ $reservation->room->branchAddress->city }}</td>
                                    <td class="py-2 px-4 flex items-center">
                                        @if ($reservation->payment->bank_image_path)
                                            <img src="{{ asset('storage/' . $reservation->payment->bank_image_path) }}" alt="{{ $reservation->payment->bank_name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            {{ $reservation->payment->bank_name }}
                                        @endif
                                    </td>

                                    <td class="py-2 px-4">
                                        @if ($reservation->rating)
                                            <div class="text-md">
                                                @for ($i = 1; $i <= $reservation->rating->rating; $i++)
                                                    <i class="fa fa-star text-yellow-500 fa-sm"></i>
                                                @endfor
                                                @for ($i = $reservation->rating->rating; $i < 5; $i++)
                                                    <i class="fa fa-star fa-sm"></i>
                                                @endfor
                                            </div>
                                        @else
                                            <x-route-button href="/review/{{$reservation->id}}">{{ __('Give Review') }}</x-route-button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>


