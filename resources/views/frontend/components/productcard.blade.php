@php
    $id = $product['id'] ?? 0;
    $name = $product['name'] ?? '';
    $category = $product['category'] ?? '';
    $catId = $product['category_id'] ?? '';
    $fabric = $product['fabric'] ?? '';
    $priceMin = (int) round($product['priceMin'] ?? 0);
    $priceMax = (int) round($product['priceMax'] ?? 0);
    $oldPrice = (int) round($product['oldPrice'] ?? 0);
    $rating = $product['rating'] ?? 0;
    $discount = $product['discount'] ?? 0;
    $stock = $product['stock'] ?? 'out';
    $image = $product['image'] ?? null;
    $colors = $product['colors'] ?? collect();
    $hasRange = $priceMax > $priceMin;
    $isWishlisted = $product['wishlisted'] ?? false;
    $isBulk = ($product['productType'] ?? '') === 'bulk';
    $perPiecePrice = (int) round($product['perPiecePrice'] ?? 0);
@endphp

<a href="{{ url('/shop/single-product/' . $id) }}"
    class="product-card group relative border border-[#E3E3E3] p-[15px] rounded-[20px] block hover:shadow-lg"
    data-name="{{ $name }}" data-category="{{ $catId }}" data-fabric="{{ strtolower($fabric) }}"
    data-rating="{{ (int) $rating }}" data-discount="{{ $discount }}" data-price="{{ $priceMin }}"
    data-price-min="{{ $priceMin }}" data-price-max="{{ $priceMax }}" data-stock="{{ $stock }}">

    <button type="button" onclick="toggleHeart(event, this)" data-product-id="{{ $product['id'] ?? 0 }}"
        class="absolute top-8 right-8 w-7 h-7 {{ $isWishlisted ? 'bg-red-50' : 'bg-white' }} rounded-full flex items-center justify-center shadow transition z-10">
        <i class="fa-solid fa-heart {{ $isWishlisted ? 'text-red-500' : 'text-gray-400' }} text-xs"></i>
    </button>

    <div class="overflow-hidden rounded-3xl bg-gray-100 mb-4">
        <img src="{{ $image ? asset('storage/' . $image) : asset('assets/images/productcards/productcards.svg') }}"
            alt="{{ $name }}" class="w-full h-[260px] object-contain">
        {{-- @if ($stock == 'out')
            <span class="absolute top-4 left-5 text-xs px-2 py-1 rounded
         bg-red-600 text-white
        ">
                Sold Out
            </span>
        @else --}}
            <span class="absolute top-4 left-5 text-xs px-2 py-1 rounded bg-black text-white ">{{ $discount }}% OFF</span>
        {{-- @endif --}}
    </div>

    <div class="flex justify-between items-start">
        <div>
            <h3 class="font-medium text-gray-800 text-md truncate w-40">{{ $name }}</h3>

            <div class="flex items-center gap-2 mt-1 flex-wrap">
                @if ($hasRange)
                    {{-- Bulk / variant span --}}
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
                    {{-- Single fixed price --}}
                    <span class="text-lg font-bold">₹{{ number_format($priceMin, 0) }}</span>
                    @if ($oldPrice > $priceMin)
                        <span class="text-gray-400 line-through text-sm">₹{{ number_format($oldPrice, 0) }}</span>
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

        <div class="flex flex-col items-end gap-2">
            <div class="flex items-center bg-gray-50 px-2 py-1 rounded-lg">
                <span class="text-yellow-400 text-xl mr-1">★</span>
                <span class="text-md font-bold">{{ number_format($product['rating'] ?? 0, 1) }}</span>
                @if (($product['rating_count'] ?? 0) > 0)
                    <span class="text-xs text-gray-400 ml-1">({{ $product['rating_count'] }})</span>
                @endif
            </div>
            @if ($colors->count())
                <div class="flex -space-x-1">
                    @foreach ($colors as $color)
                        <div class="w-4 h-4 rounded-full border border-white"
                            style="background-color: {{ \App\Support\ColorSwatch::css($color) }};" title="{{ $color }}"></div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</a>

<!-- SCRIPT -->
<script>
    function toggleHeart(e, btn) {
        e.stopPropagation(); // prevent redirect
        e.preventDefault(); // prevent link click
        const icon = btn.querySelector("i");
        if (icon.classList.contains("text-red-500")) {
            icon.classList.remove("text-red-500");
            icon.classList.add("text-gray-400");
            btn.classList.remove("bg-red-50");
            btn.classList.add("bg-white");
        } else {
            icon.classList.remove("text-gray-400");
            icon.classList.add("text-red-500");
            btn.classList.remove("bg-white");
            btn.classList.add("bg-red-50");
        }
    }
</script>
