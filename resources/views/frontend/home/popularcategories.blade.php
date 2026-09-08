        <section>
            <div class="max-w-7xl mx-auto px-6 ">
                <div class="text-center mb-10">
                    <div class="flex items-center justify-center gap-3 my-8">
                        <span class="text-gray-300 text-2xl">✧</span>
                        <h2 class="text-[0.80rem] sm:text-[1.20rem] md:text-[1.35rem] font-bold">
                            <span class="text-gray-400 font-semibold">Popular</span>
                            <span class="text-gray-800 font-bold"> Categories</span>
                        </h2>
                        <span class="text-gray-300 text-2xl">✧</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-y-8 gap-x-4 px-4 py-8 lg:gap-6">

                        @foreach ($categories as $index => $category)
                        <a href="{{ route('shop') }}" class="w-1/2 sm:w-1/4 lg:w-[14.2857%]">
                            <div class="group flex flex-col items-center cursor-pointer">
                                <div
                                    class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full bg-[#F3F4F6] p-4 transition-all duration-300 group-hover:bg-blue-50 group-hover:shadow-md sm:h-28 sm:w-28 lg:h-32 lg:w-32">
                                    <img src="{{ $category['image'] ? asset('storage/' . $category['image']) : '' }}"
                                        alt="{{ $category['name'] }}"
                                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-110" />
                                </div>
                                <span
                                    class="mt-4 text-sm font-semibold text-gray-700 transition-colors group-hover:text-blue-600">
                                    {{ $category['name'] }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-14 px-[20px]">
                        <div class="rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/images/popularcategoriesimages/h_l1.png') }}"
                                class="w-full h-auto object-cover" alt="T-shirt Banner" />
                        </div>
                        <div class="rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/images/popularcategoriesimages/h_r1.png') }}"
                                class="w-full h-auto object-contain" alt="T-shirt Banner" />
                        </div>
                    </div>
                </div>
        </section>
