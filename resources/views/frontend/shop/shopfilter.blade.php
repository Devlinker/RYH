<div class="text-[18px] pb-[25px] mb-[10px] font-semibold border-b border-[#ccc]">
    <h2>Filters Options</h2>
</div>
<!-- MOBILE FILTER HEADER -->
<div class="md:hidden flex justify-between items-center mb-4 p-4 border-b">
    <h2 class="text-lg font-bold">Filters</h2>
    <button id="closeFilter" class="text-2xl">✕</button>
</div>
<div class="space-y-6 h-[75vh] ml-[40px] md:ml-0 overflow-y-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

    <div>
        <h3 class="font-semibold mb-3">Categories</h3>
        @forelse($categories as $category)
            <label class="block">
                <input type="checkbox" class="filter-category" value="{{ $category->get_category->id }}">
                {{ $category->get_category->name }}
            </label>
        @empty
            <p class="text-sm text-gray-400">No categories</p>
        @endforelse
    </div>

    <!-- FABRIC (dynamic) -->
    @if (isset($fabrics) && $fabrics->count())
        <div>
            <h3 class="font-semibold mb-3">Fabric</h3>
            @foreach ($fabrics as $fabric)
                <label class="block">
                    <input type="checkbox" class="filter-fabric" value="{{ strtolower($fabric) }}">
                    {{ $fabric }}
                </label>
            @endforeach
        </div>
    @endif

    <!-- PRICE -->
    <div class="w-[120px]">
        <h3 class="font-semibold mb-8">Price</h3>

        <div class="relative h-10">
            <div class="absolute top-1/2 -translate-y-1/2 w-full h-1 bg-gray-300 rounded"></div>
            <div id="rangeTrack" class="absolute top-1/2 -translate-y-1/2 h-1 bg-black rounded"></div>

            <input type="range" id="minRange" min="{{ $priceMin ?? 100 }}" max="{{ $priceMax ?? 5000 }}"
                value="{{ $priceMin ?? 100 }}"
                class="absolute w-full appearance-none bg-transparent pointer-events-none">

            <input type="range" id="maxRange" min="{{ $priceMin ?? 100 }}" max="{{ $priceMax ?? 5000 }}"
                value="{{ $priceMax ?? 5000 }}"
                class="absolute w-full appearance-none bg-transparent pointer-events-none">

            <div id="minTooltip" class="absolute -top-8 text-xs bg-black text-white px-2 py-1 rounded">
                ₹{{ $priceMin ?? 100 }}
            </div>
            <div id="maxTooltip" class="absolute -top-8 text-xs bg-black text-white px-2 py-1 rounded">
                ₹{{ $priceMax ?? 5000 }}
            </div>
        </div>

        <div class="flex justify-between text-sm mt-4">
            <span id="minPrice">₹{{ $priceMin ?? 100 }}</span>
            <span id="maxPrice">₹{{ $priceMax ?? 5000 }}</span>
        </div>
    </div>

    <!-- AVAILABILITY -->
    {{-- <div>
        <h3 class="font-semibold mb-3">Availability</h3>
        <label class="block">
            <input type="checkbox" class="filter-stock" value="in"> In Stock
        </label>
        <label class="block">
            <input type="checkbox" class="filter-stock" value="out"> Out of Stock
        </label>
    </div> --}}

    <!-- REVIEWS -->
    <div>
        <h3 class="font-semibold mb-3">Reviews</h3>
        <label class="block">
            <input type="checkbox" class="filter-rating" value="5">
            <span class="text-yellow-400">★★★★★</span>
        </label>
        <label class="block">
            <input type="checkbox" class="filter-rating" value="4">
            <span class="text-yellow-400">★★★★</span>☆
        </label>
        <label class="block">
            <input type="checkbox" class="filter-rating" value="3">
            <span class="text-yellow-400">★★★</span>☆☆
        </label>
        <label class="block">
            <input type="checkbox" class="filter-rating" value="2">
            <span class="text-yellow-400">★★</span>☆☆☆
        </label>
        <label class="block">
            <input type="checkbox" class="filter-rating" value="1">
            <span class="text-yellow-400">★</span>☆☆☆☆
        </label>
    </div>

<!-- DISCOUNTS (range brackets) -->
@if(isset($discountTiers) && $discountTiers->count())
<div>
    <h3 class="font-semibold mb-3">Available Discounts</h3>
    @foreach($discountTiers as $tier)
        <label class="block">
            <input type="checkbox" class="filter-discount"
                   value="{{ $tier['min'] }}-{{ $tier['max'] }}">
            {{ $tier['label'] }} Off
        </label>
    @endforeach
</div>
@endif

</div>

<style>
    input[type=range]::-webkit-slider-thumb {
        appearance: none;
        height: 14px;
        width: 14px;
        background: black;
        border-radius: 50%;
        cursor: pointer;
        pointer-events: auto;
    }

    input[type=range] {
        pointer-events: none;
    }
</style>

<script>
    (function() {
        const minRange = document.getElementById("minRange");
        const maxRange = document.getElementById("maxRange");
        const minPriceLbl = document.getElementById("minPrice");
        const maxPriceLbl = document.getElementById("maxPrice");
        const minTooltip = document.getElementById("minTooltip");
        const maxTooltip = document.getElementById("maxTooltip");
        const rangeTrack = document.getElementById("rangeTrack");

        if (!minRange || !maxRange) return;

        const min = parseInt(minRange.min);
        const max = parseInt(maxRange.max);
        const gap = 50;

        function updateSlider() {
            let minVal = parseInt(minRange.value);
            let maxVal = parseInt(maxRange.value);

            if (minVal > maxVal - gap) {
                minVal = maxVal - gap;
                minRange.value = minVal;
            }
            if (maxVal < minVal + gap) {
                maxVal = minVal + gap;
                maxRange.value = maxVal;
            }

            const percent1 = ((minVal - min) / (max - min)) * 100;
            const percent2 = ((maxVal - min) / (max - min)) * 100;

            rangeTrack.style.left = percent1 + "%";
            rangeTrack.style.width = (percent2 - percent1) + "%";

            minTooltip.style.left = percent1 + "%";
            maxTooltip.style.left = percent2 + "%";

            minTooltip.innerHTML = "₹" + minVal;
            maxTooltip.innerHTML = "₹" + maxVal;
            minPriceLbl.innerHTML = "₹" + minVal;
            maxPriceLbl.innerHTML = "₹" + maxVal;
        }

        minRange.addEventListener("input", updateSlider);
        maxRange.addEventListener("input", updateSlider);
        updateSlider();
    })();
</script>
