@props(['status' => 'pending'])

@php
    $classes = match($status) {
        'completed', 'success' => 'bg-green-100 text-green-800 border-green-300',
        'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
        'failed', 'cancelled' => 'bg-red-100 text-red-800 border-red-300',
        default => 'bg-yellow-100 text-yellow-800 border-yellow-300',
    };
@endphp

<span class="px-2,5 py-0,5 text-xs font-semibold rounded-full border {{ $classes }}">
    {{ ucfirst($status) }}
</span>