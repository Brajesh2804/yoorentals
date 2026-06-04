<?= $this->extend('users/_layouts/master') ?>
<?= $this->section("content") ?>

<div class="bg-slate-50 min-h-screen py-20">

    <div class="max-w-6xl mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- LEFT -->
            <div class="bg-white rounded-3xl shadow-lg p-10 border border-slate-100">

                <h1 class="text-5xl font-black text-slate-900 mb-6">
                    Contact Us
                </h1>

                <p class="text-slate-600 mb-8 leading-relaxed">
                    Need help? Contact the YooRental support team anytime.
                </p>

                <div class="space-y-6">

                    <div>
                        <h3 class="font-bold text-slate-800">Phone</h3>
                        <p class="text-slate-500">+91 880-940-8811</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800">Email</h3>
                        <p class="text-slate-500">careerboss@gmail.com</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800">Location</h3>
                        <p class="text-slate-500">Club Mode, D.M. Kothi Road Ara,Bihar</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="bg-white rounded-3xl shadow-lg p-10 border border-slate-100">

                <h2 class="text-3xl font-black text-slate-900 mb-8">
                    Send Message
                </h2>

                <form>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">Full Name</label>
                        <input type="text"
                               class="w-full border border-slate-200 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">Email Address</label>
                        <input type="email"
                               class="w-full border border-slate-200 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">Message</label>
                        <textarea rows="5"
                                  class="w-full border border-slate-200 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-slate-900 transition-all">
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>