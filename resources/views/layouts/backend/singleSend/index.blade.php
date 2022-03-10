<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Single Send') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('sessionMessage')

                    <a href="{{ route('dashboard.single-sends.create') }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</a>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden shadow-md sm:rounded-lg">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Single Send
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-right text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @forelse($singleSends as $singleSend)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <a href="{{ route('dashboard.single-sends.show',$singleSend->id) }}">{{ $singleSend->name }}</a>
                                                </td>
                                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                    <button id="dropdownLeftButton{{ $singleSend->id }}" data-dropdown-toggle="dropdownLeft{{ $singleSend->id }}" data-dropdown-placement="left" class="mb-3 md:mb-0 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>Actions</button>

                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownLeft{{ $singleSend->id }}" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                                        <ul class="py-1" aria-labelledby="dropdownLeftButton{{ $singleSend->id }}">
                                                            <li>
                                                                <a href="{{ route('dashboard.single-sends.edit',$singleSend->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('dashboard.single-sends.show',$singleSend->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('dashboard.single-sends.updateSchedule') }}" method="post">
                                                                    @csrf
                                                                    <input name="singleSendID" type="hidden" id="singleSendID" value="{{ $singleSend->sendgrid_id }}">
                                                                    <button type="submit" onclick="return confirm('Mail will start sending after 5 minutes')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Schedule</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('dashboard.single-sends.cancelSchedule') }}" method="post">
                                                                    @csrf
                                                                    <input name="singleSendID" type="hidden" id="singleSendID" value="{{ $singleSend->sendgrid_id }}">
                                                                    <button type="submit" onclick="return confirm('Wanna cancel mail schedule')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Unscheduled</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('dashboard.single-sends.destroy',$singleSend->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" onclick="return confirm('Wanna delete single send')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="py-4 px-6">There is no Single Send in this lists.</td>
                                            </tr>
                                        @endforelse


                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-4 px-6">
                                    {{ $singleSends->links() }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
