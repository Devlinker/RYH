@extends('frontend.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 sm:py-8 md:py-10">
    <div class="flex flex-col lg:flex-row gap-5 md:gap-6 lg:gap-[25px]">
        <!-- Sidebar -->
        <div class="w-full lg:w-[25%]">
            @include('frontend.profile.sidebar')
        </div>
        <!-- Main Content -->
        <div class="w-full lg:flex-1">
            <div class="rounded-2xl p-4 sm:p-5 md:p-6 border border-gray-200">
                @include('frontend.partials.address-manager', [
                    'title' => 'Manage Address',
                    'selectable' => false,
                ])
            </div>
        </div>
    </div>
</div>
@endsection
