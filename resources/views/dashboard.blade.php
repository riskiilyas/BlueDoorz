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
                    <form action="" method="post">
                        <div class="flex space-x-1"> <!-- Use the 'flex' and 'space-x-4' classes -->
                            <div class="w-1/4">
                                <x-input-label for="daterange" :value="__('Date')"/>
                                <input type="text" name="daterange" class="form-input" style="width: 100%"/>

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
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-1/4">
                                <x-input-label for="city" :value="__('City')"/>
                                <select name="city" class="form-input" style="width: 100%">
                                    @foreach (\App\Models\BranchAddress::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end items-end"> <!-- Use 'items-end' to align items to the bottom -->
                                <x-primary-button>{{ __('Search') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="py-12">--}}
    {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
    {{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
    {{--                <div class="p-6 text-gray-900">--}}
    {{--                    {{ __("Booking") }}--}}
    {{--                    <br><br>--}}
    {{--                    <form action="" method="post">--}}
    {{--                        <span class="row mx-md-n5">--}}
    {{--                            <x-input-label for="daterange" :value="__('Date')"/>--}}
    {{--                            <input type="text" name="daterange" style="width:30%;"/>--}}

    {{--                            <script>--}}
    {{--                                $(function () {--}}
    {{--                                    $('input[name="daterange"]').daterangepicker({--}}
    {{--                                        opens: 'left'--}}
    {{--                                    }, function (start, end, label) {--}}
    {{--                                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
    {{--                                    });--}}
    {{--                                });--}}
    {{--                            </script>--}}
    {{--                            <x-input-label for="category_id" :value="__('Room Type')"/>--}}
    {{--                            <select name="type" class="form-control">--}}
    {{--                                @foreach (\App\Models\RoomType::all() as $item)--}}
    {{--                                    <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
    {{--                                @endforeach--}}
    {{--                            </select>--}}
    {{--                            <x-input-label for="city" :value="__('City')"/>--}}
    {{--                            <select name="city" class="form-control">--}}
    {{--                                @foreach (\App\Models\BranchAddress::all() as $item)--}}
    {{--                                    <option value="{{ $item->id }}">{{ $item->city }}</option>--}}
    {{--                                @endforeach--}}
    {{--                            </select>--}}
    {{--                        </span>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</x-app-layout>
