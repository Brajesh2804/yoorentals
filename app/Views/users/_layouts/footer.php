<footer class="bg-[#0f172a] text-slate-300 border-t border-slate-800 pt-16 mt-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12">

            <div class="space-y-6">
                <div class="flex items-center gap-0">
                    <img src="<?= base_url('assets/admin/images/logo1a.png') ?>" class="h-8 w-auto brightness-0 invert"
                        alt="logo" />
                    <img src="<?= base_url('assets/admin/images/logo1b.png') ?>" class="h-8 w-auto brightness-0 invert"
                        alt="logo" />
                </div>
                <p class="text-sm leading-relaxed text-slate-400">
                    Bihar's #1 trusted marketplace for rooms, cars, and commercial spaces. Making rentals easier,
                    faster, and more secure for everyone.
                </p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg text-white">FB</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg text-white">IG</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg text-white">TW</a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Rental Categories</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Residential Rooms</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Luxury Car Rentals</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Commercial Offices</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Event & Marriage Halls</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Legal & Help</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">About YooRantal</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Contact Support</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Stay Updated</h4>
                <p class="text-xs text-slate-400 mb-4 font-medium">Subscribe to get latest rental alerts in Patna.</p>
                <form class="flex flex-col gap-3">
                    <input type="email" placeholder="Your Email"
                        class="bg-slate-800 border-none p-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none text-white transition">
                    <button
                        class="bg-blue-600 text-white py-3 font-bold text-xs uppercase tracking-widest hover:bg-blue-700 transition active:scale-95">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-800/50 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest">
                © 2026 YooRantal Group. All Rights Reserved.
            </p>
            <div class="flex gap-6 text-[10px] font-black uppercase text-slate-500 tracking-tighter">
                <span>Designed in Bihar</span>
                <span class="text-slate-800">|</span>
                <span>Secure Payments</span>
                <span class="text-slate-800">|</span>
                <span>Verified Listings</span>
            </div>
        </div>
    </div>
    <script>
        function searchProduct() {
            let keyword = document.getElementById('liveSearch').value;
            let grid = document.getElementById('items-container'); // Home.php mein yahi ID hai

            if (!grid) {
                console.error("Error: 'items-container' not found on this page.");
                return;
            }

            // AJAX Call
            fetch('<?= base_url('search-ads') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'keyword': keyword,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
                .then(response => response.text())
                .then(data => {
                    grid.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

</footer>