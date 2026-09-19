@extends('frontend.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex flex-col md:flex-row gap-6">

        <!-- Sidebar -->
        <div class="w-full md:w-[25%]">
            @include('frontend.profile.sidebar')
        </div>

        <!-- Content -->
        <div class="w-full md:w-[70%]">

            <div class="w-full bg-white p-6 rounded-xl">

                @if(session('success'))
                <div class="mb-4 text-sm text-green-600 font-medium">{{ session('success') }}</div>
                @endif

                <!-- Support Form -->
                <form action="{{ route('support_help_save') }}" method="POST" enctype="multipart/form-data" class="mb-10">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" placeholder="Explain About Your Problem" required
                        class="w-full h-28 rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black resize-none">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="mt-4 text-sm font-medium text-gray-700">
                        Add An Image To Provide More Details
                        <span class="text-gray-400">(Optional)</span>
                    </p>
                    <!-- Upload area (shown when no image selected) -->
                    <label id="uploadArea"
                        class="mt-3 flex flex-col items-center justify-center w-full h-28 border border-dashed border-gray-400 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="file" name="image" id="ticketImage" accept="image/*" class="hidden" />
                        <div class="flex items-center gap-2 text-gray-600 text-sm font-medium">
                            <span>Attach Image</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />
                            </svg>
                        </div>
                    </label>
                    <!-- Preview area (shown after image selected) -->
                    <div id="previewArea" class="hidden mt-3 relative w-full h-40 rounded-xl overflow-hidden border border-gray-300">
                        <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover" />
                        <button type="button" id="removeImageBtn"
                            class="absolute top-2 right-2 w-7 h-7 flex items-center justify-center rounded-full bg-black/60 text-white hover:bg-black/80 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <p id="previewFileName" class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs px-3 py-1 truncate"></p>
                    </div>
                    @error('image')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                        class="mt-4 bg-black text-white text-sm font-medium px-10 py-3 rounded-full hover:bg-gray-900 transition">
                        Submit
                    </button>
                </form>

                <!-- Ticket List -->
                <div>
                    <h2 class="text-base font-semibold text-gray-800 mb-4">Supported Tickets</h2>
                    <div class="space-y-4 h-[60vh] overflow-y-auto">
                        @forelse($tickets as $ticket)
                        <div class="border border-gray-200 rounded-2xl p-4 md:p-5 bg-white">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <p class="text-sm font-semibold text-gray-800">Ticket ID: #{{ $ticket->id }}</p>
                                    </div>

                                    <p class="text-xs text-gray-500 mb-3">Created On: {{ $ticket->created_at->format('d/m/Y') }}</p>

                                    <div class="mb-3">
                                        <p class="text-sm font-semibold text-gray-700 mb-1">Description:</p>
                                        <p class="text-sm text-gray-500 leading-6">{{ $ticket->description }}</p>
                                    </div>

                                    @if($ticket->image)
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700 mb-2">Attachments:</p>
                                        <a href="{{ asset('storage/' . $ticket->image) }}" target="_blank" class="inline-block">
                                            <img src="{{ asset('storage/' . $ticket->image) }}" alt="Ticket attachment"
                                                class="w-20 h-20 object-cover rounded-lg border border-gray-200 hover:opacity-80 transition" />
                                        </a>
                                    </div>
                                    @endif
                                </div>

                                <div class="w-full md:w-auto flex md:block items-center justify-between md:text-right gap-3">
                                    @php
                                    $statusMap = [
                                    'pending' => 'bg-gray-100 text-gray-600',
                                    'in_progress' => 'bg-orange-100 text-orange-600',
                                    'on_hold' => 'bg-red-100 text-red-500',
                                    'resolved' => 'bg-green-100 text-green-600',
                                    'rejected' => 'bg-red-100 text-red-600',
                                    ];
                                    $statusLabel = [
                                    'pending' => 'Pending',
                                    'in_progress' => 'In Progress',
                                    'on_hold' => 'On Hold',
                                    'resolved' => 'Resolved',
                                    'rejected' => 'Rejected',
                                    ];
                                    @endphp
                                    <span class="inline-flex items-center justify-center px-4 py-1 rounded-full text-xs font-medium {{ $statusMap[$ticket->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $statusLabel[$ticket->status] ?? ucfirst($ticket->status) }}
                                    </span>

                                    <p class="text-xs text-gray-500">Last Updated: {{ $ticket->updated_at->format('d/m/Y') }}</p>
                                </div>

                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-400">No tickets raised yet.</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById('ticketImage');
        const uploadArea = document.getElementById('uploadArea');
        const previewArea = document.getElementById('previewArea');
        const previewImg = document.getElementById('previewImg');
        const previewName = document.getElementById('previewFileName');
        const removeBtn = document.getElementById('removeImageBtn');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file.');
                this.value = '';
                return;
            }
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert('Image must be smaller than 5MB.');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewName.textContent = file.name;
                uploadArea.classList.add('hidden');
                previewArea.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        removeBtn.addEventListener('click', function() {
            fileInput.value = '';
            previewImg.src = '';
            previewArea.classList.add('hidden');
            uploadArea.classList.remove('hidden');
        });
    });
</script>

@endsection