<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unsubscribe Group Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('dashboard.updateGroup', $unsubscribe_group->sendgrid_id) }}" method="post">
                        @csrf
                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update group</button>
                    </form>

                    <div class="py-6">
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Id:</span> {{ $unsubscribe_group->sendgrid_id }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Name:</span> {{ $unsubscribe_group->name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold mr-6">Description:</span> {{ $unsubscribe_group->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
