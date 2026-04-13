<nav class="bg-white shadow-sm border-b sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">

        <a href="<?= base_url() ?>" class="flex items-center gap-0 group">
            <img src="<?= base_url('assets/admin/images/logo1b.png') ?>" alt="logo" class="h-10 w-auto object-contain" />
        </a>

        <div class="hidden md:flex flex-1 mx-12">
            <div class="flex w-full border-2 border-slate-900 rounded-md overflow-hidden bg-white">
                <input type="text" placeholder="Search Rooms, Cars, Bikes..." class="w-full px-4 py-1.5 outline-none text-slate-700">
                <button class="bg-slate-900 text-white px-5 py-2 hover:bg-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <?php if(session()->get('userlogin')): ?>
                <div class="relative group">
                    <button class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 p-1.5 rounded-full transition-all border border-slate-200">
                        <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-black shadow-inner">
                            <?= strtoupper(substr(session()->get('name'), 0, 1)) ?>
                        </div>
                        <div class="hidden lg:block text-left pr-2">
                            <p class="text-[10px] text-slate-400 font-bold uppercase leading-none">Welcome</p>
                            <p class="text-sm font-bold text-slate-800 leading-tight"><?= session()->get('name') ?></p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-2xl py-2 hidden group-hover:block z-[60] animate-in fade-in slide-in-from-top-2 duration-200">
                        <div class="px-4 py-3 border-b border-slate-50 mb-2">
                            <p class="text-xs text-slate-400 font-medium">Logged in as</p>
                            <p class="text-sm font-bold text-slate-800 truncate"><?= session()->get('email') ?></p>
                        </div>
                        <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 font-semibold transition-all">
                             <span>📊 Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 font-semibold transition-all">
                             <span>👤 My Profile</span>
                        </a>
                        <div class="border-t border-slate-50 my-2"></div>
                        <a href="<?= base_url('admin/auth/logout') ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-bold transition-all">
                             <span>🚪 Logout</span>
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <a href="<?= base_url('/login') ?>" class="font-bold text-slate-800 hover:text-blue-600 transition tracking-tight">
                    Login
                </a>
                <a href="<?= base_url('/register') ?>"
                    class="relative inline-flex items-center px-6 py-1.5 font-bold text-slate-900 bg-white border-4 border-t-yellow-400 border-l-blue-500 border-r-green-500 border-b-red-500 rounded-full hover:shadow-lg transition-all scale-95 hover:scale-100">
                    <span class="mr-1 text-xl">+</span> SELL
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>