<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schedule New Cleaning
            </h2>
            <a href="{{ route('cleanings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('cleanings.store') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    <!-- Accommodation Selection -->
                    <div class="mb-6">
                        <label for="accommodation_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Accommodation <span class="text-red-500">*</span>
                        </label>
                        <select name="accommodation_id" id="accommodation_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('accommodation_id') border-red-500 @enderror">
                            <option value="">Select an accommodation</option>
                            @foreach($accommodations as $accommodation)
                                <option value="{{ $accommodation->id }}" {{ old('accommodation_id') == $accommodation->id ? 'selected' : '' }}>
                                    {{ $accommodation->name }}
                                    @if($accommodation->company)
                                        - {{ $accommodation->company->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('accommodation_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date and Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="scheduled_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('scheduled_date') border-red-500 @enderror">
                            @error('scheduled_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="scheduled_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Time <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="scheduled_time" id="scheduled_time" value="{{ old('scheduled_time') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('scheduled_time') border-red-500 @enderror">
                            @error('scheduled_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Assign Cleaners -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Assign Cleaners
                        </label>
                        <p class="text-xs text-gray-500 mb-3">Select one or more cleaners. The first selected will be the primary cleaner.</p>

                        <div class="space-y-2 max-h-64 overflow-y-auto border border-gray-200 rounded-md p-3">
                            @forelse($cleaners as $cleaner)
                                <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                    <input type="checkbox" name="cleaners[]" value="{{ $cleaner->id }}" {{ in_array($cleaner->id, old('cleaners', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700">
                                        {{ $cleaner->full_name }}
                                        @if($cleaner->phone)
                                            <span class="text-gray-500">- {{ $cleaner->phone }}</span>
                                        @endif
                                    </span>
                                </label>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">No active cleaners available</p>
                            @endforelse
                        </div>
                        @error('cleaners')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('notes') border-red-500 @enderror" placeholder="Add any special instructions or notes...">{{ old('notes') }}</textarea>
                        @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('cleanings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Schedule Cleaning
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
