@extends('frontend.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-[25%]">
            @include('frontend.profile.sidebar')
        </div>
        <div class="w-full md:w-[70%]">
            <div class="w-full bg-white p-6 rounded-xl">
                <h2 class="text-lg font-semibold mb-5">Notifications</h2>
                <div
                    class="h-[65vh] overflow-y-auto space-y-4 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    @if ($notifications->count() > 0)
                    @foreach ($notifications as $item)
                    @php
                    $text = strtolower($item->title . ' ' . $item->description);
                    if (str_contains($text, 'delivered')) {
                    $icon = 'success.png';
                    $iconClass = 'w-10 h-10';
                    } elseif (
                    str_contains($text, 'shipped') ||
                    str_contains($text, 'out for delivery')
                    ) {
                    $icon = 'orderout.png';
                    $iconClass = 'w-7 h-7';
                    } elseif (str_contains($text, 'confirmed') || str_contains($text, 'created')) {
                    $icon = 'confirmed.png';
                    $iconClass = 'w-7 h-7';
                    } elseif (str_contains($text, 'returned')) {
                    $icon = 'returned.png';
                    $iconClass = 'w-7 h-7';
                    } elseif (str_contains($text, 'rejected') || str_contains($text, 'cancelled')) {
                    $icon = 'rejected.png';
                    $iconClass = 'w-7 h-7';
                    } else {
                    $icon = 'pending.png';
                    $iconClass = 'w-7 h-7';
                    }
                    $isUnread = $item->status == 0;
                    @endphp
                    <div class="flex items-center gap-4 border rounded-xl p-4 {{ $isUnread ? 'bg-gray-50' : '' }}">
                        <!-- ICON -->
                        <div class="relative flex">
                            <img src="{{ asset('assets/images/notificationsicon/' . $icon) }}"
                                class="{{ $iconClass }}">
                        </div>
                        <!-- Content -->
                        <div class="flex-1">
                            <h3 class="font-medium">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->description }}</p>
                            <span class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <!-- Dot (unread indicator) -->
                        @if ($isUnread)
                        <span class="w-2 h-2 bg-black rounded-full mt-2"></span>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <div class="flex flex-col items-center justify-center text-center mt-[40px]">
                        <img src="{{ asset('assets/images/notificationbg.png') }}" alt="No Notifications"
                            class="w-[200px] sm:w-[300px] mb-6 object-contain">
                        <p class="text-gray-500 mt-2">You have no notifications yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection