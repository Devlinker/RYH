@extends('frontend.app')

@section('content')

    @php
        $statusMap = [
            '1' => [
                'text' => 'Order Confirmed',
                'type' => 'confirmed',
                'class' => 'text-emerald-700 bg-emerald-100', // Green
            ],

            '3' => [
                'text' => 'Shipped',
                'type' => 'shipped',
                'class' => 'text-sky-700 bg-sky-100', // Sky Blue
            ],

            '4' => [
                'text' => 'Order Delivered',
                'type' => 'delivered',
                'class' => 'text-teal-700 bg-teal-100', // Teal
            ],

            '5' => [
                'text' => 'Cancelled',
                'type' => 'cancelled',
                'class' => 'text-rose-700 bg-rose-100', // Red/Rose
            ],

            '6' => [
                'text' => 'Refunded',
                'type' => 'refunded',
                'class' => 'text-amber-700 bg-amber-100', // Amber/Orange
            ],
        ];

        $statusInfo = $statusMap[$order->status] ?? ['text' => 'Processing', 'class' => 'text-gray-600 bg-gray-50'];
        $isDelivered = $order->status === '4';
        $address = $order->Address;
        $paymentMethod = strtoupper($order->payment?->status ?? 'Pending');
        $itemsCount = $order->orderDetails->sum('quantity');
        $pendingReviewItem = $isDelivered ? $order->orderDetails->first(fn($item) => !$item->review) : null;
        $submittedReviewItem = $order->orderDetails->first(fn($item) => $item->review);
        $reviewItem = $pendingReviewItem ?: $submittedReviewItem;
        $submittedReview = $reviewItem?->review;
        $submittedReviewImages =
            $submittedReview && $submittedReview->image ? json_decode($submittedReview->image, true) : [];
        $submittedReviewImages = is_array($submittedReviewImages) ? $submittedReviewImages : [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-10">

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_22rem] gap-10">

            <!-- ================= LEFT SIDE ================= -->
            <div>
                <a href="{{ route('profile.orders') }}" class="flex items-center gap-2 cursor-pointer pb-[25px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="text-sm font-medium">Back</span>
                </a>

                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <p class="text-xs text-gray-400">Order ID</p>
                        <h1 class="text-xl font-semibold text-gray-900">{{ $order->order_id }}</h1>
                    </div>
                    <span
                        class="inline-flex w-fit items-center rounded-full px-3 py-1 text-sm font-medium {{ $statusInfo['class'] }}">
                        {{ $statusInfo['text'] }}
                    </span>
                </div>

                @if (session('success'))
                    <div class="mb-5 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto border border-gray-200 rounded-2xl bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-left text-xs uppercase text-gray-400">
                            <tr>
                                <th class="px-4 py-3 font-medium">Product</th>
                                <th class="px-4 py-3 font-medium">Qty</th>
                                <th class="px-4 py-3 font-medium">Price</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($order->orderDetails as $item)
                                @php
                                    $image = $item->product_image ?: $item->product?->main_image;
                                    $review = $item->review;
                                @endphp
                                <tr class="align-top">
                                    <td class="px-4 py-4">
                                        <div class="flex min-w-[16rem] gap-3">
                                            <img src="{{ $image ? asset('storage/' . $image) : '' }}"
                                                alt="{{ $item->product_name }}"
                                                class="h-20 w-20 rounded-xl border border-gray-100 object-contain">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                                <p class="mt-1 text-xs text-gray-400">ITEM CODE : {{ $item->product_id }}
                                                </p>
                                                @if ($item->product_size)
                                                    <p class="mt-1 text-xs text-gray-500">Size: {{ $item->product_size }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">
                                        ₹{{ number_format((float) $item->net_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($reviewItem)
                    <form action="{{ route('review.store', $reviewItem->product_id) }}" method="POST"
                        enctype="multipart/form-data" class="mt-8 space-y-5 order-review-form">
                        @csrf
                        <input type="hidden" name="order_detail_id" value="{{ $reviewItem->id }}">

                        <div>
                            <p class="text-sm text-gray-400 mb-1">{{ $submittedReview ? 'Your review' : 'Reviewing' }}</p>
                            <h2 class="text-lg font-semibold text-gray-900">{{ $reviewItem->product_name }}</h2>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-1">Rate your experience</h3>
                            <p class="text-sm text-gray-400 mb-4">
                                Share your thoughts with other customers
                            </p>

                            <div class="star-rating flex gap-2 text-xl sm:text-2xl text-gray-300">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $submittedReview && $i <= $submittedReview->rating ? 'fa-solid text-yellow-400' : 'fa-regular' }} fa-star {{ $submittedReview ? '' : 'cursor-pointer hover:text-yellow-400' }}"
                                        data-value="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" class="rating-input"
                                value="{{ $submittedReview?->rating ?? '' }}" required>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-3">Review this product</h3>

                            <textarea name="review" required maxlength="500" placeholder="Share your thoughts"
                                class="review-text w-full h-40 border border-gray-300 rounded-xl p-4 outline-none focus:border-gray-400 resize-none"
                                {{ $submittedReview ? 'readonly' : '' }}>{{ $submittedReview?->review }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">
                                <span class="char-count">{{ strlen($submittedReview?->review ?? '') }}</span> / 500
                                characters
                            </p>
                        </div>

                        <div>
                            @if ($submittedReview)
                                @if (count($submittedReviewImages))
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($submittedReviewImages as $reviewImage)
                                            <img src="{{ $reviewImage ? asset('storage/' . $reviewImage) : '' }}"
                                                alt="Review image"
                                                class="h-28 w-28 rounded-xl border border-gray-200 object-cover">
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <label
                                    class="w-full h-24 border border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-300 cursor-pointer hover:bg-gray-50">
                                    <i class="fa-regular fa-image text-xl mb-1"></i>
                                    <span class="upload-text text-sm">Upload Photo</span>
                                    <input type="file" name="image[]" accept="image/jpeg,image/png,image/webp"
                                        class="review-image hidden" multiple>
                                </label>
                                <div class="image-preview mt-3 hidden flex flex-wrap gap-3"></div>
                            @endif
                        </div>

                        @unless ($submittedReview)
                            <button type="submit" class="bg-black text-white px-6 py-2 rounded-full">
                                Submit
                            </button>
                        @endunless
                    </form>
                @endif
            </div>

            <!-- ================= RIGHT SIDE ================= -->
            <div class="space-y-5">
                <!-- Delivery -->
                <div class="border border-gray-300 rounded-2xl p-5 bg-white">
                    <h3 class="text-sm font-medium text-gray-800">Delivery details</h3>
                    <div class="my-4 border-t"></div>
                    @if ($address)
                        <p class="font-medium text-sm text-gray-800">{{ $address->name }}</p>
                        <p class="text-sm text-gray-500 leading-6 mt-1">
                            {{ collect([$address->address, $address->landmark, $address->city, $address->state, $address->pincode])->filter()->implode(', ') }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Mobile:
                            <span class="font-medium text-gray-800">{{ $address->phone_number }}</span>
                        </p>
                    @else
                        <p class="text-sm text-gray-500">Delivery address not available.</p>
                    @endif
                </div>

                <!-- Price -->
                <div class="border border-gray-300 rounded-2xl p-5 bg-white">
                    <h3 class="text-sm font-medium text-gray-800">Price details</h3>
                    <div class="my-4 border-t"></div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span>Items</span>
                            <span class="text-gray-800">{{ $itemsCount }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Sub Total</span>
                            <span class="text-gray-800">₹{{ number_format((float) $order->net_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Shipping</span>
                            <span class="text-gray-800">₹{{ number_format((float) $order->shipping_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Taxes</span>
                            <span class="text-gray-800">₹{{ number_format((float) $order->gst_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Coupon Discount</span>
                            <span class="text-gray-800">- ₹{{ number_format((float) $order->coupon_amount, 2) }}</span>
                        </div>
                    </div>
                    <div class="my-4 border-t"></div>
                    <div class="flex justify-between text-sm font-medium">
                        <span class="text-gray-500">Total</span>
                        <span class="text-gray-800">₹{{ number_format((float) $order->gross_amount, 2) }}</span>
                    </div>
                    <div class="mt-4 flex justify-between bg-gray-100 px-4 py-2 rounded-lg text-sm">
                        <span class="text-gray-500">Payment method</span>
                        <span class="text-gray-600 font-medium">{{ $paymentMethod }}</span>
                    </div>
                    <a href="{{ route('orders_invoice_download', $order->id) }}"
                        class="mt-5 w-full border border-black rounded-full py-2 text-sm hover:bg-black hover:text-white transition text-center block">
                        Download Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if (session('toast_message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast(
                    "{{ session('toast_type') }}",
                    "{{ session('toast_message') }}"
                );
            });
        </script>
    @endif
    <script>
        (function() {
            document.querySelectorAll('.order-review-form').forEach(form => {
                const stars = form.querySelectorAll('.star-rating i');
                const ratingInput = form.querySelector('.rating-input');
                const reviewText = form.querySelector('.review-text');
                const charCount = form.querySelector('.char-count');
                const fileInput = form.querySelector('.review-image');
                const uploadText = form.querySelector('.upload-text');
                const imagePreview = form.querySelector('.image-preview');
                let current = parseInt(ratingInput.value) || 0;

                function paint(val) {
                    stars.forEach(star => {
                        const value = parseInt(star.dataset.value);
                        star.classList.toggle('fa-solid', value <= val);
                        star.classList.toggle('fa-regular', value > val);
                        star.classList.toggle('text-yellow-400', value <= val);
                    });
                }

                stars.forEach(star => {
                    star.addEventListener('mouseenter', () => paint(parseInt(star.dataset.value)));
                    star.addEventListener('mouseleave', () => paint(current));
                    star.addEventListener('click', () => {
                        current = parseInt(star.dataset.value);
                        ratingInput.value = current;
                        paint(current);
                    });
                });

                reviewText?.addEventListener('input', () => {
                    charCount.textContent = reviewText.value.length;
                });

                fileInput?.addEventListener('change', () => {
                    const maxSize = 2 * 1024 * 1024;
                    const validFiles = [];
                    imagePreview.innerHTML = '';
                    Array.from(fileInput.files).forEach(file => {
                        if (file.size > maxSize) {
                            showToast(
                                `${file.name} exceeds 2MB. Please choose a smaller image.`,
                                'error');
                            return;
                        }
                        validFiles.push(file);
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.className =
                            'h-28 w-28 rounded-xl border border-gray-200 object-cover';
                        imagePreview.appendChild(img);
                    });
                    if (validFiles.length !== fileInput.files.length) {
                        const dt = new DataTransfer();
                        validFiles.forEach(file => dt.items.add(file));
                        fileInput.files = dt.files;
                    }
                    uploadText.textContent = validFiles.length ?
                        `${validFiles.length} image${validFiles.length > 1 ? 's' : ''} selected` :
                        'Upload Photo';
                    imagePreview.classList.toggle('hidden', validFiles.length === 0);
                });

                // Explicit required-field validation (hidden inputs skip native HTML5 validation)
                form.addEventListener('submit', (e) => {
                    let hasError = false;

                    if (!current || current < 1) {
                        hasError = true;
                        showToast('Please select a star rating.', 'error');
                    }

                    if (!reviewText.value.trim()) {
                        hasError = true;
                        showToast('Please write a review.', 'error');
                    }

                    if (hasError) {
                        e.preventDefault();
                    }
                });
            });
        })();
    </script>
@endsection
