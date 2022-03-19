<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <div class="mb-10 flex items-end">
                                    <button id="dropdownButton" data-dropdown-toggle="dropdown" class="font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

                                    <div id="dropdown" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <ul class="py-1" aria-labelledby="dropdownButton">
                                            <li>
                                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Daily</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Weekly</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Monthly</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="grid grid-cols-4 gap-6">
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Blocks</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->blocks}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Bounce Drops</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->bounce_drops}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Bounces</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->bounces}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Deferred</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->deferred}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Delivered</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->delivered}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Invalid Emails</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->invalid_emails}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Processed</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->processed}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Requests</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->requests}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Spam Report Drops</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->spam_report_drops}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Spam Reports</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->spam_reports}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Unsubscribe Drops</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->unsubscribe_drops}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Unsubscribes</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->unsubscribes}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Clicks</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->clicks}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Unique Clicks</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->unique_clicks}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Opens</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->opens}}</p>
                                    </div>
                                    <div class="hover:bg-gray-100 text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                        <p class="font-bold text-3xl mb-3 font-normal text-gray-700 dark:text-gray-400">Unique Opens</p>
                                        <p class="font-bold text-2xl mb-3 font-normal text-gray-700 dark:text-gray-400">{{$data->unique_opens}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <x-jet-welcome />--}}
            </div>
        </div>
    </div>
</x-app-layout>
