@extends('frontend.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-[25%]">
            @include('frontend.profile.sidebar')
        </div>
        <div class="w-full md:w-[40%]">
            <div class="w-full p-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-xl text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="flex flex-col md:flex-row md:items-center gap-6 mb-6">
                        <input type="hidden" name="exiting_image" id="exiting_image" value="{{ $user->image_path ?? '' }}" />
                        <img id="avatarPreview" src="{{ $user->image_path ? asset('storage/' . $user->image_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=000000&color=ffffff' }}" class="w-20 h-20 rounded-full object-cover" alt="profile">
                        <div>
                            <div class="flex gap-3 mb-2">
                                <input type="file" name="avatar" id="fileInput" class="hidden" accept="image/*">
                                <button type="button" onclick="document.getElementById('fileInput').click()"
                                    class="bg-black text-white px-5 py-2 rounded-full text-sm">
                                    Upload Photo
                                </button>
                                <button type="button" id="removeBtn"
                                    class="border border-gray-300 px-5 py-2 rounded-full text-sm text-gray-400">
                                    Remove
                                </button>
                            </div>
                            <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                            <p class="text-xs text-gray-400 w-[80%]">
                                Make sure the image is at least 400×400px and under 5 MB.
                            </p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">User Name</label>
                        <input type="text" name="name"
                            value="{{ $user->name ?? ''}}"
                            placeholder="Enter Your User Name"
                            class="w-full mt-2 px-4 py-3 rounded-full border @error('name') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-black">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 pl-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Mobile Number</label>
                        <div class="flex items-center mt-2 border @error('phone') border-red-400 @else border-gray-200 @enderror rounded-full overflow-hidden">
                            <div class="flex items-center gap-2 px-4 border-r">
                                <img src="https://flagcdn.com/w20/in.png" class="w-5" alt="IN">
                                <span class="text-sm">+91</span>
                            </div>
                            <input type="text" name="phone"
                                value="{{ $user->mobile_number ?? ''}}"
                                placeholder="Enter Mobile Number"
                                class="flex-1 px-4 py-3 outline-none">
                            @if($user->phone)
                                <span class="text-green-500 text-xs pr-4">✔ Verified</span>
                            @endif
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1 pl-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="email"
                            value="{{ $user->email ?? ''}}"
                            placeholder="Enter Your Email"
                            class="w-full mt-2 px-4 py-3 rounded-full border @error('email') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-black">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 pl-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Submit -->
                    <button type="submit" class="bg-black text-white px-6 py-3 rounded-full">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Avatar Preview & Remove JS --}}
<script>
    const fileInput = document.getElementById('fileInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const removeBtn = document.getElementById('removeBtn');
    const removeAvatarInput = document.getElementById('removeAvatarInput');

    const defaultAvatar = "https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=000000&color=ffffff";

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                avatarPreview.src = e.target.result;
                removeAvatarInput.value = '0';
            };
            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', function () {
        avatarPreview.src = defaultAvatar;
        fileInput.value = '';
        removeAvatarInput.value = '1';
    });
</script>

@endsection
