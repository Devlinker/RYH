@php
    use Illuminate\Support\Facades\Auth;
    $status = false;
@endphp

@if (Auth::check())

    <!-- ================= LOGGED IN NAVBAR ================= -->
    <nav class="fixed top-0 left-0 w-full bg-black text-white z-[80]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-16 lg:h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Chumpay Logo"
                        class="h-5 sm:h-6 md:h-8 lg:h-10 w-auto object-contain">
                </div>
                <!-- Desktop Menu /contact-us -->
                <div class="hidden lg:flex space-x-6 xl:space-x-8 text-sm lg:text-base font-medium">
                    <a href="{{ route('home') }}" class="hover:text-pink-500 transition">Home</a>
                    <a href="/shop" class="hover:text-pink-500 transition">Shop</a>
                    <a href="/about-us" class="hover:text-pink-500 transition">About us</a>
                    <a href="/contact-us" class="hover:text-pink-500 transition">Contact Us</a>
                </div>
                <!-- Right Section -->
                <div class="flex items-center gap-[12px] sm:gap-3">
                    <!-- Search -->
                    <form action="{{ route('shop') }}" method="GET" class="relative hidden sm:block"
                        id="navSearchForm">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                            autocomplete="off" id="navSearchInput"
                            class="bg-gray-800 text-xs sm:text-sm w-28 sm:w-40 md:w-52 lg:w-64 rounded-full pl-8 pr-4 py-1.5 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <button type="submit"
                            class="absolute left-3 top-2 text-gray-400 text-xs sm:text-sm bg-transparent border-0 p-0 cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <!-- Profile -->
                    <a href="{{ url('/profile') }}"
                        class="w-8 h-8 flex items-center justify-center bg-gray-800 rounded-full hover:bg-pink-600 transition">
                        <i class="fa-regular fa-user text-xs"></i>
                    </a>
                    <!-- Wishlist -->
                    <a href="{{ route('whishlist') }}"
                        class="w-8 h-8 flex items-center justify-center bg-gray-800 rounded-full hover:bg-pink-600 transition">
                        <i class="fa-regular fa-heart text-xs"></i>
                    </a>
                    <!-- Cart -->
                    <div class="relative">
                        <a href="{{ url('/shop/cart') }}"
                            class="w-8 h-8 flex items-center justify-center bg-gray-800 rounded-full hover:bg-pink-600 transition">
                            <i class="fa-solid fa-cart-shopping text-xs"></i>
                        </a>
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-pink-600 text-[10px] px-1.5 rounded-full leading-none">
                                {{ $cartCount > 99 ? '99+' : $cartCount }}
                            </span>
                        @endif
                    </div>
                    <div class="lg:hidden"> <button id="menu-btn" class="text-white focus:outline-none"> <i
                                class="fa-solid fa-bars text-lg sm:text-xl"></i> </button> </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu /contact-us -->
        <div id="mobile-menu"
            class="hidden lg:hidden bg-black px-4 sm:px-6 pb-4 space-y-3 text-sm sm:text-base font-medium">
            <a href="{{ route('home') }}" class="block hover:text-pink-500">Home</a>
            <a href="/shop" class="block hover:text-pink-500">Shop</a>
            <a href="/about-us" class="block hover:text-pink-500">About us</a>
            <a href="/contact-us" class="block hover:text-pink-500">Contact Us</a>
        </div>
    </nav>
@else
    <!-- ================= GUEST NAVBAR ================= -->
    <nav class="fixed top-0 left-0 w-full bg-black text-white z-[80]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-16 lg:h-20">

                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Chumpay Logo"
                        class="h-5 sm:h-6 md:h-8 lg:h-10 w-auto object-contain">
                </div>

                <!-- Desktop Menu /contact-us -->
                <div class="hidden lg:flex space-x-6 xl:space-x-8 text-sm lg:text-base font-medium">
                    <a href="{{ route('home') }}" class="hover:text-pink-500 transition">Home</a>
                    <a href="/shop" class="hover:text-pink-500 transition">Shop</a>
                    <a href="/about-us" class="hover:text-pink-500 transition">About us</a>
                    <a href="/contact-us" class="hover:text-pink-500 transition">Contact Us</a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-3 sm:space-x-4">

                    <!-- Search -->
                    <form action="{{ route('shop') }}" method="GET" class="relative hidden sm:block"
                        id="navSearchForm">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                            autocomplete="off" id="navSearchInput"
                            class="bg-gray-800 text-xs sm:text-sm w-28 sm:w-40 md:w-52 lg:w-64 rounded-full pl-8 pr-4 py-1.5 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <button type="submit"
                            class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs sm:text-sm bg-transparent border-0 p-0 cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>

                    <!-- Login Button -->
                    <a href="javascript:void(0)" id="LoginBtn"
                        class="bg-white text-black  text-[10px] sm:text-xs md:text-sm font-semibold px-3 sm:px-6 md:px-8 py-1 sm:py-1.5 md:py-2 rounded-full hover:bg-gray-200 transition">Login</a>

                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden">
                        <button id="menu-btn" class="text-white focus:outline-none">
                            <i class="fa-solid fa-bars text-lg sm:text-xl"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Mobile Menu /contact-us -->
        <div id="mobile-menu"
            class="hidden lg:hidden bg-black px-4 sm:px-6 pb-4 space-y-3 text-sm sm:text-base font-medium">
            <a href="{{ route('home') }}" class="block hover:text-pink-500">Home</a>
            <a href="/shop" class="block hover:text-pink-500">Shop</a>
            <a href="/about-us" class="block hover:text-pink-500">About us</a>
            <a href="/contact-us" class="block hover:text-pink-500">Contact Us</a>
        </div>

    </nav>

@endif

<!-- Navbar Spacing -->
<div class="pt-14 sm:pt-16 lg:pt-20"></div>

<!-- ================= LOGIN POPUP ================= -->
@include('frontend.components.loginpopup')

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const btn = document.getElementById("LoginBtn");
        const popup = document.getElementById("LoginPopup");
        const panel = document.getElementById("LoginPanel");
        const closeBtn = document.querySelector(".closeLogin");

        if (btn) {
            btn.addEventListener("click", function() {
                popup.classList.remove("hidden");

                setTimeout(() => {
                    panel.classList.remove("scale-90", "opacity-0");
                    panel.classList.add("scale-100", "opacity-100");
                }, 10);
            });
        }

        function closePopup() {
            panel.classList.remove("scale-100", "opacity-100");
            panel.classList.add("scale-90", "opacity-0");

            setTimeout(() => {
                popup.classList.add("hidden");
            }, 300);
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", closePopup);
        }

        popup.addEventListener("click", function(e) {
            if (!panel.contains(e.target)) {
                closePopup();
            }
        });

    });
</script>
<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
</script>
<script>
    const navSearchForm = document.getElementById('navSearchForm');
    const navSearchInput = document.getElementById('navSearchInput');

    if (navSearchForm && navSearchInput) {
        let searchTimer;
        navSearchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                navSearchForm.submit();
            }, 600);
        });
    }
</script>
