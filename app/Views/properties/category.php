<?= $this->extend("_layout/master") ?>
<?= $this->section("content") ?>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Post Your Ad</h1>
            <p class="text-slate-500 mt-2 font-medium">Choose a category to start selling your product or service</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php
            $cats = [
                ['n' => 'Rooms', 'i' => '🏠', 'slug' => 'rooms'],
                ['n' => 'Cars', 'i' => '🚗', 'slug' => 'cars'],
                ['n' => 'Halls', 'i' => '🎊', 'slug' => 'halls'],
                // ['n' => 'Jobs', 'i' => '💼', 'slug' => 'jobs'],
                ['n' => 'Bikes', 'i' => '🏍️', 'slug' => 'bikes'],
                ['n' => 'Offices', 'i' => '🏢', 'slug' => 'offices'],
                ['n' => 'PG/Hostel', 'i' => '🛌', 'slug' => 'pg/hostel'],
                ['n' => 'Furniture', 'i' => '🛋️', 'slug' => 'furniture'],
                // ['n' => 'Electronics', 'i' => '💻', 'slug' => 'electronics'],
                // ['n' => 'Fashion', 'i' => '👕', 'slug' => 'fashion'],
                // ['n' => 'Pets', 'i' => '🐶', 'slug' => 'pets'],
                // ['n' => 'Services', 'i' => '🛠️', 'slug' => 'services'],
            ];
            foreach ($cats as $c): ?>
                <a href="<?= base_url('properties/post-ad/' . $c['slug']) ?>"
                    class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-blue-500 hover:shadow-md transition-all flex flex-col items-center gap-3 text-center">
                    <span class="text-4xl group-hover:scale-110 transition-transform"><?= $c['i'] ?></span>
                    <span class="text-sm font-bold text-slate-700 group-hover:text-blue-600"><?= $c['n'] ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 p-6 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-between">
            <div>
                <h4 class="font-bold text-blue-900">Confused about category?</h4>
                <p class="text-sm text-blue-700">Contact our support team for quick help.</p>
            </div>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold text-sm">Help Me</button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>