<?= $this->extend('users/_layouts/master') ?>
<?= $this->section("content") ?>


<?php
$db = \Config\Database::connect(); // Connection pehle check karein

// Ye line active ads fetch karti hai
$ads = $db->table('ads')
    ->select('ads.*, product_categories.slug')
    ->join('product_categories', 'product_categories.category_id = ads.category_id')
    ->where('ads.status', 1)
    ->orderBy('ads.id', 'DESC')
    ->get()
    ->getResult();
?>

<?php
function indian_currency($num)
{
    $num = (string) $num;

    if (strpos($num, '.') !== false) {
        list($num, $decimal) = explode('.', $num);
        $decimal = '.' . $decimal;
    } else {
        $decimal = '';
    }

    $last3 = substr($num, -3);
    $rest = substr($num, 0, -3);

    if ($rest != '') {
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
        return $rest . "," . $last3;
    } else {
        return $last3 . $decimal;
    }
}
?>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .cat-tab {
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
    }

    .cat-tab.active {
        border-bottom: 3px solid #3b82f6;
        color: #3b82f6;
    }

    .cat-tab.active .icon-bg {
        background-color: #eff6ff;
        transform: scale(1.1);
    }

    .item-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: block;
    }

    .slider-img {
        display: none;
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-img.active {
        display: block;
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0.5;
        }

        to {
            opacity: 1;
        }
    }
</style>

<nav class="sticky top-16 z-40 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between gap-6 overflow-x-auto no-scrollbar py-3">
            <div onclick="filterItems('all','All Categories')" id="cat-all"
                class="cat-tab flex flex-col items-center gap-1 cursor-pointer min-w-max px-4 pb-1 group">

                <div class="icon-bg w-10 h-10 flex items-center justify-center text-xl rounded-full transition-all">
                    ✨
                </div>

                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-tight group-hover:text-blue-600">
                    All
                </span>
            </div>

            <!-- All Category -->
            <!-- <div onclick="filterItems('all','All Categories')" id="cat-all"
                class="cat-tab flex flex-col items-center gap-1 cursor-pointer min-w-max px-4 pb-1 group">

                <div class="icon-bg w-10 h-10 flex items-center justify-center text-xl rounded-full transition-all">
                    ✨
                </div>

                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-tight group-hover:text-blue-600">
                    All
                </span>
            </div> -->

            <?php foreach ($categories as $c): ?>

                <div onclick="filterItems('<?= strtolower($c->slug) ?>','<?= esc($c->category_name) ?>')"
                    id="cat-<?= strtolower($c->slug) ?>"
                    class="cat-tab flex flex-col items-center gap-1 cursor-pointer min-w-max px-4 pb-1 group">

                    <div class="icon-bg w-10 h-10 flex items-center justify-center text-xl rounded-full transition-all">
                        <?= $c->icon ?>
                    </div>

                    <span class="text-[11px] font-bold text-gray-500 uppercase tracking-tight group-hover:text-blue-600">
                        <?= esc($c->category_name) ?>
                    </span>

                </div>

            <?php endforeach; ?>
        </div>
    </div>
</nav>

<section class="bg-gray-50 py-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-8 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Showing: <span id="current-cat-text" class="text-blue-600">All
                    Categories</span></h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="items-container">
            <?php if (!empty($ads)): ?>
                <?php foreach ($ads as $item):
                    $imgs = explode(',', $item->images);
                    $i1 = !empty($imgs[0]) ? base_url('uploads/ads/' . $imgs[0]) : 'https://placehold.co/500x350?text=No+Image';
                    $i2 = !empty($imgs[1]) ? base_url('uploads/ads/' . $imgs[1]) : $i1;
                    ?>
                    <div class="item-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden group"
                        data-category="<?= strtolower($item->slug ?? '') ?>">

                        <a href="<?= base_url('items/details/' . $item->id) ?>" class="relative block h-48 overflow-hidden"
                            onmouseenter="startSlider(this)" onmouseleave="stopSlider(this)">

                            <img src="<?= $i1 ?>" class="slider-img active">
                            <img src="<?= $i2 ?>" class="slider-img">

                            <div
                                class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2 py-0.5 rounded text-[10px] font-bold text-blue-600 shadow-sm uppercase">
                                Verified
                            </div>

                            <div
                                class="absolute bottom-3 left-3 bg-gray-900/80 backdrop-blur text-white px-3 py-1 rounded-lg font-bold text-sm">
                                ₹<?= indian_currency($item->price) ?>
                            </div>

                        </a>

                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 text-sm mb-1 truncate"><?= $item->title ?></h3>
                            <div class="flex items-center gap-1 text-gray-400 text-xs mb-3">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        stroke-width="2" />
                                </svg>
                                <?= $item->location ?>
                            </div>
                            <a href="<?= base_url('items/details/' . $item->id) ?>"
                                class="block text-center w-full py-2 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 text-gray-400 font-bold">No ads found.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    function filterItems(categoryId, categoryName) {
        // 1. Sabse pehle agar search bar mein kuch likha hai toh use clear karo
        const searchInput = document.getElementById('liveSearch');
        if (searchInput && searchInput.value !== '') {
            searchInput.value = '';
            // Saare products wapas mangwao (kyunki search ne products kam kar diye honge)
            if (typeof searchProduct === "function") {
                searchProduct();
            }
        }

        // 2. UI Update (Tabs and Text)
        document.getElementById('current-cat-text').innerText = categoryName;
        document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));

        const activeTab = document.getElementById('cat-' + categoryId.toLowerCase());
        if (activeTab) activeTab.classList.add('active');

        // 3. Filtering Logic (Thoda delay taaki data refresh ho sake)
        setTimeout(() => {
            const cards = document.querySelectorAll('.item-card');
            cards.forEach(card => {
                const cardCat = card.getAttribute('data-category').toLowerCase();
                if (categoryId === 'all' || cardCat === categoryId.toLowerCase()) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }, 100);
    }

    // Slider logic (Isme koi badlav nahi hai)
    let slideTimer;
    function startSlider(el) {
        const imgs = el.querySelectorAll('.slider-img');
        if (imgs.length < 2) return;
        let idx = 0;
        slideTimer = setInterval(() => {
            imgs[idx].classList.remove('active');
            idx = (idx + 1) % imgs.length;
            imgs[idx].classList.add('active');
        }, 1200);
    }
    function stopSlider(el) {
        clearInterval(slideTimer);
        const imgs = el.querySelectorAll('.slider-img');
        imgs.forEach((img, i) => {
            img.classList.remove('active');
            if (i === 0) img.classList.add('active');
        });
    }

    window.onload = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const cat = urlParams.get('cat');

        if (cat) {
            // category aayi hai URL se
            const activeTab = document.getElementById('cat-' + cat);
            if (activeTab) {
                activeTab.click(); // same function use ho jayega
            }
        } else if (!urlParams.has('q')) {
            filterItems('all', 'All Categories');
        }
    };
</script>

<?= $this->endSection() ?>