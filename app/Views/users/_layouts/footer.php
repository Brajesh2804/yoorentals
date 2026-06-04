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
                    <a href="https://facebook.com" target="_blank">FB</a>

                    <a href="https://instagram.com" target="_blank">IG</a>

                    <a href="https://twitter.com" target="_blank">TW</a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Rental Categories</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li>
                        <a href="<?= base_url('home?cat=rooms') ?>" class="hover:text-blue-400 transition-colors">
                            Residential Rooms
                        </a>
                    </li>
                    <li><a href="<?= base_url('home?cat=cars') ?>" class="hover:text-blue-400 transition-colors">Luxury Car Rentals</a></li>
                    <li><a href="<?= base_url('home?cat=offices') ?>" class="hover:text-blue-400 transition-colors">Commercial Offices</a></li>
                    <li><a href="<?= base_url('home?cat=halls') ?>" class="hover:text-blue-400 transition-colors">Event & Marriage Halls</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Legal & Help</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="<?= base_url('about') ?>" class="hover:text-blue-400 transition-colors">About
                            YooRantal</a></li>
                    <li><a href="<?= base_url('privacy-policy') ?>"
                            class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="<?= base_url('terms') ?>" class="hover:text-blue-400 transition-colors">Terms of
                            Service</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="hover:text-blue-400 transition-colors">Contact
                            Support</a></li>
                </ul>
            </div>


            <form action="<?= base_url('subscribe') ?>" method="post" class="flex flex-col gap-3">

                <?= csrf_field() ?>

                <!-- SUCCESS MESSAGE -->
                <?php if (session()->getFlashdata('success')): ?>

                <div id="flash-message"
                    class="fixed top-6 right-6 z-50 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl font-semibold text-sm animate-bounce">

                    <?= session()->getFlashdata('success') ?>

                </div>

                <?php endif; ?>


                <!-- ERROR MESSAGE -->
                <?php if (session()->getFlashdata('error')): ?>

                <div id="flash-message"
                    class="fixed top-6 right-6 z-50 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl font-semibold text-sm">

                    <?= session()->getFlashdata('error') ?>

                </div>

                <?php endif; ?>

                <input type="email" name="email" placeholder="Enter Your Login Email" required
                    class="bg-slate-800 border-none p-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none text-white transition rounded-xl">

                <button type="submit"
                    class="bg-blue-600 text-white py-3 font-bold text-xs uppercase tracking-widest hover:bg-blue-700 transition active:scale-95 rounded-xl">

                    Subscribe

                </button>

            </form>
        </div>

        <div class="border-t border-slate-800/50 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date('Y') ?> <a
                href="https://webpanelsolutions.com/" target="_blank">WebPanelSolutions</a>. All rights reserved.</span>
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

    setTimeout(() => {

        let flash = document.getElementById('flash-message');

        if (flash) {

            flash.style.transition = "0.5s";

            flash.style.opacity = "0";

            flash.style.transform = "translateY(-20px)";

            setTimeout(() => {
                flash.remove();
            }, 500);
        }

    }, 3000);
    </script>

</footer>