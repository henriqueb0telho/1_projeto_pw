<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accommodations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <!-- Grid of Accommodations -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($accommodations as $accommodation)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                <!-- Card Header -->
                                <div class="p-5 border-b border-gray-200">
                                    <div class="flex items-start justify-between">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate flex-1">
                                            {{ $accommodation->name }}
                                        </h3>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </div>
                                    @if($accommodation->company)
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $accommodation->company->name }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 space-y-3">
                                    <!-- Description -->
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $accommodation->description ?? 'No description available' }}
                                    </p>

                                    <!-- Address -->
                                    <div class="flex items-start text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="line-clamp-2">{{ $accommodation->address }}</span>
                                    </div>

                                    <!-- Stats -->
                                    <div class="grid grid-cols-3 gap-2 pt-3 border-t border-gray-100">
                                        <div class="text-center">
                                            <svg class="w-5 h-5 mx-auto text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <p class="text-xs text-gray-500">Guests</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $accommodation->max_guests }}</p>
                                        </div>
                                        <div class="text-center">
                                            <svg class="w-5 h-5 mx-auto text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                            <p class="text-xs text-gray-500">Bedrooms</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $accommodation->bedrooms }}</p>
                                        </div>
                                        <div class="text-center">
                                            <svg class="w-5 h-5 mx-auto text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            <p class="text-xs text-gray-500">Bathrooms</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $accommodation->bathrooms }}</p>
                                        </div>
                                    </div>

                                    <!-- Upcoming Cleanings -->
                                    @if($accommodation->upcomingCleanings->count() > 0)
                                        <div class="pt-3 border-t border-gray-100">
                                            <p class="text-xs text-gray-500 mb-1">Next Cleaning</p>
                                            <p class="text-sm font-medium text-indigo-600">
                                                {{ $accommodation->upcomingCleanings->first()->scheduled_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Card Footer -->
                                <div class="px-5 py-3 bg-gray-50 border-t border-gray-200">
                                    <a href="{{ route('accommodations.show', $accommodation) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center justify-between group">
                                        <span>View Details</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No accommodations</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new accommodation.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($accommodations->hasPages())
                        <div class="mt-6">
                            {{ $accommodations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
