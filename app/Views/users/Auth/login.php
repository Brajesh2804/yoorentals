<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YooRental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50 overflow-hidden">

    <div class="flex min-h-screen">
        <div class="hidden lg:flex lg:w-1/2 bg-[#0f172a] relative items-center justify-center p-12 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/20 blur-[100px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-600/20 blur-[100px] rounded-full translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative z-10 w-full max-w-lg">
                <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 text-white mb-12 group">
                    <span class="bg-blue-600 p-2 rounded-lg group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </span>
                    <span class="text-2xl font-black tracking-tighter uppercase">Yoo<span class="text-blue-500">Rental</span></span>
                </a>

                <h1 class="text-5xl font-extrabold text-white leading-tight mb-6">
                    Find the perfect <br><span class="text-blue-500">Space</span> for your next big move.
                </h1>
                <p class="text-slate-400 text-lg mb-8 font-medium">India's largest rental community is waiting for you. Log in to access your dashboard.</p>
                
                <div class="flex items-center gap-4 py-6 border-t border-slate-800">
                    <div class="flex -space-x-2">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?u=1" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?u=2" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?u=3" alt="">
                    </div>
                    <span class="text-slate-400 text-sm font-semibold">Joined by 10,000+ Renters</span>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12 bg-white">
            <div class="w-full max-w-[440px]">
                
                <a href="<?= base_url() ?>" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-blue-600 mb-10 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Back to Home
                </a>

                <div class="mb-10">
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight mb-3">Sign In</h2>
                    <p class="text-slate-500 font-medium tracking-tight">Enter your credentials to access your account.</p>
                </div>

                <?php if(session()->getFlashdata('message')): ?>
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded-r-lg animate-pulse">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/login') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-widest">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <input type="email" name="email" value="<?= old('email') ?>" required
                                class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-600 focus:ring-0 outline-none transition-all duration-300 font-medium placeholder:text-slate-300" 
                                placeholder="name@example.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-bold text-slate-700 uppercase tracking-widest">Password</label>
                            <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-800">Forgot?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <input type="password" name="password" required
                                class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-600 focus:ring-0 outline-none transition-all duration-300 font-medium placeholder:text-slate-300" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#0f172a] text-white font-bold py-4 rounded-2xl hover:bg-blue-600 transform hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-blue-900/10 active:scale-95 uppercase tracking-widest text-sm">
                        Access Account
                    </button>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-slate-500 font-medium">
                        New to the platform? 
                        <a href="<?= base_url('/register') ?>" class="text-blue-600 font-extrabold hover:underline ml-1">Create Account</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>