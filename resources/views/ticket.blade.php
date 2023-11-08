<style>
    textarea {
        resize:none;
        width:30vw;
        height:15vh;
    }
</style>

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

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4 mb-5">
                        {{ __('Customer Ticket Form') }}
                    </h2>
                    <hr/>
                    <form action="{{ route('tickets.submit') }}" method="post">
                        @csrf
                        
                        <div class="mx-4 my-8">
                            <x-input-label for="image_path" :value="__('Picture')" />
                            <x-text-input id="image_path" name="image_path" type="file" accept="image/*" class="mt-1 block w-full" :value="old('image_path')" />
                            <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
                        </div>
                        <div class="m-4">
                            <x-input-label for="message" :value="__('Description')"/>
                            <textarea x-model="message" style=""></textarea>
                        </div>

                        <div class="flex items-center justify mt-9">
                            <x-primary-button class="ml-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
