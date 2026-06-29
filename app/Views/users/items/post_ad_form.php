<?= $this->extend("users/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="bg-white min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 shadow-2xl border rounded-3xl p-8">
        <h2 class="text-2xl font-black mb-6 uppercase tracking-tight">Post Ad: <span
                class="text-blue-600"><?= ucfirst($category_id) ?></span></h2>

        <form action="<?= base_url('items/save-ad') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="category" value="<?= $category_id ?>">

            <div class="mb-5">
                <label class="block font-bold text-slate-700 mb-1">Ad Title</label>
                <input type="text" name="title" required
                    class="w-full border-2 p-3 rounded-xl outline-none focus:border-blue-500 transition-all"
                    placeholder="e.g. Luxury 2BHK Apartment for Rent">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Price (₹)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3.5 text-slate-400 font-bold">₹</span>
                        <input type="text" id="price_display" required
                            class="w-full border-2 p-3 pl-8 rounded-xl outline-none focus:border-blue-500 font-bold text-slate-700"
                            placeholder="0">
                        <input type="hidden" name="price" id="actual_price">
                    </div>
                    <span id="price_error" class="text-red-500 text-[10px] font-bold mt-1 hidden">Only numeric values
                        are allowed!</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1"> Number</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3.5 text-slate-400 font-bold">+91</span>
                        <input type="number" name="phone" required
                            class="w-full border-2 p-3 pl-12 rounded-xl outline-none focus:border-blue-500 font-bold text-slate-700"
                            placeholder="9876543210">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block font-bold text-slate-700 mb-1">Location</label>
                    <input type="text" name="location" required
                        class="w-full border-2 p-3 rounded-xl outline-none focus:border-blue-500"
                        placeholder="e.g. Boring Road, Patna">
                </div>
            </div>

            <div class="mb-5">
                <label class="block font-bold text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="4" required
                    class="w-full border-2 p-3 rounded-xl outline-none focus:border-blue-500"
                    placeholder="Describe your item/property details..."></textarea>
            </div>

            <div class="mb-8">
                <label class="block font-bold text-slate-700 mb-1">Upload Photos (Multiple)</label>
                <div class="relative group">
                    <input type="file" id="image_input" name="images[]" multiple required
                        class="w-full border-2 border-dashed p-8 rounded-xl cursor-pointer bg-slate-50 group-hover:bg-white transition-all">
                    <div
                        class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-slate-400">
                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="text-sm font-bold">Select 2-6 photos (Hold Ctrl to select multiple)</span>
                    </div>
                </div>
                <div id="preview-area" class="grid grid-cols-6 gap-2 mt-4"></div>
            </div>

            <button type="submit" id="submit_btn"
                class="w-full bg-blue-600 text-white font-black py-4 rounded-xl hover:bg-slate-900 transition-all shadow-lg shadow-blue-200">
                POST NOW
            </button>
            <a href="javascript:history.back()"
                class="group relative block w-full text-center bg-white text-slate-600 font-bold py-4 rounded-xl border border-slate-200 hover:text-blue-600 hover:border-blue-300 transition-all duration-300 shadow-sm hover:shadow-indigo-100 hover:shadow-xl active:scale-[0.98] mt-4 overflow-hidden">

                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>

                <div class="relative flex items-center justify-center gap-2">
                    <i
                        class="fas fa-chevron-left text-sm transform group-hover:-translate-x-1 transition-transform duration-300"></i>
                    <span class="tracking-wider uppercase text-sm">Go Back</span>
                </div>
            </a>
        </form>
    </div>
</div>

<script>
    // Image Preview
    document.getElementById('image_input').addEventListener('change', function (e) {
        const previewArea = document.getElementById('preview-area');
        previewArea.innerHTML = '';
        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function (event) {
                previewArea.insertAdjacentHTML('beforeend', `<img src="${event.target.result}" class="h-16 w-full object-cover rounded-lg border">`);
            }
            reader.readAsDataURL(files[i]);
        }
    });

    // Price Formatting
    document.getElementById('price_display').addEventListener('input', function (e) {
        let errorMsg = document.getElementById('price_error');
        let inputVal = e.target.value;
        if (/[^0-9,]/.test(inputVal)) {
            errorMsg.classList.remove('hidden');
            e.target.value = inputVal.replace(/[^0-9,]/g, '');
            setTimeout(() => { errorMsg.classList.add('hidden'); }, 2000);
            return;
        }
        errorMsg.classList.add('hidden');
        let value = e.target.value.replace(/,/g, '');
        document.getElementById('actual_price').value = value;
        let lastThree = value.substring(value.length - 3);
        let otherNumbers = value.substring(0, value.length - 3);
        if (otherNumbers !== '') { lastThree = ',' + lastThree; }
        e.target.value = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    });
</script>
<?= $this->endSection() ?>