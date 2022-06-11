<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Email List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('sessionMessage')

                    <a href="{{ route('dashboard.email.create') }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</a>

                    <div class="bg-gray-50 dark:bg-gray-700 mb-4 sm:rounded-lg">
                        <div class="flex justify-between">
                            <div class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Email
                            </div>
                            <div class="py-3 px-6 text-right text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                Action
                            </div>
                        </div>
                    </div>

                    @forelse($emails as $email)
                    <div>
                        <div class="flex justify-between">
                            <div class="flex py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="mr-3">
                                    <p>{{ $loop->iteration }}</p>
                                </div>
                                <a href="{{ route('dashboard.email.show',$email->id) }}">{{ $email->email }}</a>
                            </div>
                            <div class="flex">
                                <div class="mx-4">

                                    <button id="emailButton{{ $email->id }}" data-dropdown-toggle="email{{ $email->id }}" data-dropdown-placement="left" class="mb-3 md:mb-0 text-white @if($email->sendgrid_id)bg-blue-700 @else bg-red-700 @endif hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>Actions</button>

                                    <!-- Dropdown menu -->
                                    <div id="email{{ $email->id }}" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <div class="py-1 text-sm text-gray-700 dark:text-gray-200 text-center" aria-labelledby="dropdownDefault">
                                            <div>
                                                <a href="{{ route('dashboard.email.edit',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                            </div>
                                            <div>
                                                <a href="{{ route('dashboard.email.show',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>
                                            </div>
                                            <div>
                                                <form action="{{ route('dashboard.email.destroy',$email->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Wanna delete task')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('dashboard.email.getSendgridId',$email->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Get ID from sendgrid</button>
                                                </form>
                                            </div>
                                            <div>
                                                <button class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full" type="button" data-modal-toggle="popup-modal{{$email->id}}">
                                                    List
                                                </button>


                                            </div>
                                        </div>
                                    </div>


                                                        <div id="popup-modal{{$email->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
                                                            <div class="relative p-4 w-full max-w-lg h-full md:h-auto">

                                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                                                    <div class="flex justify-end p-2">
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal{{$email->id}}">
                                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                        </button>
                                                                    </div>

                                                                    <div class="p-6 pt-0 text-left">
                                                                        <div class="grid md:grid-cols-2 gap-2">
                                                                            @forelse($lists as $list)
                                                                                <div class="flex justify-between">
                                                                                    <div>
                                                                                        <form action="{{ route('dashboard.addContactToList',['list_id' => $list->id, 'email_id' => $email->id,]) }}" method="POST">
                                                                                            @csrf
                                                                                            <button type="submit" class="w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded"><span>@foreach($list->email as $p_list) @if($p_list->id === $email->id) <i class="fa-regular fa-circle-check"></i> @endif @endforeach</span>{{$list->name}}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div>
                                                                                        @foreach($list->email as $p_list)
                                                                                            @if($p_list->id === $email->id)
                                                                                                <form action="{{ route('dashboard.deleteContactFromList', ['list_id' => $list->sendgrid_id, 'email_id' => $email->id]) }}" method="POST">
                                                                                                    @csrf
                                                                                                    <button type="submit" class="w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded"><span><i class="fa-solid fa-xmark"></i></span></button>
                                                                                                </form>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            @empty
                                                                                <p class="py-4 px-6">There is no lists.</p>
                                                                            @endforelse
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach


                                                    </div>
                                                    <div class="py-4 px-6">
                                                        {{ $emails->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>






                                        <div class="py-12">
                                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                    <div class="p-6 bg-white border-b border-gray-200">
                                                        <div class="flex flex-col">
                                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                                                                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                                                                        <table class="min-w-full">

                                                                            <tbody>

                                    {{--                                        @forelse($emails as $email)--}}
{{--                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">--}}
{{--                                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">--}}
{{--                                                    <a href="{{ route('dashboard.email.show',$email->id) }}">{{ $email->email }}</a>--}}
{{--                                                </td>--}}
{{--                                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">--}}
{{--                                                    <div class="flex">--}}
{{--                                                        <div>--}}
{{--                                                            <button id="emailButton{{ $email->id }}" data-dropdown-toggle="email{{ $email->id }}" data-dropdown-placement="left" class="mb-3 md:mb-0 text-white @if($email->sendgrid_id)bg-blue-700 @else bg-red-700 @endif hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>Actions</button>--}}

{{--                                                            <!-- Dropdown menu -->--}}
{{--                                                            <div id="email{{ $email->id }}" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">--}}
{{--                                                                <ul class="py-1" aria-labelledby="emailButton{{ $email->id }}">--}}
{{--                                                                    <li>--}}
{{--                                                                        <a href="{{ route('dashboard.email.edit',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <a href="{{ route('dashboard.email.show',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}

{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <form action="{{ route('dashboard.email.destroy',$email->id) }}" method="POST">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('DELETE')--}}
{{--                                                                            <button type="submit" onclick="return confirm('Wanna delete task')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <form action="{{ route('dashboard.email.getSendgridId',$email->id) }}" method="POST">--}}
{{--                                                                            @csrf--}}
{{--                                                                            <button type="submit" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Get ID from sendgrid</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <button id="emailButton{{ $email->id }}" data-dropdown-toggle="email{{ $email->id }}" data-dropdown-placement="left" class="mb-3 md:mb-0 text-white @if($email->sendgrid_id)bg-blue-700 @else bg-red-700 @endif hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>Actions</button>--}}

{{--                                                            <!-- Dropdown menu -->--}}
{{--                                                            <div id="email{{ $email->id }}" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">--}}
{{--                                                                <ul class="py-1" aria-labelledby="emailButton{{ $email->id }}">--}}
{{--                                                                    <li>--}}
{{--                                                                        <a href="{{ route('dashboard.email.edit',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <a href="{{ route('dashboard.email.show',$email->id) }}" class="flex justify-center py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}

{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <form action="{{ route('dashboard.email.destroy',$email->id) }}" method="POST">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('DELETE')--}}
{{--                                                                            <button type="submit" onclick="return confirm('Wanna delete task')" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li>--}}
{{--                                                                        <form action="{{ route('dashboard.email.getSendgridId',$email->id) }}" method="POST">--}}
{{--                                                                            @csrf--}}
{{--                                                                            <button type="submit" class="w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Get ID from sendgrid</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @empty--}}
{{--                                            <tr>--}}
{{--                                                <td class="py-4 px-6">There is no Email in this lists.</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforelse--}}


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
