
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script>
    function enableEditing() {
        const inputs = document.querySelectorAll('.profile-input');
        const saveBtn = document.getElementById('save-btn');
        const editBtn = document.getElementById('edit-trigger-btn');

        inputs.forEach(input => {
            input.removeAttribute('readonly');
            input.classList.remove('bg-slate-100', 'cursor-not-allowed');
            input.classList.add('bg-white', 'border-blue-500');
        });

        saveBtn.classList.remove('hidden');
        editBtn.classList.add('hidden');
    }
</script>

<div class="min-h-screen bg-[#f8fafc] py-12 px-4">
    <div class="max-w-5xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Account Settings</h1>
                <p class="text-slate-500 mt-1">Manage your personal information and security preferences.</p>
            </div>
            <button type="button" onclick="enableEditing()" id="edit-trigger-btn"
                class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 font-bold rounded-2xl hover:bg-slate-50 shadow-sm transition-all">
                <i class="fas fa-edit text-blue-600"></i> EDIT PROFILE
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-4 space-y-6">
                <div
                    class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                    <div class="relative mt-4">
                        <div class="w-28 h-28 bg-white p-1.5 rounded-full mx-auto shadow-lg">
                            <div
                                class="w-full h-full bg-slate-100 rounded-full flex items-center justify-center text-3xl font-black text-blue-600">
                                <?= strtoupper(substr($user->name, 0, 1)) ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-xl font-black text-slate-800 uppercase"><?= esc($user->name) ?></h2>
                        <p class="text-sm font-medium text-slate-400">Customer ID: <span
                                class="text-slate-900 font-bold">#<?= $user->id ?></span></p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-50 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500 font-medium">Joined Date</span>
                            <span class="text-slate-800 font-bold"><?= $joinedDate ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500 font-medium">Total Rents</span>
                            <span class="text-slate-800 font-bold"><?= $totalRents ?> Orders</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-8 md:p-10">
                    <form action="<?= base_url('admin/updateProfile') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="flex items-center gap-2 mb-8">
                            <div class="h-6 w-1.5 bg-blue-600 rounded-full"></div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">General Information
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Full
                                    Name</label>
                                <input type="text" name="name" value="<?= esc($user->name) ?>" readonly
                                    class="profile-input w-full px-4 py-3.5 bg-slate-100 border border-slate-200 rounded-2xl outline-none transition-all font-semibold text-slate-700 cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Email
                                    Address</label>
                                <input type="email" name="email" value="<?= esc($user->email) ?>" readonly
                                    class="profile-input w-full px-4 py-3.5 bg-slate-100 border border-slate-200 rounded-2xl outline-none transition-all font-semibold text-slate-700 cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Phone
                                    Number</label>
                                <input type="text" name="phone" value="<?= esc($user->phone ?? '') ?>" readonly
                                    class="profile-input w-full px-4 py-3.5 bg-slate-100 border border-slate-200 rounded-2xl outline-none transition-all font-semibold text-slate-700 cursor-not-allowed"
                                    placeholder="Add phone number">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Account
                                    ID</label>
                                <input type="text" value="<?= $user->id ?>" readonly
                                    class="w-full px-4 py-3.5 bg-slate-100 border border-slate-200 rounded-2xl font-bold text-slate-400 cursor-not-allowed">
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-12 mb-8">
                            <div class="h-6 w-1.5 bg-red-500 rounded-full"></div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">Security</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">New
                                    Password</label>
                                <input type="password" name="password" placeholder="••••••••"
                                    class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl outline-none transition-all">
                            </div>
                        </div>

                        <div id="save-btn"
                            class="mt-12 hidden flex flex-col md:flex-row items-center gap-4 border-t border-slate-100 pt-8">
                            <button type="submit"
                                class="w-full md:w-auto px-10 py-4 bg-slate-900 text-white font-black rounded-2xl hover:bg-blue-600 transition-all shadow-xl active:scale-95">
                                SAVE CHANGES
                            </button>
                            <button type="button" onclick="window.location.reload()"
                                class="w-full md:w-auto px-10 py-4 bg-transparent text-slate-400 font-bold rounded-2xl hover:bg-slate-50 transition-all border border-slate-200">
                                CANCEL
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>