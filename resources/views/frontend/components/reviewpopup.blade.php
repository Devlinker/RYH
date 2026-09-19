@auth
<dialog id="reviewModal" class="rounded-2xl p-0 w-[95%] sm:w-[500px] md:w-[520px] backdrop:bg-black/40">

    <div class="p-4 sm:p-6 relative">

        <!-- Close Button -->
        <button type="button" onclick="document.getElementById('reviewModal').close()"
            class="absolute right-4 top-4 text-gray-500 text-lg">
            ✕
        </button>

        <h2 class="text-lg sm:text-xl font-semibold mb-5">Write a Review</h2>

        <form action="{{ route('review.store', $product->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-5" id="reviewForm">
            @csrf

            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Your Rating <span class="text-red-500">*</span>
                </label>

                <div id="starRating" class="flex gap-2 text-xl sm:text-2xl text-gray-300">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"
                        data-value="{{ $i }}"></i>
                        @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="">
                @error('rating')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Review -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Your Review <span class="text-red-500">*</span>
                </label>

                <textarea name="review" id="reviewText"
                    placeholder="Tell us about your experience with this product..." maxlength="500"
                    class="w-full border rounded-xl p-3 text-sm h-24 resize-none focus:outline-none focus:ring-2 focus:ring-black">{{ old('review') }}</textarea>

                <p class="text-xs text-gray-400 mt-1">
                    <span id="charCount">0</span> / 500 characters
                </p>
                @error('review')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Upload Photo -->
            <div>
                <label class="block text-sm font-medium mb-2">Add Photo (Optional)</label>

                <label class="border-2 border-dashed rounded-xl p-6 sm:p-8 flex flex-col items-center justify-center text-gray-400 cursor-pointer hover:bg-gray-50">
                    <input type="file" name="image[]" id="reviewImage" accept="image/jpeg,image/png,image/webp" class="hidden" multiple>
                    <i class="fa-solid fa-arrow-up-from-bracket text-xl sm:text-2xl mb-2"></i>
                    <p class="text-sm text-center" id="uploadText">Click to upload or drag and drop</p>
                    <span class="text-xs text-gray-400 mt-1 text-center">JPG, PNG, or WEBP, max 2MB each</span>
                </label>
                @error('image')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="button" onclick="document.getElementById('reviewModal').close()"
                    class="w-full sm:w-1/2 border rounded-full py-3 font-medium hover:bg-gray-100">
                    Cancel
                </button>
                <button type="submit"
                    class="w-full sm:w-1/2 bg-black text-white rounded-full py-3 font-medium hover:bg-gray-900">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</dialog>
@endauth

<script>
    (function() {
        const stars = document.querySelectorAll('#starRating i');
        const ratingInput = document.getElementById('ratingInput');
        const reviewText = document.getElementById('reviewText');
        const charCount = document.getElementById('charCount');
        const fileInput = document.getElementById('reviewImage');
        const uploadText = document.getElementById('uploadText');

        // Star rating
        let current = {
            {
                (int) old('rating', 0)
            }
        };

        function paint(val) {
            stars.forEach(s => {
                const v = parseInt(s.dataset.value);
                s.classList.toggle('fa-solid', v <= val);
                s.classList.toggle('fa-regular', v > val);
                s.classList.toggle('text-yellow-400', v <= val);
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
        paint(current);

        // Character counter
        if (reviewText) {
            const sync = () => charCount.textContent = reviewText.value.length;
            reviewText.addEventListener('input', sync);
            sync();
        }

        // File name feedback
        if (fileInput) {
            fileInput.addEventListener('change', () => {
                uploadText.textContent = fileInput.files.length ?
                    `${fileInput.files.length} image${fileInput.files.length > 1 ? 's' : ''} selected` :
                    'Click to upload or drag and drop';
            });
        }
    })();
</script>