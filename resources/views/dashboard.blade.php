<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Booking") }}
                    <br><br>
                    <form action="{{ route('dashboard.search') }}" method="get">
                        <div class="flex space-x-1"> <!-- Use the 'flex' and 'space-x-4' classes -->
                            <div class="w-1/4">
                                <x-input-label for="daterange" :value="__('Date')"/>
                                <input type="text" name="daterange" class="form-input" style="width: 100%"
                                       @if(isset($parameters['daterange']))
                                           value="{{ $parameters['daterange']}}"
                                        @endif
                                />

                                <script>
                                    $(function () {
                                        $('input[name="daterange"]').daterangepicker({
                                            opens: 'left'
                                        }, function (start, end, label) {
                                            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                        });
                                    });
                                </script>
                            </div>

                            <div class="w-1/4">
                                <x-input-label for="category_id" :value="__('Room Type')"/>
                                <select name="type" class="form-input" style="width: 100%">
                                    @foreach (\App\Models\RoomType::all() as $item)
                                        <option value="{{ $item->id }}"
                                                @if(isset($parameters['type']))
                                                    @if($parameters['type']==$item->id)
                                                        selected
                                            @endif
                                            @endif
                                        >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-1/4">
                                <x-input-label for="city" :value="__('City')"/>
                                <select name="city" class="form-input" style="width: 100%">
                                    @foreach (\App\Models\BranchAddress::all() as $item)
                                        <option value="{{ $item->id }}"
                                                @if(isset($parameters['city']))
                                                    @if($parameters['city']==$item->id)
                                                        selected
                                            @endif
                                            @endif
                                        >{{ $item->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end items-end">
                                <!-- Use 'items-end' to align items to the bottom -->
                                <x-primary-button>{{ __('Search') }}</x-primary-button>
                            </div>
                            <div class="flex justify-end items-end">
                                <!-- Use 'items-end' to align items to the bottom -->
                                <x-route-button-red
                                    href="{{ route('dashboard') }}">{{ __('Clear Search') }}</x-route-button-red>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($rooms as $room)
                            <div class="mb-4 md:mb-0">
                                <div
                                    class="bg-white rounded-lg shadow p-4 h-full flex flex-col"> {{-- Set a fixed height with h-full and use flex for layout --}}
                                    <h2 class="text-xl font-semibold mb-2">{{ $room->type->name }}</h2>
                                    @foreach ($room->images as $image)
                                        @if ($loop->first && !empty($image->image_path))
                                            <img src="{{ asset('storage/'.$image->image_path) }}"
                                                 style="height: 200px; object-fit: cover;" alt="Room Image">
                                        @endif
                                    @endforeach
                                    <br>
                                    <h2>{{ $room->number }}</h2>
                                    <p class="text-gray-600">{{ $room->branchAddress->city }}
                                        , {{ $room->branchAddress->street_address }}</p>
                                    <p class="text-gray-600">Rp.{{ number_format($room->type->price) }}/Night</p>
                                    <br>
                                    <div
                                        class="mt-auto"> {{-- Use mt-auto to push the button to the bottom-left corner --}}
                                        <x-route-button
                                            href="{{ route('dashboard') }}">{{ __('Get Detail') }}</x-route-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
