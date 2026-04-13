<?php
$db = \Config\Database::connect();
$my_session_id = session()->get('id');
$unreadCount = 0;

if ($my_session_id) {
    $unreadCount = $db->table('messages')
        ->where('receiver_id', $my_session_id)
        ->where('is_read', 0)
        ->countAllResults();
}

$sell_target = session()->get('userlogin') ? base_url('properties/category') : base_url('/login');
?>

<nav class="bg-white shadow-sm border-b sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">

        <!-- Logo -->
        <a href="<?= base_url() ?>" class="flex items-center gap-0 group">
            <img src="<?= base_url('assets/admin/images/logo1b.png') ?>" alt="logo"
                class="h-10 w-auto object-contain" />
        </a>

        <!-- Search (Desktop only - SAME) -->
        <div class="hidden md:flex flex-1 mx-12">
            <div class="flex w-full border-2 border-slate-900 rounded-md overflow-hidden bg-white">
                <input type="text" id="liveSearch" onkeyup="handleKeyUp(event)"
                    placeholder="Search Rooms, Cars, Bikes..."
                    class="w-full px-4 py-1.5 outline-none text-slate-700"
                    value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>">

                <button onclick="performSearch()"
                    class="bg-slate-900 text-white px-5 py-2 hover:bg-blue-600 transition-colors">
                    🔍
                </button>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-4">

            <!-- ✅ Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="md:hidden p-2">
                ☰
            </button>

            <?php if (session()->get('userlogin')): ?>

                <!-- Messages -->
                <a href="<?= base_url('messages') ?>"
                    class="relative p-2 text-slate-600 hover:bg-slate-50 rounded-full transition-all group">

                    🔔

                    <?php if ($unreadCount > 0): ?>
                        <span class="absolute top-1 right-1 flex h-5 w-5">
                            <span class="relative inline-flex items-center justify-center rounded-full h-5 w-5 bg-red-600 text-white text-[10px] font-bold">
                                <?= $unreadCount > 9 ? '9+' : $unreadCount ?>
                            </span>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- Profile -->
                <div class="relative">
                    <button onclick="toggleProfileMenu(event)"
                        class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full">
                        <div class="w-7 h-7 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs">
                            <?= strtoupper(substr(session()->get('name'), 0, 1)) ?>
                        </div>
                        <span class="hidden sm:block text-sm font-bold">
                            Hi, <?= explode(' ', session()->get('name'))[0] ?>
                        </span>
                    </button>

                    <div id="profileDropdown"
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-xl py-2 hidden z-50">
                        <a href="<?= base_url('admin/profile') ?>" class="block px-4 py-2">Profile</a>
                        <a href="<?= base_url('admin/dashboard') ?>" class="block px-4 py-2">Dashboard</a>
                        <a href="<?= base_url('/logout') ?>" class="block px-4 py-2 text-red-600">Logout</a>
                    </div>
                </div>

            <?php else: ?>

                <!-- Login -->
                <a href="<?= base_url('/login') ?>" class="px-4 py-1 border rounded-full">
                    LOGIN
                </a>

            <?php endif; ?>

            <!-- Rent Button -->
            <a href="<?= $sell_target ?>" class="px-4 py-2 bg-blue-600 text-white rounded-full">
                + RENT
            </a>

        </div>
    </div>
</nav>

<!-- ✅ Mobile Menu (NEW ONLY) -->
<div id="mobileMenu" class="hidden md:hidden bg-white border-t p-4 space-y-4">

    <!-- Mobile Search -->
    <input type="text"
        placeholder="Search..."
        class="w-full border px-3 py-2 rounded-md">

    <?php if (session()->get('userlogin')): ?>
        <a href="<?= base_url('messages') ?>" class="block">Messages</a>
        <a href="<?= base_url('admin/profile') ?>" class="block">Profile</a>
        <a href="<?= base_url('admin/dashboard') ?>" class="block">Dashboard</a>
        <a href="<?= base_url('/logout') ?>" class="block text-red-600">Logout</a>
    <?php else: ?>
        <a href="<?= base_url('/login') ?>" class="block">Login</a>
    <?php endif; ?>

    <a href="<?= $sell_target ?>" class="block text-center bg-blue-600 text-white py-2 rounded">
        + RENT
    </a>
</div>

<script>
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}

function toggleProfileMenu(e) {
    e.stopPropagation();
    document.getElementById('profileDropdown').classList.toggle('hidden');
}

window.addEventListener('click', function () {
    let dropdown = document.getElementById('profileDropdown');
    if (dropdown) dropdown.classList.add('hidden');
});
</script>