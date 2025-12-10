@props(['status'])

@php
    $styles = [
        'accepted' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
    ];

    $labels = [
        'accepted' => 'Accepted',
        'rejected' => 'Declined',
        'pending' => 'Pending'
    ];

    $style = $styles[$status] ?? 'bg-gray-100 text-gray-800';
    $label = $labels[$status] ?? ucfirst($status);
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $style }}">
    {{ $label }}
</span>
