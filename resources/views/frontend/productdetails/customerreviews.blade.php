<div class="max-w-7xl mx-auto p-8 md:p-[2rem_4rem]">
    <!-- Tabs -->
    <div class="flex gap-6 md:gap-8 border-b mb-6 md:mb-8 text-sm md:text-base">
        <button id="tabReviews" class="border-b-2 border-black pb-2 font-semibold">
            Customer Reviews
        </button>
        <button id="tabShipping" class="text-gray-400 pb-2">
            Shipping & Returns
        </button>
    </div>


    <!-- SHIPPING CONTENT -->
    <div id="shippingContent" class="hidden grid md:grid-cols-2 gap-6 mb-10">
        <!-- Shipping -->
        <div class="border rounded-xl overflow-hidden">
            <div class="bg-gray-200 px-6 py-3 font-semibold text-gray-800">
                Shipping
            </div>
            <div class="p-6 text-gray-600 text-sm">
                <ul class="list-disc pl-5 space-y-2">
                    <li>Delivery in 3–5 business days</li>
                    <li>Free shipping on orders above ₹999</li>
                    <li>Orders shipped from Tiruppur factory</li>
                    <li>Tracking via SMS & email</li>
                </ul>
            </div>
        </div>

        <!-- Returns -->
        <div class="border rounded-xl overflow-hidden">
            <div class="bg-gray-200 px-6 py-3 font-semibold text-gray-800">
                Returns & Exchanges
            </div>
            <div class="p-6 text-gray-600 text-sm">
                <ul class="list-disc pl-5 space-y-2">
                    <li>Delivery in 3–5 business days</li>
                    <li>Free shipping on orders above ₹999</li>
                    <li>Orders shipped from Tiruppur factory</li>
                    <li>Tracking via SMS & email</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- REVIEWS CONTENT -->
    <div id="reviewContent">

        <div class="flex flex-col md:flex-row gap-10">

            <!-- LEFT SIDE -->
            <div class="w-full md:w-[25%]">

                <div class="flex items-end gap-2">
                    <h1 class="text-6xl md:text-9xl font-bold">{{ $avgRating }}</h1>
                    <span class="text-lg md:text-xl text-gray-500">/5</span>
                </div>

                <p class="text-gray-400 text-sm mt-2">({{ $reviewCount }} Reviews)</p>

                <div class="mt-6 space-y-3 w-full md:w-[90%]">
                    @foreach ($distribution as $star => $data)
                        <div class="flex items-center gap-3">
                            <div class="w-full bg-gray-200 h-2 rounded">
                                <div class="bg-black h-2 rounded" style="width: {{ $data['percent'] }}%"></div>
                            </div>
                            ⭐{{ $star }}
                        </div>
                    @endforeach
                </div>

                @if ($reviewImages->count())
                    <div class="flex flex-wrap gap-2 mt-6">
                        @foreach ($reviewImages as $img)
                            <img src="{{ asset('storage/' . $img) }}"
                                class="w-14 h-14 md:w-16 md:h-16 rounded-lg object-cover">
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- RIGHT SIDE -->
            <div class="w-full md:w-[75%]">

                <!-- Top -->
                <div class="flex flex-col sm:flex-row gap-3 sm:justify-between mb-6">
                    {{-- <button onclick="openReviewModal()" class="border px-4 py-2 rounded-full text-sm">
                        <i class="fa-regular fa-pen-to-square mr-1"></i>
                        Write a review
                    </button> --}}

                    {{-- <select class="border rounded-full px-4 py-2 text-sm">
                        <option>Newest</option>
                        <option>Oldest</option>
                        <option>Top Rating</option>
                    </select> --}}
                </div>

                <!-- Reviews -->
                @forelse ($reviews as $review)
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <!-- Profile -->
                        <img src="{{ $review->user && $review->user->image_path ? asset('storage/' . $review->user->image_path) : '' }}"
                            class="w-12 h-12 rounded-full object-cover">
                        <!-- Content -->
                        <div>
                            <h4 class="font-semibold">
                                {{ $review->user->name ?? 'Anonymous' }}
                            </h4>
                            <!-- Stars -->
                            <div class="flex items-center text-yellow-400 text-sm my-1">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                <span class="text-gray-400 ml-2 text-xs">
                                    {{ $review->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <!-- Review -->
                            <p class="text-gray-500 text-sm leading-relaxed">
                                {{ $review->review }}
                            </p>
                            <!-- Images -->
                            @if ($review->image)
                                @php
                                    $images = json_decode($review->image, true);
                                @endphp

                                <div class="flex flex-wrap gap-3 mt-4">
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class="w-14 h-14 md:w-16 md:h-16 rounded-lg object-cover">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No reviews yet. Be the first to write one!</p>
                @endforelse

            </div>

        </div>

    </div>

</div>

</div>


<!-- Pagination -->
@if ($reviews->hasPages())
    <div class="flex items-center justify-center mt-10 text-sm">
        {{ $reviews->links() }}
    </div>
@endif
@include('frontend.components.reviewpopup')
<script>
    const tabReviews = document.getElementById("tabReviews");
    const tabShipping = document.getElementById("tabShipping");

    const reviewContent = document.getElementById("reviewContent");
    const shippingContent = document.getElementById("shippingContent");

    tabReviews.onclick = function() {

        reviewContent.classList.remove("hidden");
        shippingContent.classList.add("hidden");

        tabReviews.classList.add("border-b-2", "border-black", "font-semibold");
        tabReviews.classList.remove("text-gray-400");

        tabShipping.classList.remove("border-b-2", "border-black", "font-semibold");
        tabShipping.classList.add("text-gray-400");

    }

    tabShipping.onclick = function() {

        shippingContent.classList.remove("hidden");
        reviewContent.classList.add("hidden");

        tabShipping.classList.add("border-b-2", "border-black", "font-semibold");
        tabShipping.classList.remove("text-gray-400");

        tabReviews.classList.remove("border-b-2", "border-black", "font-semibold");
        tabReviews.classList.add("text-gray-400");

    }

    function openReviewModal() {
        @auth
        document.getElementById('reviewModal').showModal();
    @else
        showToast('Please login to write a review.', "error");
    @endauth
    }
</script>
