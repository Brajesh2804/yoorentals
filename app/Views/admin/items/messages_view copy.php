<?= $this->extend("_layout/master") ?>
<?= $this->section("content") ?>

<div class="bg-slate-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div
            class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden flex flex-col md:flex-row h-[80vh]">

            <div class="w-full md:w-80 border-r bg-slate-50 overflow-y-auto">
                <div class="p-5 bg-white border-b sticky top-0 z-10">
                    <h2 class="text-xl font-black text-slate-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        My Inbox
                    </h2>
                </div>

                <div class="divide-y divide-slate-100">
                    <?php if (!empty($chat_list)):
                        // Logical sorting: Pehle unread messages, phir time ke hisaab se
                        usort($chat_list, function ($a, $b) {
                            if ($a->unread_count != $b->unread_count) {
                                return $b->unread_count <=> $a->unread_count;
                            }
                            return strtotime($b->last_time) <=> strtotime($a->last_time);
                        });

                        foreach ($chat_list as $chat):
                            // Indication ke liye checks
                            $isUnread = (isset($chat->unread_count) && $chat->unread_count > 0);
                            $isActive = (isset($active_ad) && $active_ad == $chat->ad_id && $other_user->id == $chat->other_user_id);
                            ?>
                            <a href="<?= base_url('messages/chat/' . $chat->ad_id . '/' . $chat->other_user_id) ?>"
                                class="flex items-center gap-3 p-4 hover:bg-blue-50 transition-all relative <?= $isActive ? 'bg-blue-100 border-l-4 border-blue-600' : ($isUnread ? 'bg-blue-50/80 shadow-[inset_4px_0_0_0_#2563eb]' : '') ?>">

                                <div class="relative">
                                    <div
                                        class="w-12 h-12 <?= $isUnread ? 'bg-blue-700' : 'bg-slate-400' ?> rounded-full flex-shrink-0 flex items-center justify-center text-white font-bold shadow-sm transition-colors">
                                        <?= strtoupper(substr($chat->user_name, 0, 1)) ?>
                                    </div>
                                    <?php if ($isUnread): ?>
                                        <span class="absolute -top-1 -right-1 flex h-4 w-4">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-4 w-4 bg-blue-600 border-2 border-white"></span>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <h3
                                            class="font-bold <?= $isUnread ? 'text-slate-900 text-sm' : 'text-slate-600 text-sm' ?> truncate">
                                            <?= $chat->user_name ?>
                                        </h3>
                                        <span
                                            class="text-[10px] <?= $isUnread ? 'text-blue-600 font-black' : 'text-slate-400 font-bold' ?>">
                                            <?= date('h:i A', strtotime($chat->last_time)) ?>
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-blue-600 font-bold truncate">Ad: <?= $chat->ad_title ?></p>
                                    <div class="flex justify-between items-center gap-2">
                                        <p
                                            class="text-xs <?= $isUnread ? 'text-slate-900 font-bold' : 'text-slate-500' ?> truncate flex-1">
                                            <?= esc($chat->last_msg) ?>
                                        </p>
                                        <?php if ($isUnread): ?>
                                            <span
                                                class="bg-blue-600 text-white text-[9px] px-1.5 py-0.5 rounded-full font-black min-w-[18px] text-center">
                                                <?= $chat->unread_count ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; else: ?>
                        <div class="p-10 text-center text-slate-400 text-sm font-bold italic">No conversations found.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex-1 flex flex-col bg-white">
                <?php if (isset($active_chat) && $active_chat == true): ?>
                    <div class="p-4 border-b flex items-center justify-between bg-white shadow-sm">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold border shadow-inner">
                                <?= strtoupper(substr($other_user->name, 0, 1)) ?>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 leading-none"><?= $other_user->name ?></h3>
                                <span class="text-[10px] text-blue-600 font-bold uppercase tracking-widest">Item:
                                    <?= $ad_title ?></span>
                            </div>
                        </div>
                    </div>

                    <div id="inbox-chat-container" class="flex-1 overflow-y-auto p-6 space-y-4 bg-[#f8fafc]">
                        <?php foreach ($messages as $m):
                            $isMine = ($m->sender_id == session()->get('id'));
                            ?>
                            <div class="flex <?= $isMine ? 'justify-end' : 'justify-start' ?>">
                                <div
                                    class="<?= $isMine ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-white border-slate-200 rounded-tl-none text-slate-800' ?> p-3 rounded-2xl max-w-[75%] shadow-sm border relative">
                                    <p class="text-sm leading-relaxed"><?= esc($m->message) ?></p>
                                    <div class="flex items-center justify-end gap-1 mt-1">
                                        <span
                                            class="text-[9px] <?= $isMine ? 'text-blue-100' : 'text-slate-400' ?> font-bold uppercase">
                                            <?= date('h:i A', strtotime($m->created_at)) ?>
                                        </span>
                                        <?php if ($isMine): ?>
                                            <svg class="w-3 h-3 <?= $m->is_read ? 'text-green-300' : 'text-blue-300' ?>" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 12l2.5 2.5L10 10M13 12l2.5 2.5L19 10" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="p-4 bg-white border-t">
                        <div class="flex items-center gap-2">
                            <textarea id="replyText" rows="1"
                                class="flex-1 border-2 border-slate-100 p-3 rounded-xl focus:border-blue-500 outline-none transition-all resize-none bg-slate-50"
                                placeholder="Type your reply to deal..."></textarea>
                            <button onclick="sendReply()"
                                class="p-3 bg-blue-600 text-white rounded-xl hover:bg-slate-900 transition-all shadow-lg active:scale-95">
                                <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex-1 flex flex-col items-center justify-center text-slate-400 p-10 text-center">
                        <div
                            class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6 border-2 border-dashed border-blue-200">
                            <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-700">Deal Station</h2>
                        <p class="text-sm mt-2 max-w-xs font-medium">Select a customer with a <span
                                class="text-blue-600">Blue Dot</span> to check new inquiries.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const chatContainer = document.getElementById('inbox-chat-container');
    if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;

    function sendReply() {
        const input = document.getElementById('replyText');
        const message = input.value.trim();
        if (!message) return;

        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const html = `<div class="flex justify-end"><div class="bg-blue-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[75%] shadow-sm border relative"><p class="text-sm">${message}</p><div class="flex items-center justify-end gap-1 mt-1"><span class="text-[9px] text-blue-100 font-bold uppercase">${time}</span><svg class="w-3 h-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div>`;

        chatContainer.insertAdjacentHTML('beforeend', html);
        input.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;

        fetch('<?= base_url('send-message') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
            body: new URLSearchParams({
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                'ad_id': '<?= $active_ad ?? 0 ?>',
                'receiver_id': '<?= $other_user->id ?? 0 ?>',
                'message': message
            })
        });
    }

    // Enter key to send
    document.getElementById('replyText')?.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendReply();
        }
    });
</script>

<?= $this->endSection() ?>