<div class="max-w-7xl mx-auto px-4 md:px-16 py-8">

    <div class="flex flex-col md:flex-row gap-8">

        <div class="md:hidden w-full">
            <button id="openFilter"
                class="w-full border rounded-lg py-3 font-semibold flex justify-center items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 7v5l-4 2v-7L3 6V4z" />
                </svg>
                Filters
            </button>
        </div>

        <!-- LEFT FILTER SECTION -->
        <div id="filterSidebar"
            class="fixed md:static top-0 left-0 h-full md:h-auto w-full md:w-[15%] bg-white z-50 md:z-auto
                    transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto">
            @include('frontend.shop.shopfilter')
        </div>

        <!-- RIGHT PRODUCT SECTION -->
        <div class="w-full md:w-[85%]">

            <!-- Title -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-[20px] gap-4">
                <h3 class="text-md font-semibold">
                    Showing <span id="resultCount">0</span> Results
                </h3>

                <!-- Search Box -->
                <div class="flex items-center bg-gray-100 rounded-full pl-4 shadow-sm w-full md:w-[30%]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                    </svg>
                    <input type="text" id="searchInput" placeholder="Search your Clothing"
                        value="{{ request('search') }}"
                        class="flex-1 bg-transparent outline-none text-gray-600 placeholder-gray-400">
                    <button type="button" id="searchBtn"
                        class="bg-black text-white px-5 py-1.5 rounded-full hover:bg-gray-800">
                        Search
                    </button>
                </div>
            </div>

            <div id="activeFiltersContainer" class="flex items-center flex-wrap gap-2 mt-4 mb-4 hidden">
                <span class="text-gray-500 mr-2">Active Filters</span>
                <div id="activeFilters" class="flex font-medium flex-wrap gap-2"></div>
                <button id="clearAllFilters" class="text-gray-400 underline text-sm ml-3 hover:text-black">
                    Clear All
                </button>
            </div>

            <!-- NO PRODUCTS MESSAGE -->
            <div id="noProductsMessage" class="hidden flex items-center justify-center px-4 py-16">
                <div class="max-w-4xl w-full rounded-2xl p-8 text-center">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('assets/images/searchresult.svg') }}" class="w-full max-w-sm">
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
                            No matching search result
                        </h2>
                        <p class="text-gray-500 mb-1">
                            Try again using more general search terms
                        </p>
                        <button id="clearAllFiltersBtn2"
                            class="inline-block mt-4 bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">
                            Clear All Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- LOADER -->
            <div id="productLoader"
                class="hidden absolute inset-0 bg-gray-200/60 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="w-12 h-12 border-4 border-gray-300 border-t-black rounded-full animate-spin"></div>
            </div>

            <!-- PRODUCT GRID -->
            <div id="productGrid"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 overflow-auto pr-[5px]
                [&::-webkit-scrollbar]:w-[4px] [&::-webkit-scrollbar-thumb]:bg-gray-400
                [&::-webkit-scrollbar-thumb]:rounded-lg">

                @forelse($products as $product)
                    @include('frontend.components.productcard', ['product' => $product])
                @empty
                    <p class="col-span-full text-center text-gray-500">No products found.</p>
                @endforelse

            </div>

            <!-- PAGINATION -->
            <div id="pagination" class="flex justify-center mt-10 gap-2"></div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const products = document.querySelectorAll("#productGrid .product-card");

        const searchInput = document.getElementById("searchInput");
        const searchBtn = document.getElementById("searchBtn");

        const categoryFilters = document.querySelectorAll(".filter-category");
        const fabricFilters = document.querySelectorAll(".filter-fabric");
        const stockFilters = document.querySelectorAll(".filter-stock");
        const discountFilters = document.querySelectorAll(".filter-discount");
        const ratingFilters = document.querySelectorAll(".filter-rating");

        const resultCount = document.getElementById("resultCount");
        const noProductsMessage = document.getElementById("noProductsMessage");
        const productGrid = document.getElementById("productGrid");
        const pagination = document.getElementById("pagination");
        const loader = document.getElementById("productLoader");

        const activeFiltersDiv = document.getElementById("activeFilters");
        const activeFiltersContainer = document.getElementById("activeFiltersContainer");
        const clearAllFilters = document.getElementById("clearAllFilters");
        const clearAllFiltersBtn2 = document.getElementById("clearAllFiltersBtn2");

        const minRange = document.getElementById("minRange");
        const maxRange = document.getElementById("maxRange");

        const itemsPerPage = 9;
        let currentPage = 1;
        let totalPages = 1;

        // Strips currency symbols/commas/spaces, returns a clean float
        function parseNumber(val) {
            if (val === null || val === undefined || val === "") return 0;
            const cleaned = String(val).replace(/[^0-9.-]/g, "");
            const num = parseFloat(cleaned);
            return isNaN(num) ? 0 : num;
        }

        function getCheckedValues(filters) {
            return Array.from(filters)
                .filter(el => el.checked)
                .map(el => el.value.toLowerCase());
        }

        function filterProducts() {
            loader.classList.remove("hidden");

            setTimeout(() => {
                try {
                    const searchValue = searchInput.value.toLowerCase();

                    const selectedCategories = getCheckedValues(categoryFilters);
                    const selectedFabric = getCheckedValues(fabricFilters);
                    const selectedStock = getCheckedValues(stockFilters);
                    const selectedDiscount = getCheckedValues(discountFilters);
                    const selectedRatings = getCheckedValues(ratingFilters);

                    const minPrice = minRange ? parseNumber(minRange.value) : 0;
                    const maxPrice = maxRange ? parseNumber(maxRange.value) : Infinity;

                    let visibleProducts = [];

                    products.forEach(product => {
                        const name = (product.dataset.name || "").toLowerCase();
                        const category = (product.dataset.category || "").toLowerCase();
                        const fabric = product.dataset.fabric || "";
                        const productMin = parseNumber(product.dataset.priceMin);
                        const productMax = parseNumber(product.dataset.priceMax || product
                            .dataset.priceMin);
                        const rating = parseNumber(product.dataset.rating);
                        const discount = parseNumber(product.dataset.discount);
                        const stock = product.dataset.stock || "";

                        let show = true;

                        if (searchValue && !name.includes(searchValue) && !category.includes(
                                searchValue)) {
                            show = false;
                        }
                        if (selectedCategories.length && !selectedCategories.includes(category))
                            show = false;
                        if (selectedFabric.length && !selectedFabric.includes(fabric)) show =
                            false;
                        if (selectedStock.length && !selectedStock.includes(stock)) show =
                        false;

                        if (selectedDiscount.length) {
                            const passesDiscount = selectedDiscount.some(range => {
                                const [lo, hi] = range.split('-').map(Number);
                                return discount >= lo && discount <= hi;
                            });
                            if (!passesDiscount) show = false;
                        }

                        if (selectedRatings.length) {
                            const passesRating = selectedRatings.some(r => Math.floor(
                                rating) === parseInt(r));
                            if (!passesRating) show = false;
                        }

                        // RANGE OVERLAP: product qualifies if its [min,max] intersects the selected [minPrice,maxPrice]
                        if (productMax < minPrice || productMin > maxPrice) show = false;

                        if (show) visibleProducts.push(product);
                        product.style.display = "none";
                    });

                    resultCount.innerText = visibleProducts.length;

                    if (visibleProducts.length === 0) {
                        noProductsMessage.classList.remove("hidden");
                        productGrid.classList.add("hidden");
                        pagination.innerHTML = "";
                    } else {
                        noProductsMessage.classList.add("hidden");
                        productGrid.classList.remove("hidden");
                    }

                    renderPagination(visibleProducts);
                    updateActiveFilters();

                } finally {
                    loader.classList.add("hidden");
                }
            }, 400);
        }

        function updateActiveFilters() {
            activeFiltersDiv.innerHTML = "";

            const allFilters = document.querySelectorAll(
                ".filter-category, .filter-fabric, .filter-stock, .filter-discount, .filter-rating"
            );

            let hasFilters = false;

            allFilters.forEach(filter => {
                if (filter.checked) {
                    hasFilters = true;
                    const chip = document.createElement("div");
                    chip.className =
                        "flex items-center gap-2 bg-black text-white px-3 py-1 rounded-full text-sm";
                    chip.innerHTML =
                        `${filter.parentElement.textContent.trim()} <span class="cursor-pointer">✕</span>`;
                    chip.querySelector("span").addEventListener("click", () => {
                        filter.checked = false;
                        currentPage = 1;
                        filterProducts();
                    });
                    activeFiltersDiv.appendChild(chip);
                }
            });

            activeFiltersContainer.classList.toggle("hidden", !hasFilters);
        }

        function renderPagination(list) {
            pagination.innerHTML = "";

            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            list.forEach((product, index) => {
                product.style.display = (index >= start && index < end) ? "" : "none";
            });

            totalPages = Math.ceil(list.length / itemsPerPage);

            function createButton(i) {
                const btn = document.createElement("button");
                btn.innerText = i;
                btn.className =
                    `px-3 py-1 border rounded ${i === currentPage ? 'bg-black text-white' : 'bg-white'}`;
                btn.addEventListener("click", () => {
                    currentPage = i;
                    renderPagination(list);
                });
                pagination.appendChild(btn);
            }

            function createDots() {
                const dots = document.createElement("span");
                dots.innerText = "...";
                dots.className = "px-2";
                pagination.appendChild(dots);
            }

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    createButton(i);
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    createDots();
                }
            }
        }

        document.querySelectorAll("input").forEach(input => {
            input.addEventListener("change", () => {
                currentPage = 1;
                filterProducts();
            });
        });

        if (minRange) minRange.addEventListener("input", () => {
            currentPage = 1;
            filterProducts();
        });
        if (maxRange) maxRange.addEventListener("input", () => {
            currentPage = 1;
            filterProducts();
        });

        searchBtn.addEventListener("click", () => {
            currentPage = 1;
            filterProducts();
        });
        searchInput.addEventListener("keyup", () => {
            currentPage = 1;
            filterProducts();
        });

        function clearAll() {
            document.querySelectorAll(
                    ".filter-category, .filter-fabric, .filter-stock, .filter-discount, .filter-rating")
                .forEach(filter => filter.checked = false);
            searchInput.value = "";
            currentPage = 1;
            filterProducts();
        }

        if (clearAllFilters) clearAllFilters.addEventListener("click", clearAll);
        if (clearAllFiltersBtn2) clearAllFiltersBtn2.addEventListener("click", clearAll);

        filterProducts();
    });
</script>

<script>
    /* mobile filter drawer */
    const openFilter = document.getElementById("openFilter");
    const closeFilter = document.getElementById("closeFilter");
    const filterSidebar = document.getElementById("filterSidebar");

    if (openFilter) {
        openFilter.addEventListener("click", () => {
            filterSidebar.classList.remove("-translate-x-full");
        });
    }
    if (closeFilter) {
        closeFilter.addEventListener("click", () => {
            filterSidebar.classList.add("-translate-x-full");
        });
    }
</script>
