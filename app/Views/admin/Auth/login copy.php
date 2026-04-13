<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YooRental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-slate-100 font-sans">

    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold text-slate-800 mb-6">Welcome to YooRental</h1>
        <button onclick="toggleModal()"
            class="bg-slate-900 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-600 transition-all shadow-lg">
            Login to Account
        </button>
    </div>

    <div id="loginModal"
        class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden transform transition-all">

            <div class="px-8 pt-8 pb-4 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-slate-900">Sign In</h2>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-red-500 text-2xl">&times;</button>
            </div>

            <form id="loginForm" action="<?= base_url('/login') ?>" method="POST" class="px-8 pb-8">
                <?= csrf_field() ?>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            placeholder="example@mail.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-blue-600 transition-all mt-4">
                        Login
                    </button>
                </div>

                <p class="text-center text-sm text-slate-500 mt-6">
                    New here? <a href="<?= base_url('/register') ?>" class="text-blue-600 font-bold">Create account</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('loginModal');
            modal.classList.toggle('hidden');
        }

        // Validation Logic
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            let errorMessage = "";

            if (email === "") {
                errorMessage = "Email is required!";
            } else if (!validateEmail(email)) {
                errorMessage = "Please enter a valid email address!";
            } else if (password === "") {
                errorMessage = "Password is required!";
            } else if (password.length < 5) {
                errorMessage = "Password must be at least 5 characters!";
            }

            if (errorMessage !== "") {
                e.preventDefault(); // Stop form submission

                // Show Popup Error
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessage,
                    confirmButtonColor: '#0f172a', // slate-900
                });
            }
        });

        // Email Format Checker
        function validateEmail(email) {
            return String(email)
                .toLowerCase()
                .match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        };

        // Backend se aane wale errors (Agar password galat ho to)
        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                icon: 'info',
                title: 'Notice',
                html: '<?= session()->getFlashdata('message') ?>',
                confirmButtonColor: '#0f172a',
            });
            // Show modal automatically if there's a backend error
            toggleModal();
        <?php endif; ?>
    </script>
</body>

</html>