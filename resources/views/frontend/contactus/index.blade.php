@extends('frontend.app')

@section('content')
    <section class="w-full">

        <!-- Top Banner -->
        <!-- Desktop Banner -->
        <div class="relative hidden md:block w-full overflow-hidden">
            <img src="{{ asset('assets/images/contact-banner.png') }}" alt="Desktop Banner"
                class="w-full h-[260px] object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <h1 class="text-white text-3xl md:text-5xl font-semibold">
                    Contact us
                </h1>
            </div>
        </div>

        <!-- Mobile Banner -->
        <div class="relative block md:hidden w-full overflow-hidden">
            <img src="{{ asset('assets/images/contact-banner-mobile.png') }}" alt="Mobile Banner"
                class="w-full h-[220px] object-cover">
        </div>

        <!-- Main Section -->
        <div class="bg-[#f5f5f5] py-[8%] px-[5%]">

            <div class="max-w-[1200px] mx-auto">

                <!-- FLEX CONTAINER -->
                <div class="flex flex-col lg:flex-row gap-[5%]">

                    <!-- LEFT SIDE (65%) -->
                    <div class="w-full lg:w-[60%]">
                        <p class="text-[#9b9b9b] text-sm mb-3">Connect With Chumpay</p>
                        <h2 class="text-black text-2xl md:text-[2.2rem] leading-snug font-medium mb-8">
                            Let’s Build Something Great Together
                        </h2>

                        <form class="flex flex-col gap-6" action="https://api.web3forms.com/submit" method="POST">
                            <input type="hidden" name="access_key" value="0ce48cf1-588a-4736-b8d4-46c3df61190a">
                            <div class="flex flex-col md:flex-row gap-4">
                                <input type="text" placeholder="Name" name="name"
                                    class="w-full rounded-md bg-[#ececec] px-4 py-3 text-sm outline-none focus:border-black"
                                    required>
                                <input type="text" placeholder="Phone Number" name="phone"
                                    class="w-full rounded-md bg-[#ececec] px-4 py-3 text-sm outline-none focus:border-black">
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <input type="email" placeholder="Email" name="email" required
                                    class="w-full rounded-md bg-[#ececec] px-4 py-3 text-sm outline-none focus:border-black">

                                <input type="text" placeholder="Subject" name="subject"
                                    class="w-full rounded-md bg-[#ececec] px-4 py-3 text-sm outline-none focus:border-black">

                            </div>

                            <textarea rows="6" placeholder="Message" name="message"
                                class="w-full rounded-md bg-[#ececec] px-4 py-3 text-sm outline-none resize-none focus:border-black"></textarea>

                            <button type="submit"
                                class="w-full bg-black text-white py-3 rounded-full text-sm font-medium hover:bg-gray-900 transition mb-[30px]">
                                Submit
                            </button>
                        </form>
                    </div>

                    <!-- RIGHT SIDE (35%) -->
                    <div class="w-full lg:w-[40%] bg-black text-white p-5 sm:p-6 lg:p-10 rounded-[24px] lg:rounded-3xl flex flex-col justify-between gap-8 min-h-full">
                        <div class="space-y-6 sm:space-y-7">
                            <div>
                                <h3 class="text-[15px] sm:text-[16px] font-semibold mb-[6px]">Address</h3>
                                <p
                                    class="text-gray-300 text-[13px] sm:text-[14px] leading-[1.8] w-full sm:w-[80%] lg:w-[65%]">
                                      <i class="fa-solid fa-location-dot mt-1 text-white"></i>
                                    Chumpay Textiles Tiruppur, Tamil Nadu - 641601, India
                                </p>
                            </div>
                            <div>
                                <h3 class="text-[15px] sm:text-[16px] font-semibold mb-[6px]">Email</h3>
                                <p class="text-gray-300 text-[13px] sm:text-[14px] leading-[1.8] break-all sm:break-normal">
                                <i class="fa-solid fa-envelope text-white"></i>
                                    support@chumpay.com
                                </p>
                            </div>
                            <div>
                                <h3 class="text-[15px] sm:text-[16px] font-semibold mb-[6px]">Working Hours</h3>
                                <p class="text-gray-300 text-[13px] sm:text-[14px] leading-[1.8]">
                                   <i class="fa-solid fa-business-time"></i> Mon – Sat: 9:00 AM - 6:00 PM
                                </p>
                            </div>
                            <div>
                                <h3 class="text-[15px] sm:text-[16px] font-semibold mb-[6px]">Mobile Number</h3>
                                <p class="text-gray-300 text-[13px] sm:text-[14px] leading-[1.8]">
                                    <i class="fa-solid fa-phone text-white"></i>
                        +91 74490 78888
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-[15px] sm:text-[16px] font-semibold mb-[10px]">Social Media</h3>
                            <div class="flex items-center flex-wrap gap-3 sm:gap-4">
                                <a href="#"
                                    class="w-9 h-9 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-youtube text-[14px]"></i>
                                </a>
                                <a href="#"
                                    class="w-9 h-9 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-facebook-f text-[14px]"></i>
                                </a>
                                <a href="#"
                                    class="w-9 h-9 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-instagram text-[14px]"></i>
                                </a>
                                <a href="#"
                                    class="w-9 h-9 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-linkedin-in text-[14px]"></i>
                                </a>
                                <a href="#"
                                    class="w-9 h-9 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                                    <i class="fa-brands fa-x-twitter text-[14px]"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
