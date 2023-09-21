<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ asset('img/ecountsnew.jpeg') }}" alt="" style="height:60vh; width:100%;" class="img-thumbnail">
            </div>
        </div>
    </div>
</x-app-layout>
