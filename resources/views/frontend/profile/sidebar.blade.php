<div class="w-full max-w-xs bg-white rounded-2xl shadow p-5">
    <!-- Profile Section -->
    <div class="flex items-center gap-3 mb-6">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=000000&color=ffffff"
            class="w-12 h-12 rounded-full object-cover" alt="user">
        <div>
            <h3 class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'Guest' }}</h3>
            <p class="text-sm text-gray-400">{{ auth()->user()->email ?? '' }}</p>
        </div>
    </div>
    <!-- Menu -->
    <ul class="space-y-2">
        <li>
            <a href="{{ route('profile') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-full
                {{ request()->routeIs('profile') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-solid fa-user w-5 h-5"></i>
                Profile
            </a>
        </li>
        <!-- Orders -->
        <li class="relative">
            @if ($userpendingOrderCount > 0)
                <span
                    class="absolute right-4 top-1/2 -translate-y-1/2
                           bg-red-600 text-white text-xs font-bold
                           px-2 py-0.5 rounded-full">
                    {{ $userpendingOrderCount }}
                </span>
            @endif
            <a href="{{ route('profile.orders') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-full
                {{ request()->routeIs('profile.orders') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Orders & Activity
            </a>
        </li>
        <!-- Address -->
        <li>
            <a href="{{ route('profile.manage-address') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-full
                {{ request()->routeIs('profile.manage-address') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-solid fa-map-location-dot"></i>
                Manage Address
            </a>
        </li>
        <!-- Notifications -->
        <li class="relative">
            @if ($userpendingNotificationCount > 0)
                <span
                    class="absolute right-4 top-1/2 -translate-y-1/2
                           bg-red-600 text-white text-xs font-bold
                           px-2 py-0.5 rounded-full">
                    {{ $userpendingNotificationCount }}
                </span>
            @endif
            <a href="{{ route('notification_list') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-full
                {{ request()->routeIs('notification_list') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-regular fa-bell"></i>
                Notifications
            </a>
        </li>
        <!-- Support -->
        <li class="relative">
            @if ($userpendingTicketCount > 0)
                <span
                    class="absolute right-4 top-1/2 -translate-y-1/2
                           bg-red-600 text-white text-xs font-bold
                           px-2 py-0.5 rounded-full">
                    {{ $userpendingTicketCount }}
                </span>
            @endif
            <a href="{{ route('support_help_lists') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-full
                {{ request()->routeIs('support_help_lists') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-solid fa-headset text-lg"></i>
                Support & Help
            </a>
        </li>
        <!-- Logout -->
        <li>
            <form action="{{ route('web_user_logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-full text-red-500 hover:bg-red-50">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
