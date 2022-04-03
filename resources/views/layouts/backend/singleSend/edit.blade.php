<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Single Send') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.single-sends.update', $single_send->id) }}" method="POST">
                        @csrf
                        @method('put')


                        <div class="mb-6">
                            <label for="lists" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Lists</label>
                            <select
                                id="select-role"
                                name="lists[]"
                                placeholder="Select List..."
                                autocomplete="off"
                                class="block w-full rounded-sm cursor-pointer focus:outline-none"
                                multiple>
                                @forelse($contactList as $list)
                                    <option value="{{ $list->sendgrid_id }}" @foreach($single_send->lists as $s_s_list) @if($s_s_list->id === $list->id ) selected @endif @endforeach >{{ $list->name }}</option>
                                @empty
                                    <option>There don't have any list</option>
                                @endforelse
                                @error('lists')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>

{{--                        <div class="mb-6">--}}
{{--                            <label for="list_ids" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Lists</label>--}}
{{--                            <select id="list_ids" name="list_ids" class="@error('list_ids') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                                @forelse($contactList as $list)--}}
{{--                                    <option value="{{ $list->sendgrid_id }}" {{ $list->sendgrid_id === $single_send->list_ids ? 'selected' : '' }}>{{ $list->name }}</option>--}}
{{--                                @empty--}}
{{--                                    <option>There don't have any list</option>--}}
{{--                                @endforelse--}}
{{--                            </select>--}}
{{--                            @error('list_ids')--}}
{{--                            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <div class="mb-6">
                            <label for="suppression_group_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Suppression Group Id</label>
                            <select id="suppression_group_id" name="suppression_group_id" class="@error('suppression_group_id') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @forelse($suppression_group_id as $suppression)
                                    <option value="{{ $suppression->sendgrid_id }}" {{ $suppression->sendgrid_id === $single_send->suppression_group_id ? 'selected' : '' }}>{{ $suppression->name }}</option>
                                @empty
                                    <option>There don't have any suppression group</option>
                                @endforelse
                            </select>
                            @error('suppression_group_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="sender_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Sender Id</label>
                            <select id="sender_id" name="sender_id" class="@error('sender_id') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @forelse($sender as $sender)
                                    <option value="{{ $sender->sendgrid_id }}" {{ $sender->sendgrid_id === $single_send->sender_id ? 'selected' : '' }}>{{ $sender->nickname }}</option>
                                @empty
                                    <option>There don't have any sender</option>
                                @endforelse
                            </select>
                            @error('sender_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                            <input name="name" type="text" id="name" value="{{ old('name') ?? $single_send->name }}" class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter single send name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                            <input name="subject" type="text" id="subject" value="{{ old('subject') ?? $single_send->subject }}" class="@error('subject') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter subject">
                            @error('subject')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="email_template" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Email Template</label>
                            <textarea id="email_template" name="email_template" rows="25" class="@error('email_template') is-invalid @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter HTML template">{{ old('email_template') ?? $single_send->html_content }}</textarea>
                            @error('email_template')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
