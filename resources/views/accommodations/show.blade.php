<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $accommodation->name }}
            </h2>
            <a href="{{ route('accommodations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Active
                                </span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Description</label>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $accommodation->description ?? 'No description provided' }}
                                    </p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Address
                                    </label>
                                    <p class="mt-1 text-sm text-gray-600">{{ $accommodation->address }}</p>
                                </div>

                                @if($accommodation->company)
                                    <div>
                                        <label class="text-sm font-medium text-gray-700 flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            Company
                                        </label>
                                        <p class="mt-1 text-sm text-gray-600">{{ $accommodation->company->name }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Capacity & Features -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:p-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Capacity & Features</h3>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-8 h-8 mx-auto text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <p class="text-2xl font-bold text-gray-900">{{ $accommodation->max_guests }}</p>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Max Guests</p>
                                </div>

                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-8 h-8 mx-auto text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <p class="text-2xl font-bold text-gray-900">{{ $accommodation->bedrooms }}</p>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Bedrooms</p>
                                </div>

                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-8 h-8 mx-auto text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    <p class="text-2xl font-bold text-gray-900">{{ $accommodation->bathrooms }}</p>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Bathrooms</p>
                                </div>

                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-8 h-8 mx-auto text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-2xl font-bold text-gray-900">{{ $accommodation->cleaning_time_estimate }}</p>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Hours (Est.)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sections -->
                    @if($accommodation->accommodationSections->count() > 0)
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-6 sm:p-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Sections</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($accommodation->accommodationSections as $section)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            {{ $section->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Upcoming Cleanings -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Cleanings</h3>

                            @if($accommodation->upcomingCleanings->count() > 0)
                                <div class="space-y-3">
                                    @foreach($accommodation->upcomingCleanings as $cleaning)
                                        <div class="border-l-4 border-indigo-500 pl-3 py-2">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $cleaning->scheduled_date->format('M d, Y') }}
                                            </p>
                                            @if($cleaning->scheduled_time)
                                                <p class="text-xs text-gray-500">
                                                    {{ $cleaning->scheduled_time }}
                                                </p>
                                            @endif
                                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium
                                                @if($cleaning->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($cleaning->status === 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($cleaning->status === 'completed') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $cleaning->status)) }}
                                            </span>
                                            @if($cleaning->notes)
                                                <p class="text-xs text-gray-500 mt-1">{{ Str::limit($cleaning->notes, 50) }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No upcoming cleanings scheduled</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Cleanings -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Completed Cleanings</h3>

                            @if($accommodation->completedCleanings->count() > 0)
                                <div class="space-y-3">
                                    @foreach($accommodation->completedCleanings as $cleaning)
                                        <div class="border-l-4 border-green-500 pl-3 py-2">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $cleaning->scheduled_date->format('M d, Y') }}
                                            </p>
                                            @if($cleaning->scheduled_time)
                                                <p class="text-xs text-gray-500">
                                                    {{ $cleaning->scheduled_time }}
                                                </p>
                                            @endif
                                            @if($cleaning->actual_duration)
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Duration: {{ $cleaning->actual_duration }} hours
                                                </p>
                                            @endif
                                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No completed cleanings yet</p>
                            @endif
                        </div>
                    </div>

                    <!-- Cleaning Stats -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Cleaning Statistics</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Cleanings</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $accommodation->cleaningSchedules->count() }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Completed</span>
                                    <span class="text-sm font-semibold text-green-600">
                                        {{ $accommodation->completedCleanings->count() }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Upcoming</span>
                                    <span class="text-sm font-semibold text-indigo-600">
                                        {{ $accommodation->upcomingCleanings->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
