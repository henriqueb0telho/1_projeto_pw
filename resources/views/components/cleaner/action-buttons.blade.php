@props(['cleaning', 'assignment'])

<div class="flex justify-end space-x-2">
    <!-- View Details -->
    <a href="{{ route('cleanings.show', $cleaning) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>

    <!-- Action Buttons based on assignment status -->
    @if($assignment->isPending())
        <button onclick="openAcceptModal({{ $cleaning->id }})" class="text-green-600 hover:text-green-900 mr-2">Accept</button>
        <button onclick="openDeclineModal({{ $cleaning->id }})" class="text-red-600 hover:text-red-900 mr-2">Decline</button>
        <button onclick="openRescheduleModal({{ $cleaning->id }})" class="text-orange-600 hover:text-orange-900">Reschedule</button>
    @elseif($assignment->isAccepted() && $cleaning->status === 'scheduled')
        <button onclick="openStartModal({{ $cleaning->id }})" class="text-blue-600 hover:text-blue-900">Start</button>
    @elseif($assignment->isAccepted() && $cleaning->status === 'in_progress')
        <button onclick="openCompleteModal({{ $cleaning->id }})" class="text-green-600 hover:text-green-900">Complete</button>
    @else
        <span class="text-gray-400">No actions available</span>
    @endif
</div>
