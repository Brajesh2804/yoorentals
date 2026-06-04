<?= $this->extend("users/_layouts/master") ?>
<?= $this->section("content") ?>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<?php
$db = \Config\Database::connect();
$my_id = session()->get('id');

// Total ads count
$total_ads_count = $db->table('ads')->where('owner_id', $my_id)->countAllResults();

// Active ads for display
$my_ads = $db->table('ads')
    ->where('owner_id', $my_id)
    ->where('status', 1)
    ->orderBy('id', 'DESC')
    ->get()->getResult();

// User details fetch karna image ke liye
$user = $db->table('users')->where('id', $my_id)->get()->getRow();
?>

<div class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-1/4">
                <div>
                    <h1 class="text-3xl font-black text-slate-900">My Dashboard</h1>
                    <p class="text-slate-500 font-medium italic">Manage your listings effortlessly</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm sticky top-8">
                    <div class="flex items-center gap-4 mb-8 px-2 border-b border-slate-50 pb-6">

                        <?php if (!empty($user->image) && file_exists('uploads/users/' . $user->image)): ?>
                            <img src="<?= base_url('uploads/users/' . $user->image) ?>"
                                class="w-14 h-14 rounded-2xl object-cover shadow-inner border border-slate-100">
                        <?php else: ?>
                            <div
                                class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-inner">
                                <?= substr(session()->get('name') ?? 'U', 0, 1) ?>
                            </div>
                        <?php endif; ?>

                        <div>
                            <h2 class="font-bold text-slate-800 text-lg leading-tight"><?= session()->get('name') ?>
                            </h2>
                            <p class="text-xs text-green-500 font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Verified User
                            </p>
                        </div>
                    </div>

                    <nav class="space-y-2">
                        <a href="<?= base_url('users/dashboard') ?>"
                            class="flex items-center gap-3 px-4 py-3.5 bg-blue-50 text-blue-600 rounded-2xl font-bold transition-all group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                    stroke-width="2" />
                            </svg>
                            My Ads
                        </a>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                class="w-full flex items-center justify-between px-4 py-3.5 bg-blue-50 text-blue-600 rounded-2xl font-bold transition-all group">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Post New Ad
                                </div>
                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak x-transition
                                class="absolute left-0 w-full mt-2 bg-white border border-slate-100 rounded-2xl shadow-xl z-50 overflow-hidden">
                                <div class="p-2">
                                    <?php
                                    $cats = [
                                        ['n' => 'Rooms', 'i' => '🏠', 'slug' => 'rooms'],
                                        ['n' => 'Cars', 'i' => '🚗', 'slug' => 'cars'],
                                        ['n' => 'Halls', 'i' => '🎊', 'slug' => 'halls'],
                                        ['n' => 'Bikes', 'i' => '🏍️', 'slug' => 'bikes'],
                                        ['n' => 'Offices', 'i' => '🏢', 'slug' => 'offices'],
                                        ['n' => 'PG/Hostel', 'i' => '🛌', 'slug' => 'pg/hostel'],
                                        ['n' => 'Furniture', 'i' => '🛋️', 'slug' => 'furniture'],
                                    ];
                                    foreach ($cats as $c): ?>
                                        <a href="<?= base_url('properties/post-ad/' . $c['slug']) ?>"
                                            class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-blue-50 transition-colors text-sm font-bold text-slate-700">
                                            <span><?= $c['i'] ?></span> <?= $c['n'] ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <a href="<?= base_url('users/profile') ?>"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-blue-50 transition-colors text-sm font-bold text-slate-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    stroke-width="2" />
                            </svg>
                            Profile Settings
                        </a>
                        <a href="<?= base_url('/logout') ?>"
                            class="flex items-center gap-3 px-4 py-3.5 text-red-400 hover:bg-red-50 rounded-2xl font-semibold transition-all mt-4 border-t border-slate-50 pt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                    stroke-width="2" />
                            </svg>
                            Logout
                        </a>
                    </nav>
                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div></div>
                    <div class="flex justify-end w-full">
                        <div
                            class="bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Active
                                    Ads</p>
                                <h3 class="text-xl font-black text-slate-800"><?= $total_ads_count ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($total_ads_count > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach ($my_ads as $ad): ?>
                            <?php
                            $imgs = explode(',', $ad->images);
                            $display_img = !empty($imgs[0]) ? base_url('uploads/ads/' . $imgs[0]) : 'https://placehold.co/400x300?text=No+Image';
                            ?>
                            <div
                                class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                                <div class="relative h-52 overflow-hidden">
                                    <img src="<?= $display_img ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-white/90 backdrop-blur-sm text-slate-900 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm"><?= $ad->category ?></span>
                                    </div>
                                    <div class="absolute bottom-4 right-4">
                                        <div class="bg-blue-600 text-white px-4 py-1.5 rounded-xl font-black shadow-lg">
                                            ₹<?= number_format($ad->price) ?></div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h2
                                        class="text-lg font-bold text-slate-800 line-clamp-1 mb-1 group-hover:text-blue-600 transition-colors">
                                        <?= $ad->title ?>
                                    </h2>
                                    <p class="text-slate-400 text-sm flex items-center gap-1 mb-4 italic">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                stroke-width="2" />
                                        </svg>
                                        <?= $ad->location ?>
                                    </p>
                                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Current
                                                Status</span>
                                            <span class="text-green-500 text-xs font-bold flex items-center gap-1">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Active
                                            </span>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="<?= base_url('items/details/' . $ad->id) ?>"
                                                class="p-2.5 bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 border border-slate-100 shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                                    <path
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                        stroke-width="2" />
                                                </svg>
                                            </a>
                                            <a href="<?= base_url('items/delete_ad/' . $ad->id) ?>"
                                                onclick="return confirm('Pakka delete karna hai?')"
                                                class="p-2.5 bg-slate-50 text-red-400 rounded-xl hover:bg-red-50 border border-slate-100">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-3xl p-16 text-center border-2 border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800">Empty Dashboard</h3>
                        <p class="text-slate-500 mb-8 max-w-xs mx-auto">Looks like you haven't posted anything yet.</p>
                        <a href="<?= base_url('properties/category') ?>"
                            class="inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl">Post
                            Your First Ad</a>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</div>

<?= $this->endSection() ?>