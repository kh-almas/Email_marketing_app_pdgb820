<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppression Group Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">

                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Id:</span> {{ $suppression_group->sendgrid_id }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Name:</span> {{ $suppression_group->name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold mr-6">Description:</span> {{ $suppression_group->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
