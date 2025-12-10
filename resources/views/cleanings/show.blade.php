<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cleaning Details
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('cleanings.edit', $cleaning) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('cleanings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Cleaning Details -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">Cleaning Information</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($cleaning->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($cleaning->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($cleaning->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $cleaning->status)) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Scheduled Date
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 font-medium">
                                        {{ $cleaning->scheduled_date->format('l, F j, Y') }}
                                    </p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Scheduled Time
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 font-medium">{{ $cleaning->scheduled_time }}</p>
                                </div>

                                @if($cleaning->actual_duration)
                                    <div>
                                        <label class="text-sm font-medium text-gray-700 flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Actual Duration
                                        </label>
                                        <p class="mt-1 text-sm text-gray-900 font-medium">{{ $cleaning->actual_duration }} hours</p>
                                    </div>
                                @endif

                                <div>
                                    <label class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Status
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 font-medium">{{ ucfirst(str_replace('_', ' ', $cleaning->status)) }}</p>
                                </div>
                            </div>

                            @if($cleaning->notes)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <label class="text-sm font-medium text-gray-700 flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                        Notes
                                    </label>
                                    <p class="text-sm text-gray-600 bg-gray-50 rounded-lg p-4">{{ $cleaning->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Accommodation Details -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:p-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Accommodation Details</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $cleaning->accommodation->name }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">Address</label>
                                    <p class="mt-1 text-sm text-gray-600">{{ $cleaning->accommodation->address }}</p>
                                </div>

                                @if($cleaning->accommodation->company)
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Company</label>
                                        <p class="mt-1 text-sm text-gray-600">{{ $cleaning->accommodation->company->name }}</p>
                                    </div>
                                @endif

                                <div class="grid grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                                    <div>
                                        <label class="text-xs text-gray-500">Guests</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ $cleaning->accommodation->max_guests }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500">Bedrooms</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ $cleaning->accommodation->bedrooms }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500">Bathrooms</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ $cleaning->accommodation->bathrooms }}</p>
                                    </div>
                                </div>

                                @if($cleaning->accommodation->accommodationSections->count() > 0)
                                    <div class="pt-4 border-t border-gray-100">
                                        <label class="text-sm font-medium text-gray-700 mb-2 block">Sections</label>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($cleaning->accommodation->accommodationSections as $section)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ $section->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('accommodations.show', $cleaning->accommodation) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                                    View Full Accommodation Details
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Assigned Staff -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Assigned Staff</h3>

                            @if($cleaning->users->count() > 0)
                                <div class="space-y-3">
                                    @foreach($cleaning->users as $user)
                                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-600 font-medium text-sm">
                                                        {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $user->full_name }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ ucfirst($user->pivot->role_in_cleaning) }}
                                                </p>
                                                @if($user->phone)
                                                    <p class="text-xs text-gray-500 mt-1">{{ $user->phone }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-6">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No staff assigned yet</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>

                            <div class="space-y-2">
                                <a href="{{ route('cleanings.edit', $cleaning) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Cleaning
                                </a>

                                <form action="{{ route('cleanings.destroy', $cleaning) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cleaning?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete Cleaning
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
