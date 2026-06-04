<?= $this->extend("users/_layouts/master") ?>
<?= $this->section("content") ?>

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
        return $rest . "," . $last3 . $decimal;
    } else {
        return $last3 . $decimal;
    }
}
?>

<style>
    .zoom-container {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    #mainImage {
        transition: opacity 0.4s ease-in-out, transform 0.3s ease;
        transform-origin: center center;
    }

    .zoomed {
        transform: scale(2.5) !important;
        cursor: zoom-out;
    }

    .thumb-active {
        border: 2px solid #2563eb !important;
        opacity: 1 !important;
        transform: scale(1.05);
    }

    .fade-out {
        opacity: 0;
    }
</style>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-3xl shadow-sm border">

            <div>
                <?php $imgs = explode(',', $ad->images); ?>
                <div class="rounded-2xl overflow-hidden mb-4 h-96 bg-gray-100 zoom-container"
                    ondblclick="toggleZoom(this)" onmousemove="moveZoom(event)">
                    <img src="<?= base_url('uploads/ads/' . $imgs[0]) ?>" class="w-full h-full object-cover"
                        id="mainImage">
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <?php foreach ($imgs as $index => $img): ?>
                        <img src="<?= base_url('uploads/ads/' . $img) ?>" onclick="manualChange(this.src, <?= $index ?>)"
                            class="thumb-img h-20 w-full object-cover rounded-lg cursor-pointer opacity-60 border-2 border-transparent transition-all">
                    <?php endforeach; ?>
                </div>
                <p class="text-[10px] text-slate-400 mt-2 text-center font-bold uppercase">Double Click to Zoom / Double
                    Click to Reset</p>
            </div>

            <div class="space-y-6">
                <div>
                    <span
                        class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"><?= $ad->category ?></span>
                    <h1 class="text-3xl font-black text-slate-900 mt-2"><?= $ad->title ?></h1>
                    <p class="text-slate-400 flex items-center gap-1 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                stroke-width="2" />
                        </svg>
                        <?= $ad->location ?>
                    </p>
                </div>

                <div class="bg-slate-50 p-6 rounded-2xl border-2 border-dashed border-blue-200">
                    <span class="text-slate-500 font-bold uppercase text-xs">Price</span>
                    <div class="text-4xl font-black text-blue-600">₹<?= indian_currency($ad->price) ?></div>
                </div>

                <div>
                    <h3 class="font-bold text-slate-800 mb-2 uppercase text-sm tracking-widest">Description</h3>
                    <p
                        class="text-slate-600 text-sm leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100 ">
                        <?= nl2br(esc($ad->description)) ?>
                    </p>
                </div>

                <div class="mt-8 border-t pt-6">
                    <div class="flex items-center gap-4 mb-6 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <div class="relative">
                            <?php if (!empty($ad->owner_photo)): ?>
                                <img src="<?= base_url('uploads/profiles/' . $ad->owner_photo) ?>"
                                    class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                            <?php else: ?>
                                <div
                                    class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-md">
                                    <?= strtoupper(substr($ad->owner_name ?? 'U', 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <span
                                class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Property Owner</p>
                            <h4 class="text-lg font-black text-slate-800 leading-tight">
                                <?= $ad->owner_name ?? 'Unknown Owner' ?>
                            </h4>
                        </div>
                    </div>

                    <div id="chat-container"
                        class="space-y-4 mb-4 max-h-80 overflow-y-auto p-3 bg-slate-50 rounded-2xl border border-slate-100">
                        <?php
                        $db = \Config\Database::connect();
                        $my_id = session()->get('id');
                        $owner_id = isset($ad->owner_id) ? $ad->owner_id : (isset($ad->user_id) ? $ad->user_id : '0');

                        if ($my_id):
                            $messages = $db->table('messages')
                                ->whereIn('sender_id', [$my_id, $owner_id])
                                ->whereIn('receiver_id', [$my_id, $owner_id])
                                ->where('ad_id', $ad->id)
                                ->orderBy('id', 'ASC')
                                ->get()->getResult();

                            foreach ($messages as $m):
                                $isMine = ($m->sender_id == $my_id);
                                ?>
                                <div class="flex <?= $isMine ? 'justify-end' : 'justify-start' ?>">
                                    <div
                                        class="<?= $isMine ? 'bg-green-100 border-green-200 rounded-tr-none' : 'bg-white border-slate-200 rounded-tl-none' ?> text-slate-800 p-3 rounded-2xl max-w-[85%] shadow-sm relative border">
                                        <p class="text-sm"><?= esc($m->message) ?></p>
                                        <div class="flex items-center justify-end gap-1 mt-1">
                                            <span
                                                class="text-[9px] text-slate-500 uppercase"><?= date('h:i A', strtotime($m->created_at)) ?></span>
                                            <?php if ($isMine): ?>
                                                <svg class="w-3 h-3 <?= $m->is_read ? 'text-blue-500' : 'text-slate-400' ?>"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M3 12l2.5 2.5L10 10M13 12l2.5 2.5L19 10" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if (empty($messages)): ?>
                                <p class="text-center text-slate-400 text-xs py-4 italic">No messages yet. Start the
                                    conversation with the owner!</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (session()->get('userlogin')): ?>
                        <div class="relative">
                            <textarea id="messageText" rows="2" onkeydown="handleEnter(event)"
                                class="w-full border-2 p-3 pr-12 rounded-2xl focus:border-blue-500 outline-none transition-all resize-none bg-white"
                                placeholder="Type a message to the owner..."></textarea>
                            <button onclick="sendMessage()"
                                class="absolute right-3 bottom-3 p-2 bg-blue-600 text-white rounded-full hover:bg-slate-900 transition-all shadow-lg">

                                <svg class="w-5 h-5 -rotate-90" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                </svg>

                            </button>
                        </div>
                    <?php else: ?>
                        <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl text-center">
                            <p class="text-sm font-bold text-slate-600 mb-3">Please login to chat with the owner.</p>
                            <a href="<?= base_url('login') ?>"
                                class="inline-block px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition">Login
                                Now</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const images = <?= json_encode(array_map(function ($i) {
        return base_url('uploads/ads/' . $i);
    }, $imgs)) ?>;
    let currentIndex = 0;
    let slideInterval;
    let isZoomed = false;

    function updateView(src, index) {
        const mainImg = document.getElementById('mainImage');
        mainImg.classList.add('fade-out');
        setTimeout(() => {
            mainImg.src = src;
            mainImg.classList.remove('fade-out');
            document.querySelectorAll('.thumb-img').forEach((t, i) => {
                i === index ? t.classList.add('thumb-active') : t.classList.remove('thumb-active');
            });
        }, 300);
    }

    function startAutoSlide() {
        if (images.length > 1) {
            slideInterval = setInterval(() => {
                if (!isZoomed) {
                    currentIndex = (currentIndex + 1) % images.length;
                    updateView(images[currentIndex], currentIndex);
                }
            }, 3500);
        }
    }

    function manualChange(src, index) {
        clearInterval(slideInterval);
        currentIndex = index;
        updateView(src, index);
        startAutoSlide();
    }

    function toggleZoom(container) {
        const img = document.getElementById('mainImage');
        isZoomed = !isZoomed;
        img.classList.toggle('zoomed');
        if (!isZoomed) img.style.transform = "scale(1)";
    }

    function moveZoom(e) {
        if (!isZoomed) return;
        const img = document.getElementById('mainImage');
        const container = e.currentTarget;
        const x = e.clientX - container.getBoundingClientRect().left;
        const y = e.clientY - container.getBoundingClientRect().top;
        img.style.transformOrigin = `${(x / container.offsetWidth) * 100}% ${(y / container.offsetHeight) * 100}%`;
    }

    // Chat Functions
    const chatBox = document.getElementById('chat-container');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    // ENTER KEY LOGIC
    function handleEnter(e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    }

    function sendMessage() {
        const msgInput = document.getElementById('messageText');
        const message = msgInput.value.trim();
        if (!message) return;

        const now = new Date();
        const time = now.toLocaleString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });

        const msgHtml = `<div class="flex justify-end"><div class="bg-blue-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[85%] shadow-sm border border-blue-700"><p class="text-sm">${message}</p><div class="text-[9px] text-right mt-1 opacity-70">${time}</div></div></div>`;

        chatBox.insertAdjacentHTML('beforeend', msgHtml);
        msgInput.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        fetch('<?= base_url('send-message') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
            body: new URLSearchParams({
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                'ad_id': '<?= $ad->id ?>',
                'receiver_id': '<?= $owner_id ?>',
                'message': message
            })
        });
    }

    window.onload = () => { updateView(images[0], 0); startAutoSlide(); };
</script>

<?= $this->endSection() ?>