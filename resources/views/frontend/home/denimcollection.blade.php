<div class="max-w-7xl mx-auto px-6 py-[56px]">
    <div class="flex items-center justify-center gap-3 mb-[3rem]">
        <span class="text-gray-300 text-2xl">✧</span>
        <h2 class="text-[0.80rem] sm:text-[1.20rem] md:text-[1.35rem] font-bold">
            <span class="text-gray-400 font-semibold uppercase tracking-widest">Explore our </span>
            <span class="text-gray-800 font-bold uppercase tracking-widest">Denim Collection</span>
        </h2>
        <span class="text-gray-300 text-2xl">✧</span>
    </div>
    <div class="w-full px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse ($denimBanners as $banner)
                <div class="rounded-[20px] overflow-hidden shadow-md w-full aspect-[4/5] {{ $loop->iteration === 2 ? 'hidden sm:block' : '' }}">
                    <img
                        src="{{ asset('storage/' . $banner) }}"
                        alt="Denim Collection Image {{ $loop->iteration }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            @empty
                <div class="rounded-[20px] overflow-hidden shadow-md w-full aspect-[4/5]">
                    <img
                        src="{{ asset('assets/images/denimcollection/h_im_1.png') }}"
                        alt="Denim Collection Image 1"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="rounded-[20px] overflow-hidden shadow-md w-full aspect-[4/5] hidden sm:block">
                    <img
                        src="{{ asset('assets/images/denimcollection/h_im_2.png') }}"
                        alt="Denim Collection Image 2"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="rounded-[20px] overflow-hidden shadow-md w-full aspect-[4/5]">
                    <img
                        src="{{ asset('assets/images/denimcollection/h_im_3.png') }}"
                        alt="Denim Collection Image 3"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="rounded-[20px] overflow-hidden shadow-md w-full aspect-[4/5]">
                    <img
                        src="{{ asset('assets/images/denimcollection/h_im_4.png') }}"
                        alt="Denim Collection Image 4"
                        class="w-full h-full object-cover"
                    >
                </div>
            @endforelse
        </div>
    </div>
</div>
</div>
