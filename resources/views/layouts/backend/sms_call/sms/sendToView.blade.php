<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Single Send') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.sms_group.store',$sms->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                            <input name="name" type="text" id="name" value="{{ old('name') ?? $sms->name }}" class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="lists" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Lists</label>
                            <select
                                id="select-role"
                                name="lists[]"
                                placeholder="Select List..."
                                autocomplete="off"
                                class="block w-full rounded-sm cursor-pointer focus:outline-none"
                                multiple>
                                @forelse($lists as $list)
                                    <option value="{{ $list->id }}" @foreach($sms->list as $s_s_list) @if($s_s_list->id === $list->id ) selected @endif @endforeach >{{ $list->name }}</option>
                                @empty
                                    <option>There don't have any list</option>
                                @endforelse
                                @error('lists')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
