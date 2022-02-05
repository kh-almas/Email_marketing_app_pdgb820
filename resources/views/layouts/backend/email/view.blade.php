<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Emails Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">

                        <div class="py-4">
                            <p><span class="font-semibold">list_ids:</span> {{ $email->list_ids }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Id:</span> {{ $email->sendgrid_id }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Metadata:</span> {{ $email->sendgrid_metadata }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold mr-6">First Name:</span> {{ $email->first_name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Last Name:</span> {{ $email->last_name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Unique Name:</span> {{ $email->unique_name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Email:</span> {{ $email->email }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Address Line 1:</span> {{ $email->address_line_one }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Address Line 2:</span> {{ $email->address_line_two }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">City:</span> {{ $email->city }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">State Province Region:</span> {{ $email->state }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Postal Code:</span> {{ $email->postal_code }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Country:</span> {{ $email->country }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Phone Number:</span> {{ $email->phone_number }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Whatsapp:</span> {{ $email->whatsapp }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Facebook:</span> {{ $email->facebook }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Line:</span> {{ $email->line }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Alternate Emails:</span> {{ $email->alternate_emails }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
