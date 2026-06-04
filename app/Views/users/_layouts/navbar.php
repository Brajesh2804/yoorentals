<?php
/**
 * 1. PHP LOGIC (Sabse upar): 
 */
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

        <a href="<?= base_url() ?>" class="flex items-center gap-0 group">
            <img src="<?= base_url('assets/admin/images/logo1b.png') ?>" alt="logo"
                class="h-10 w-auto object-contain" />
        </a>

        <div class="hidden md:flex flex-1 mx-12">
            <div class="flex w-full border-2 border-slate-900 rounded-md overflow-hidden bg-white">
                <input type="text" id="liveSearch" onkeyup="handleKeyUp(event)"
                    placeholder="Search Rooms, Cars, Bikes..." class="w-full px-4 py-1.5 outline-none text-slate-700"
                    value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>">

                <button onclick="performSearch()"
                    class="bg-slate-900 text-white px-5 py-2 hover:bg-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <?php if (session()->get('userlogin')): ?>
                <a href="<?= base_url('messages') ?>"
                    class="relative p-2 text-slate-600 hover:bg-slate-50 rounded-full transition-all group">
                    <svg class="w-6 h-6 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <?php if ($unreadCount > 0): ?>
                        <span class="absolute top-1 right-1 flex h-5 w-5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span
                                class="relative inline-flex items-center justify-center rounded-full h-5 w-5 bg-red-600 text-white text-[10px] font-bold border-2 border-white shadow-sm">
                                <?= $unreadCount > 9 ? '9+' : $unreadCount ?>
                            </span>
                        </span>
                    <?php endif; ?>
                </a>

                <div class="relative">
                    <div class="relative">
                        <div class="p-[2px] bg-gradient-to-r from-blue-600 to-green-500 rounded-full shadow-sm">
                            <button onclick="toggleProfileMenu(event)"
                                class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full outline-none">

                                <div
                                    class="w-7 h-7 rounded-full overflow-hidden flex items-center justify-center bg-blue-600 text-white font-bold text-xs">
                                    <?php
                                    $sessionImg = session()->get('image');
                                    // Check agar image session mein hai aur folder mein file exist karti hai
                                    if (!empty($sessionImg) && file_exists('uploads/profile/' . $sessionImg)): ?>
                                        <img src="<?= base_url('uploads/profile/' . $sessionImg) ?>"
                                            class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <?= strtoupper(substr(session()->get('name'), 0, 1)) ?>
                                    <?php endif; ?>
                                </div>

                                <span class="hidden sm:block text-sm font-bold text-slate-800">
                                    Hi, <?= explode(' ', session()->get('name'))[0] ?>
                                </span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="profileDropdown"
                        class="absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-xl py-2 hidden z-50">
                        <a href="<?= base_url('users/profile') ?>"
                            class="block px-4 py-2 text-sm text-slate-600 hover:bg-blue-50 font-semibold">Profile</a>
                        <a href="<?= base_url('users/dashboard') ?>"
                            class="block px-4 py-2 text-sm text-slate-600 hover:bg-blue-50 font-semibold">My Dashboard</a>
                        <div class="border-t border-slate-50 my-1"></div>
                        <a href="<?= base_url('/logout') ?>"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold">Logout</a>
                    </div>
                </div>

            <?php else: ?>
                <a href="<?= base_url('/login') ?>"
                    class="p-[2px] bg-gradient-to-r from-blue-600 to-green-500 rounded-full group transition-transform hover:scale-105">
                    <div class="bg-white px-6 py-1.5 rounded-full">
                        <span
                            class="text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">LOGIN</span>
                    </div>
                </a>
            <?php endif; ?>

            <a href="<?= $sell_target ?>"
                class="relative p-[3px] inline-flex items-center justify-center font-bold overflow-hidden rounded-full group shadow-md transition-transform hover:scale-105 active:scale-95">
                <span
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-600 via-green-500 to-blue-600 animate-[spin_3s_linear_infinite] group-hover:animate-[spin_1.5s_linear_infinite]"></span>
                <span
                    class="relative px-6 py-2 transition-all ease-out bg-white rounded-full group-hover:bg-opacity-0 group-hover:text-white duration-400">
                    <span
                        class="relative flex items-center text-slate-800 font-black group-hover:text-white transition-colors">
                        <span class="mr-1 text-xl"><b>+</span> RENT</b>
                    </span>
                </span>
            </a>
        </div>
    </div>
</nav>

<script>
    // Toggle Profile Dropdown
    function toggleProfileMenu(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    window.addEventListener('click', function (event) {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    });

    // Enter Key Control
    function handleKeyUp(event) {
        if (event.key === "Enter") {
            performSearch();
        } else {
            let grid = document.getElementById('items-container');
            if (grid) {
                searchProduct();
            }
        }
    }

    // Perform Search Logic
    function performSearch() {
        let keyword = document.getElementById('liveSearch').value;
        let grid = document.getElementById('items-container');

        if (!grid) {
            window.location.href = "<?= base_url() ?>?q=" + encodeURIComponent(keyword);
        } else {
            searchProduct();
        }
    }

    // Ajax Search Logic
    function searchProduct() {
        let keyword = document.getElementById('liveSearch').value;
        let productGrid = document.getElementById('items-container');

        if (productGrid) {
            let catText = document.getElementById('current-cat-text');
            if (catText) catText.innerText = "All Categories";

            fetch('<?= base_url('search-ads') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'keyword': keyword,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
                .then(response => response.text())
                .then(data => {
                    productGrid.innerHTML = data;
                })
                .catch(err => console.error("Search Error:", err));
        }
    }
</script>