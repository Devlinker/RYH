{{-- Reusable Address List + Add/Edit Modal --}}
<div class="flex items-center justify-between mb-4">
    <h2 class="font-semibold">{{ $title ?? 'Saved Addresses' }}</h2>
    <button onclick="AddressManager.openModal()" type="button"
        class="text-sm border border-gray-300 rounded-md px-3 py-1.5 hover:bg-black hover:text-white transition">
        + Add Address
    </button>
</div>

<div id="addressList" class="space-y-3">
    <p class="text-sm text-gray-500">Loading addresses...</p>
</div>

<!-- Address Modal -->
<div id="addressModal" class="hidden fixed inset-0 z-50 bg-black/50 px-4 py-6 overflow-y-auto">
    <div class="min-h-full flex items-center justify-center">
        <div class="relative w-full max-w-4xl bg-white rounded-3xl p-5 sm:p-6 md:p-8 shadow-xl mt-[40px] md:mt-0">
            <button onclick="AddressManager.closeModal()" type="button"
                class="absolute top-4 right-4 text-gray-500 hover:text-black text-2xl leading-none">&times;</button>
            <h2 id="addressModalTitle" class="text-lg sm:text-xl font-semibold mb-6 pr-8">Add Address</h2>
            <form id="addressForm">
                <input type="hidden" name="address_id" id="addressId">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 h-[70vh] overflow-y-auto md:overflow-y-visible md:h-auto">
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Full Name</label>
                        <input type="text" name="name" placeholder="Enter Your Full Name" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Mobile Number</label>
                        <div class="flex items-center mt-2 border border-gray-200 rounded-full overflow-hidden w-full">
                            <div
                                class="flex items-center gap-2 px-3 sm:px-4 border-r border-gray-200 shrink-0 bg-white">
                                <img src="https://flagcdn.com/w20/in.png" alt="India Flag" class="w-5 h-4 object-cover">
                                <span class="text-sm text-gray-700">+91</span>
                            </div>
                            <input type="tel" name="phone_number" placeholder="Enter Mobile Number" required
                                class="flex-1 min-w-0 px-4 py-3 text-sm sm:text-base outline-none">
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Address Type</label>
                        <select name="address_type" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none bg-white">
                            <option value="">Select Address Type</option>
                            <option value="home">Home</option>
                            <option value="work">Work</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">State</label>
                        <input type="text" name="state" placeholder="Select State" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Street Address</label>
                        <input type="text" name="address" placeholder="Enter Street Address" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">City</label>
                        <input type="text" name="city" placeholder="Select City" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Pincode</label>
                        <input type="text" name="pincode" placeholder="Enter Pincode" required
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Landmark</label>
                        <input type="text" name="landmark" placeholder="Enter Landmark"
                            class="w-full mt-2 px-4 py-3 rounded-full border border-gray-200 text-sm sm:text-base outline-none">
                    </div>
                </div>
                <p id="addressFormMessage" class="mt-4 hidden text-sm"></p>
                <div class="mt-6 flex justify-start">
                    <button type="submit" id="addressSubmitBtn"
                        class="w-full sm:w-auto bg-black text-white px-6 sm:px-8 py-3 rounded-full text-sm sm:text-base hover:bg-gray-800 transition">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-[60] bg-black/50 flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
        <div class="flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-3">
                <i class="fa-solid fa-trash text-red-600"></i>
            </div>
            <h3 class="text-lg font-semibold">Delete Address?</h3>
            <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
        </div>
        <div class="flex gap-3 mt-6">
            <button type="button" onclick="AddressManager.closeDeleteModal()"
                class="flex-1 border border-gray-300 rounded-full py-2.5 text-sm font-medium hover:bg-gray-100">
                Cancel
            </button>
            <button type="button" id="confirmDeleteBtn"
                class="flex-1 bg-red-600 text-white rounded-full py-2.5 text-sm font-medium hover:bg-red-700">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    // Routes injected once — AddressManager.init() reads these globals
    window.ADDRESS_ROUTES = {
        list: "{{ route('address.list') }}",
        save: "{{ route('delivery_address.save') }}",
        setDefault: "{{ route('address.set_default') }}",
        delete: "{{ route('address.delete') }}",
    };
</script>
<script src="{{ asset('admin/js/address-manager.js') }}?v={{ time() }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AddressManager.init({
            onChange: function() {
                // Optional hook: pages can listen for address list/selection changes
                if (typeof window.onAddressListChanged === 'function') {
                    window.onAddressListChanged(AddressManager.getAddresses(), AddressManager
                        .getSelectedId());
                }
            },
            selectable: {{ $selectable ?? false ? 'true' : 'false' }}
        });
    });
</script>
