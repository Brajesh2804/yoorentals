<?= $this->extend('users/_layouts/master') ?>
<?= $this->section("content") ?>

<div class="bg-slate-50 min-h-screen py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">
                Privacy <span class="text-blue-600">Policy</span>
            </h1>
            <p class="text-slate-500 font-medium italic">Last Updated: May 2026</p>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 p-8 md:p-16 border border-white">
            
            <div class="space-y-12">
                
                <section class="flex gap-6">
                    <div class="hidden md:flex w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">Our Commitment</h2>
                        <p class="text-slate-600 leading-relaxed">
                            YooRental values your privacy and protects your personal data. 
                            We collect only necessary information to improve your rental experience. 
                            Our goal is to make renting simple while keeping your identity secure.
                        </p>
                    </div>
                </section>

                <section class="flex gap-6">
                    <div class="hidden md:flex w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">Information We Collect</h2>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <li class="flex items-center gap-3 text-slate-600 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Name & Contact Details
                            </li>
                            <li class="flex items-center gap-3 text-slate-600 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Verification Documents
                            </li>
                            <li class="flex items-center gap-3 text-slate-600 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Transaction History
                            </li>
                            <li class="flex items-center gap-3 text-slate-600 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Location for Better Results
                            </li>
                        </ul>
                    </div>
                </section>

                <section class="flex gap-6">
                    <div class="hidden md:flex w-12 h-12 bg-green-50 text-green-600 rounded-2xl items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">No Third-Party Sharing</h2>
                        <p class="text-slate-600 leading-relaxed mb-4">
                            Your personal information is **never sold** to third parties. All user data is securely stored using industry-standard encryption methods.
                        </p>
                        <div class="bg-green-50 border border-green-100 p-5 rounded-2xl">
                            <p class="text-green-800 text-sm font-medium">
                                🔒 We use SSL encryption to ensure your payment and identity data is 100% safe.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="pt-8 border-t border-slate-100">
                    <p class="text-slate-500 text-sm text-center italic">
                        By using YooRental, you agree to our privacy practices and policies. 
                        If you have any questions, please contact our <a href="#" class="text-blue-600 font-bold hover:underline">Support Team</a>.
                    </p>
                </section>

            </div>
        </div>

        <div class="text-center mt-10">
            <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 text-slate-500 font-bold hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Back to Marketplace
            </a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>