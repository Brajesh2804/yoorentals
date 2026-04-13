<?= $this->extend("_layout/master") ?>
<?= $this->section("content") ?>

<?php
$db = \Config\Database::connect();
$my_id = session()->get('id');

// Sirf login owner ke ads fetch karna
$my_ads = $db->table('ads')
    ->where('owner_id', $my_id)
    ->orderBy('id', 'DESC')
    ->get()->getResult();

$total_ads = count($my_ads);

$my_ads = $db->table('ads')
    ->where('owner_id', $my_id)
    ->where('status', 1) // Sirf active ads dashboard me dikhegi
    ->orderBy('id', 'DESC')
    ->get()->getResult();

?>

<div class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900">My Dashboard</h1>
                <p class="text-slate-500 font-medium">Manage your listed properties and items</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Ads</p>
                        <h3 class="text-xl font-black text-slate-800"><?= $total_ads ?></h3>
                    </div>
                </div>
                <a href="<?= base_url('properties/category') ?>"
                    class="bg-slate-900 text-white px-6 py-4 rounded-2xl font-bold hover:bg-blue-600 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Post New Ad
                </a>
            </div>
        </div>

        <?php if ($total_ads > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($my_ads as $ad): ?>
                    <?php
                    $imgs = explode(',', $ad->images);
                    $display_img = !empty($imgs[0]) ? base_url('uploads/ads/' . $imgs[0]) : 'https://placehold.co/400x300?text=No+Image';
                    ?>
                    <div
                        class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="relative h-56 overflow-hidden">
                            <img src="<?= $display_img ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-slate-900 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm">
                                    <?= $ad->category ?>
                                </span>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <div class="bg-blue-600 text-white px-4 py-1.5 rounded-xl font-black shadow-lg">
                                    ₹<?= number_format($ad->price) ?>
                                </div>
                            </div>
                        </div>

                        <div class="p-5">
                            <h2 class="text-lg font-bold text-slate-800 line-clamp-1 mb-1"><?= $ad->title ?></h2>
                            <p class="text-slate-400 text-sm flex items-center gap-1 mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        stroke-width="2" />
                                </svg>
                                <?= $ad->location ?>
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Status</span>
                                    <span class="text-green-500 text-xs font-bold flex items-center gap-1">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Active
                                    </span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="<?= base_url('items/details/' . $ad->id) ?>"
                                        class="p-2.5 bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all shadow-sm border border-slate-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                            <path
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                stroke-width="2" />
                                        </svg>
                                    </a>
                                    <a href="<?= base_url('items/delete_ad/' . $ad->id) ?>"
                                        onclick="return confirm('Are you sure you want to delete this ad?')"
                                        class="p-2.5 bg-slate-50 text-red-400 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all border border-slate-100">
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
            <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800">No Ads Found</h3>
                <p class="text-slate-500 mb-6">You haven't posted any items or properties yet.</p>
                <a href="<?= base_url('properties/category') ?>"
                    class="inline-block bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-slate-900 transition-all shadow-lg">Start
                    Selling Now</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>