@props(['cleanings'])

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accommodation</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">My Response</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($cleanings as $cleaning)
            @php
                $assignment = $cleaning->cleaningAssignments->firstWhere('user_id', Auth::id());
            @endphp

            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $cleaning->scheduled_date->format('M d, Y') }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $cleaning->scheduled_time }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $cleaning->accommodation->name }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $cleaning->accommodation->address }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-cleaner.status-badge :status="$cleaning->status" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @if($cleaning->accommodation->cleaning_time_estimate)
                        {{ $cleaning->accommodation->cleaning_time_estimate }}h
                    @else
                        <span class="text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($assignment)
                        <x-cleaner.response-badge :status="$assignment->response_status" />
                        {{-- CORREÇÃO: Use o novo método que retorna um booleano --}}
                        @if($assignment->hasPendingRescheduleRequest())
                            <div class="text-xs text-gray-500 mt-1">
                                Reschedule requested
                            </div>
                        @endif
                    @else
                        <span class="text-sm text-gray-400">Not assigned</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @if($assignment)
                        <x-cleaner.action-buttons :cleaning="$cleaning" :assignment="$assignment" />
                    @else
                        <span class="text-gray-400">No actions</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                    <x-cleaner.empty-state />
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
