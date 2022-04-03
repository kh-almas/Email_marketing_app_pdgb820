<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Emails Information') }}
        </h2>
    </x-slot>

    <div class="mt-12 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">

                        <div class="py-4">
                            <p><span class="font-semibold">Name: {{$email_list->name}}</span> </p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Id: {{$email_list->sendgrid_id}}</span> </p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Contact Count: {{$email_list->sendgrid_contact_count}}</span> </p>
                        </div>
{{--                        <div class="py-4">--}}
{{--                            <p><span class="font-semibold">Sendgrid Metadata: {{$email_list->sendgrid_metadata}}</span> </p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Single Send Name
                                </th>
                                <th scope="col" class="py-3 px-6 text-right text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($email_list->singleSend as $singleSend)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('dashboard.single-sends.show',$singleSend->id) }}">{{ $singleSend->name }}</a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <form action="{{ route('dashboard.single-sends.destroy',$singleSend->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Wanna remove email from list')" class=" py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6">There is no single send in this lists.</td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">
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

                            @forelse($email_list->email as $email)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('dashboard.email.show',$email->id) }}">{{ $email->email }}</a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <form action="{{ route('dashboard.removeContactFromList', ['list_id' => $email_list->sendgrid_id, 'email_id' => $email->sendgrid_id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Wanna remove email from list')" class=" py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
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
