<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success font-medium text-sm text-green-600 my-4 mx-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4 mb-5">
                        {{ __('Customer Ticket Form') }}
                    </h2>
                    <hr/>
                    <form action="{{ route('tickets.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="w-1/2 mx-4 my-4">
                                <x-input-label for="reservation" :value="__('Reservation')"/>
                                <select name="reservation" class="form-input" style="width: 100%">
                                    <option value="0">
                                        Reservation list
                                    </option>
                                    @foreach ($reservations as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->room->number . ' - ' . $item->room->type->name .  " (" . $item->checkin . " to " . $item->checkout . ") " }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('reservation')" class="mt-2" />
                        </div>
                        <div class="mx-4 my-8">
                            <x-input-label for="image_path" :value="__('Picture *')" />
                            <x-text-input id="image_path" name="image_path" type="file" accept="image/*" class="mt-1 block w-full" :value="old('image_path')" />
                            <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
                        </div>
                        <div class="m-4">
                            <x-input-label for="message" :value="__('Description')"/>
                            <textarea name="message" x-model="message"
                                style="
                                    resize:none;
                                    width: 30vw;
                                    height: 15vh;
                            "></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            <br><br>* not required
                        </div>

                        <div class="flex items-center justify mt-9">
                            <x-primary-button class="ml-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                        @if(isset($success))
                        <div x-data="{ success: '{{$success}}' }">
                            <strong x-text="success"></strong>
                        </div>
                        @endif
                    </form>
                    

                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4 mb-5">
                        {{ __('Your sent tickets') }}
                    </h2>
                    <hr/>
                    <div class="container">
                    @foreach ($tickets as $ticket)
                    <div class="mb-4 md:mb-0">

                        <div class="mx-4 my-8" x-data="{ open: false }">
                            <button x-on:click="open = !open">
                                {{ $ticket->reservation->room->number .
                                ' - ' . $ticket->reservation->room->type->name . 
                                " (" . $ticket->reservation->checkin . 
                                " to " . $ticket->reservation->checkout . 
                                ") " }}
                                <span :class="{'rotated': open}">&raquo;</span>
                                <style>
                                    .rotated {
                                    transform: rotate(90deg);
                                    display: inline-block;
                                    }
                                </style>
                            </button>
                            <div class="bg-neutral-200">
                                <ul x-show="open">
                                    <li>
                                        <div class="mx-4 my-8 mb-5">
                                            ================
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $ticket->image_path)) }}"
                                            style="height: 200px; object-fit: cover;" alt="No image">
                                            ================

                                        </div>
                                    </li>     
                                    <li><div class="mx-4 my-8">
                                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                                            {{ __('Description') }}
                                        </h2>
                                        <hr>
                                        <div class="ml-3">
                                            {{$ticket->description}}
                                        </div>
                                    </div></li>
                                </ul>
                            </div>
                        </div>
                        
                        <hr>
                    @endforeach
                    </div>

                    {{$tickets->links()}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
