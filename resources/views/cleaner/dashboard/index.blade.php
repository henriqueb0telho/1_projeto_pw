<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Cleaning Assignments') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            <x-cleaner.alerts />

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Filters -->
                <x-cleaner.filters />

                <!-- Cleanings Table -->
                <x-cleaner.cleanings-table :cleanings="$cleanings" />

                <!-- Pagination -->
                @if($cleanings->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $cleanings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modals -->
    <x-cleaner.modals.accept />
    <x-cleaner.modals.decline />
    <x-cleaner.modals.reschedule />
    <x-cleaner.modals.start />
    <x-cleaner.modals.complete />
</x-app-layout>
