<?= $this->extend('users/_layouts/master') ?>
<?= $this->section("content") ?>

<div class="bg-slate-50 min-h-screen">

    <section class="relative bg-slate-900 overflow-hidden py-24 md:py-32">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-indigo-600/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest text-blue-400 uppercase bg-blue-400/10 rounded-full border border-blue-400/20">
                Our Journey
            </span>
            <h1 class="text-5xl md:text-7xl font-black mb-8 text-white tracking-tight">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">YooRental</span>
            </h1>
            <p class="max-w-3xl mx-auto text-xl text-slate-400 leading-relaxed font-medium">
                Bihar’s #1 trusted rental marketplace. We are bridging the gap between property owners and seekers with technology and trust.
            </p>
        </div>
    </section>

    <section class="py-24 -mt-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 text-blue-600 font-bold">
                        <span class="w-10 h-1 bg-blue-600 rounded-full"></span>
                        Who We Are
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">
                        Connecting People Through <br> <span class="text-blue-600">Smart Rentals.</span>
                    </h2>
                    <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                        <p>
                            YooRental was born out of a simple idea: **Renting should be as easy as ordering food.** We realized that finding a verified room, a car for travel, or an office space in Bihar was full of middlemen and confusion.
                        </p>
                        <p class="bg-blue-50 p-6 rounded-3xl border-l-4 border-blue-600 italic">
                            "Our mission is to create a transparent, digital-first ecosystem where every listing is verified and every transaction is secure."
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">🛡️</div>
                            <h4 class="font-black text-slate-800 text-xl mb-2">Verified Ads</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">No more fake listings. Every ad goes through a strict verification process.</p>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 mt-0 md:mt-8 hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">⚡</div>
                            <h4 class="font-black text-slate-800 text-xl mb-2">Instant Search</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Find what you need in seconds with our AI-powered filter system.</p>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">💬</div>
                            <h4 class="font-black text-slate-800 text-xl mb-2">Direct Chat</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Connect directly with owners. No hidden brokers or extra commissions.</p>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 mt-0 md:mt-8 hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">🔒</div>
                            <h4 class="font-black text-slate-800 text-xl mb-2">Data Privacy</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Your personal data is encrypted and never shared with anyone.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-blue-600 rounded-[3rem] p-12 md:p-20 shadow-2xl shadow-blue-200 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <circle cx="50" cy="50" r="40" />
                    </svg>
                </div>

                <div class="relative z-10 grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                    <div>
                        <h3 class="text-4xl md:text-6xl font-black text-white mb-2">10K+</h3>
                        <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Happy Users</p>
                    </div>
                    <div>
                        <h3 class="text-4xl md:text-6xl font-black text-white mb-2">5K+</h3>
                        <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Active Listings</p>
                    </div>
                    <div>
                        <h3 class="text-4xl md:text-6xl font-black text-white mb-2">100%</h3>
                        <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Verified Ads</p>
                    </div>
                    <div>
                        <h3 class="text-4xl md:text-6xl font-black text-white mb-2">24/7</h3>
                        <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Expert Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-4xl font-black text-slate-900 mb-6">Ready to find your next rental?</h2>
            <p class="text-slate-500 text-lg mb-10">Join thousands of people who use YooRental to find rooms, cars, and offices every day.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="<?= base_url('properties/category') ?>" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-slate-900 transition-all shadow-xl shadow-blue-200">Start Browsing</a>
                <a href="<?= base_url('users/dashboard') ?>" class="bg-white text-slate-900 border-2 border-slate-100 px-10 py-4 rounded-2xl font-black hover:bg-slate-50 transition-all">List Your Property</a>
            </div>
        </div>
    </section>

</div>

<?= $this->endSection() ?>