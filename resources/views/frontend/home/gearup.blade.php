<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Heading -->
        <div class="flex items-center justify-center gap-3 mb-8">
            <span class="text-gray-300 text-2xl">✧</span>
            <h2 class="text-[0.80rem] sm:text-[1.20rem] md:text-[1.30rem] font-bold">
                <span class="text-gray-400 font-semibold uppercase tracking-widest">Gear up for</span>
                <span class="text-gray-800 font-bold uppercase tracking-widest">Clothing</span>
            </h2>
            <span class="text-gray-300 text-2xl">✧</span>
        </div>

        <div class="w-full px-6 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse ($products as $product)
                        @php
                            $priceMin = (int) round($product['priceMin'] ?? ($product['price'] ?? 0));
                            $priceMax = (int) round($product['priceMax'] ?? $priceMin);
                            $oldPrice = (int) round($product['oldPrice'] ?? 0);
                            $colors = $product['colors'] ?? collect();
                            $hasRange = $priceMax > $priceMin;
                            $isWishlisted = $product['wishlisted'] ?? false;
                            $isBulk = ($product['productType'] ?? '') === 'bulk';
                            $perPiecePrice = (int) round($product['perPiecePrice'] ?? 0);
                        @endphp

                        <a href="{{ url('/shop/single-product/' . ($product['id'] ?? 0)) }}"
                            class="group relative border border-[#E3E3E3] p-[15px] rounded-[20px] block hover:shadow-lg">

                            <!-- Wishlist Button -->
                            <button type="button" onclick="toggleHeart(event, this)"
                                data-product-id="{{ $product['id'] ?? 0 }}"
                                class="absolute top-8 right-8 w-7 h-7 {{ $isWishlisted ? 'bg-red-50' : 'bg-white' }} rounded-full flex items-center justify-center shadow transition z-10">
                                <i
                                    class="fa-solid fa-heart {{ $isWishlisted ? 'text-red-500' : 'text-gray-400' }} text-xs"></i>
                            </button>

                            <!-- Image -->
                            <div class="overflow-hidden max-h-100% rounded-3xl bg-gray-100 mb-4">
                                <img src="{{ $product['image'] ?? null ? asset('storage/' . $product['image']) : asset('assets/images/gearupimages/gearupcards.svg') }}"
                                    alt="{{ $product['name'] ?? '' }}" class="w-full h-[260px] object-contain">
                            </div>

                            <!-- Content -->
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium text-gray-800 text-md truncate w-40">
                                        {{ $product['name'] ?? '' }}
                                    </h3>

                                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                                        @if ($hasRange)
                                            <span class="text-lg font-bold">
                                                ₹{{ number_format($priceMin, 0) }} – ₹{{ number_format($priceMax, 0) }}
                                            </span>
                                            @if ($isBulk && $perPiecePrice > 0)
                                                <span class="w-full flex items-center gap-2 flex-wrap">
                                                    <span class="text-xs px-2 py-1 rounded bg-blue-600 text-white">Bulk</span>
                                                    <span class="text-xs text-gray-500">₹{{ number_format($perPiecePrice, 0) }} / Per Piece</span>
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-lg font-bold">₹{{ number_format($priceMin, 0) }}</span>
                                            @if ($oldPrice > $priceMin)
                                                <span class="text-gray-400 line-through text-sm">
                                                    ₹{{ number_format($oldPrice, 0) }}
                                                </span>
                                            @endif
                                            @if ($isBulk && $perPiecePrice > 0)
                                                <span class="w-full flex items-center gap-2 flex-wrap">
                                                    <span class="text-xs px-2 py-1 rounded bg-blue-600 text-white">Bulk</span>
                                                    <span class="text-xs text-gray-500">₹{{ number_format($perPiecePrice, 0) }} / Per Piece</span>
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <!-- Right -->
                                <div class="flex flex-col items-end gap-2">
                                    <!-- Rating -->
                                    <div class="flex items-center bg-gray-50 px-2 py-1 rounded-lg">
                                        <span class="text-yellow-400 text-xl mr-1">★</span>
                                        <span
                                            class="text-md font-bold">{{ number_format($product['rating'] ?? 0, 1) }}</span>
                                        @if (($product['rating_count'] ?? 0) > 0)
                                            <span
                                                class="text-xs text-gray-400 ml-1">({{ $product['rating_count'] }})</span>
                                        @endif
                                    </div>
                                    <!-- Colors (dynamic) -->
                                    @if ($colors->count())
                                        <div class="flex -space-x-1">
                                            @foreach ($colors as $color)
                                                <div class="w-4 h-4 rounded-full border border-white"
                                                    style="background-color: {{ \App\Support\ColorSwatch::css($color) }};"
                                                    title="{{ $color }}"></div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="col-span-full text-center text-gray-500">No products found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="text-center mt-8 sm:mt-10 lg:mt-12">
            <a href="/shop"
                class="inline-block px-6 sm:px-8 lg:px-10
                py-2 sm:py-3
                text-xs sm:text-sm lg:text-base
                border-2 border-black
                rounded-full
                font-bold
                hover:bg-black hover:text-white
                transition-all duration-300">
                VIEW ALL
            </a>
        </div>
    </div>
</section>

<script>
    function toggleHeart(e, btn) {
        e.preventDefault();
        e.stopPropagation();
        const icon = btn.querySelector("i");
        if (icon.classList.contains("text-red-500")) {
            icon.classList.replace("text-red-500", "text-gray-400");
            btn.classList.replace("bg-red-50", "bg-white");
        } else {
            icon.classList.replace("text-gray-400", "text-red-500");
            btn.classList.replace("bg-white", "bg-red-50");
        }
    }
</script>
