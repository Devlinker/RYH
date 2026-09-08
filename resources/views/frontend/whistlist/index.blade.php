@extends('frontend.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">

    <h4 class="text-xl font-semibold mb-6">Wishlist</h4>

    @if($products->count() > 0)

        <!-- PRODUCT GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('frontend.components.productcard', ['product' => $product])
            @endforeach
        </div>

        <!-- PAGINATION -->
        <div id="pagination" class="flex justify-center mt-10 gap-2 flex-wrap"></div>

    @else

        <!-- EMPTY WISHLIST -->
        <div class="flex items-center justify-center px-4 py-16">
            <div class="max-w-4xl w-full rounded-2xl p-8 md:flex md:items-center md:justify-between">
                <div class="flex justify-center mb-6 md:mb-0 w-full md:w-[60%]">
                    <img src="{{ asset('assets/images/whistlist.svg') }}" alt="No wishlist" class="w-full max-w-sm">
                </div>
                <div class="text-center md:text-left w-full md:w-[40%]">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">No wishlist</h2>
                    <p class="text-gray-500 mb-1">Your favorites live here.</p>
                    <p class="text-gray-500 mb-6">Like and collect the items you love.</p>
                    <a href="{{ url('/shop') }}"
                        class="inline-block bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">
                        Start Shopping
                    </a>
                </div>
            </div>
        </div>

    @endif

</div>

{{-- keep your existing pagination <script> here, unchanged --}}

@endsection
