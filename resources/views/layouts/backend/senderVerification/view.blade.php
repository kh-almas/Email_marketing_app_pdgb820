<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sender Verification Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-6">
                        <div class="py-4">
                            <p><span class="font-semibold">Sendgrid Id:</span> {{ $sender_verification->sendgrid_id }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Nickname: </span> {{ $sender_verification->nickname }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold mr-6">From email: </span> {{ $sender_verification->from_email }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">From name: </span> {{ $sender_verification->from_name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Reply to: </span> {{ $sender_verification->reply_to }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Reply to name: </span> {{ $sender_verification->reply_to_name }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Address: </span> {{ $sender_verification->address }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Address 2: </span> {{ $sender_verification->address2 }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">State: </span> {{ $sender_verification->state }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">City: </span> {{ $sender_verification->city }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Country: </span> {{ $sender_verification->country }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">ZIP:</span> {{ $sender_verification->zip }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Verified: </span> {{ $sender_verification->verified === 1 ? 'True' : 'False' }}</p>
                        </div>
                        <div class="py-4">
                            <p><span class="font-semibold">Locked: </span> {{ $sender_verification->locked === 1 ? 'True' : 'False' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
