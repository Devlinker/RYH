<footer class="bg-black text-gray-300 border-t border-slate-900 relative">
    {{-- ── Top Subtle Amber Accent Glow Line ── --}}
    <div class="h-[2px] w-full bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-6 py-12 lg:py-14">
        {{-- ── Grid Layout (2 cols on mobile = 2x2 grid, 6 cols on desktop) ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-x-6 gap-y-10 lg:gap-12">

            {{-- ── Brand Column (Centered on mobile, left-aligned on desktop) ── --}}
            <div class="col-span-2 lg:col-span-2 text-center lg:text-left">
                <div class="flex justify-center lg:justify-start items-center gap-2">
                    <img src="{{ asset('assets/images/logo.png') }}" class="h-9 md:h-10 w-auto object-contain brightness-110" alt="Chumpay Logo" />
                </div>
                <p class="mt-4 text-xs sm:text-sm text-gray-400 max-w-sm mx-auto lg:mx-0 leading-relaxed">
                    Premium men's fashion from Tiruppur's finest textile mills.
                    Factory-to-customer quality you can trust.
                </p>

                {{-- Social Icons --}}
                <div class="flex justify-center lg:justify-start gap-3 mt-6">
                    <a href="#" aria-label="YouTube"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-amber-500 hover:text-black transition-all duration-200">
                        <i class="fa-brands fa-youtube text-sm"></i>
                    </a>
                    <a href="#" aria-label="Facebook"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-amber-500 hover:text-black transition-all duration-200">
                        <i class="fa-brands fa-facebook text-sm"></i>
                    </a>
                    <a href="#" aria-label="Instagram"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-amber-500 hover:text-black transition-all duration-200">
                        <i class="fa-brands fa-instagram text-sm"></i>
                    </a>
                    <a href="#" aria-label="LinkedIn"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-amber-500 hover:text-black transition-all duration-200">
                        <i class="fa-brands fa-linkedin text-sm"></i>
                    </a>
                    <a href="#" aria-label="Twitter"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-amber-500 hover:text-black transition-all duration-200">
                        <i class="fa-brands fa-x-twitter text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- ── 1. Shop Column (Row 1 Left on mobile) ── --}}
            <div class="col-span-1">
                <h3 class="text-white font-semibold mb-4 text-base md:text-lg">
                    Shop
                </h3>
                <ul class="space-y-2 text-xs sm:text-sm text-gray-400">
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Shirts
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            T-Shirts
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Pants
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Trousers
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Innerwear
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Fabrics
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ── 2. Help Column (Row 1 Right on mobile) ── --}}
            <div class="col-span-1">
                <h3 class="text-white font-semibold mb-4 text-base md:text-lg">
                    Help
                </h3>
                <ul class="space-y-2 text-xs sm:text-sm text-gray-400">
                    <li>
                        <a href="/about-us" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Fabric Guide
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Size Guide
                        </a>
                    </li>
                    <li>
                        <a href="/profile/support-help" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Contact & Support
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Shipping & Delivery
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-amber-400 transition relative inline-block after:absolute after:left-0 after:-bottom-0.5 after:w-0 after:h-[1px] after:bg-amber-500 hover:after:w-full after:transition-all">
                            Returns & Exchange
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ── 3. Contact Column (Row 2 Left on mobile) ── --}}
            <div class="col-span-1">
                <h3 class="text-white font-semibold mb-4 text-base md:text-lg">
                    Contact
                </h3>
                <ul class="space-y-3.5 text-xs sm:text-sm text-gray-400">
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot mt-1 text-white flex-shrink-0 text-xs"></i>
                        <span class="leading-relaxed">Textile Complex, Tiruppur Tamil Nadu 641601</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-white flex-shrink-0 text-xs"></i>
                        <a href="tel:+917449078888" class="hover:text-amber-400 transition whitespace-nowrap">+91 74490 78888</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-white flex-shrink-0 text-xs"></i>
                        <a href="mailto:support@chumpay.com" class="hover:text-amber-400 transition truncate">support@chumpay.com</a>
                    </li>
                </ul>
            </div>

            {{-- ── 4. Available in Column (Row 2 Right on mobile) ── --}}
            <div class="col-span-1">
                <h3 class="text-white font-semibold mb-4 text-base md:text-lg">
                    Available in
                </h3>
                <div class="space-y-3">
                    <a href="#" class="inline-block hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('assets/images/footerimages/footerplaystorelogo.png') }}"
                            class="h-9 sm:h-10 w-auto rounded-lg border border-white/10 hover:border-amber-500/50 shadow-sm" alt="Get it on Google Play" />
                    </a>
                    <a href="#" class="inline-block hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('assets/images/footerimages/footerapplelogo.png') }}"
                            class="h-9 sm:h-10 w-auto rounded-lg border border-white/10 hover:border-amber-500/50 shadow-sm" alt="Download on App Store" />
                    </a>
                </div>
            </div>

        </div>

        {{-- ── Giant Watermark Brand Text ── --}}
        <div class="text-center mt-12 sm:mt-16 mb-6 select-none pointer-events-none">
            <span class="text-5xl sm:text-7xl lg:text-8xl font-extrabold tracking-tight text-white/[0.05] inline-block">
                Chumpay
            </span>
        </div>

        {{-- ── Bottom Copyright Strip ── --}}
        <div class="border-t border-gray-800/80 pt-6 text-center text-xs text-gray-500 leading-relaxed max-w-2xl mx-auto">
            © {{ date('Y') }} Chumpay. All rights reserved. Crafted with care for a greener tomorrow.
        </div>
    </div>
</footer>