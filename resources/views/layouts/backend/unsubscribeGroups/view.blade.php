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
                    @include('sessionMessage')

                    <form action="{{ route('dashboard.updateGroup', $unsubscribe_group->id) }}" method="post">
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






        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Email
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-right text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($unsubscribe_group->email as $email)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p>{{ $email->email }}</a>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <form action="{{ route('dashboard.deleteEmailFromUnsubscribeGroup',['emailInfo'=>$email->id,'group_id'=>$unsubscribe_group->sendgrid_id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Wanna delete email from {{ $unsubscribe_group->name }} group')" class=" py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4 px-6">There is no Email in this lists.</td>
                                    </tr>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
