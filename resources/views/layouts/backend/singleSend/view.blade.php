<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Single Send Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('dashboard.viewMail',$single_send->id) }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View Template</a>

                    <div class="py-6">
                        <div class="py-4">
                            <p><span class="font-semibold">Lists:</span></p>
                        </div>


                        <div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-2 dark:bg-gray-800 dark:border-gray-700">
                            @foreach($single_send->lists as $list)
                                <p class="text-base text-gray-500 sm:text-lg dark:text-gray-400">{{ $list->name }}</p>
                            @endforeach
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">SendGrid Id:</span> {{ $single_send->sendgrid_id }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">List Id:</span> {{ $list->name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Suppression Group Name: </span> {{ $suppression->name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold mr-6">Sender Nickname: </span> {{ $sender->nickname }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Name: </span> {{ $single_send->name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Subject: </span> {{ $single_send->subject }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
