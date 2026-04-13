<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YooRental Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
        }

        /* LEFT SIDE */
        .left {
            width: 50%;
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa') no-repeat center/cover;
            position: relative;
            color: #fff;
        }

        .left::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .left-content {
            position: absolute;
            bottom: 40px;
            left: 40px;
            z-index: 2;
        }

        .left h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 14px;
            max-width: 400px;
        }

        /* RIGHT SIDE */
        .right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9fafb;
        }

        .form-box {
            width: 80%;
            max-width: 400px;
        }

        .form-box h2 {
            margin-bottom: 10px;
        }

        .form-box p {
            color: #777;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #4338ca;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .link a {
            color: #4f46e5;
            text-decoration: none;
        }

        @media(max-width:768px) {
            .left {
                display: none;
            }

            .right {
                width: 100%;
            }
        }

        .terms {
            font-size: 13px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
        }

        .terms a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .terms a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- LEFT -->
    <div class="left">
        <div class="left-content">
            <h2>YooRental</h2>
            <p>
                Manage your rental properties, tenants, and payments easily with YooRental.
                A smart solution for landlords and tenants to stay organized and stress-free.
            </p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">
            <?php if (session()->getFlashdata('message')): ?>
                    <div id="flash-msg"
                        style="padding:10px;background:#d4edda;color:#155724;border-radius:6px;margin-bottom:10px;text-align:center;">
                        <?= session()->getFlashdata('message'); ?>
                    </div>

                    <script>
                        setTimeout(function () {
                            let msg = document.getElementById('flash-msg');
                            if (msg) {
                                msg.style.transition = "opacity 0.5s ease";
                                msg.style.opacity = "0";
                                setTimeout(() => msg.remove(), 300);
                            }
                        }, 2000);
                    </script>
                <?php endif; ?>

                <h2>Create an account</h2>
                <p>Start managing your rentals today</p>

                <form method="post" action="<?= base_url('/register') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="<?= old('name') ?>">
                        <small class="text-danger">
                            <?= session('validation') ? session('validation')->showError('name') : '' ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            value="<?= old('email') ?>">
                        <small class="text-danger">
                            <?= session('validation') ? session('validation')->showError('email') : '' ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <small class="text-danger">
                            <?= session('validation') ? session('validation')->showError('password') : '' ?>
                        </small>
                    </div>

                    <button type="submit">Create Account</button>
                </form>

                <div class="link">
                    Already have an account?
                    <a href="<?= base_url('/login') ?>">Login</a>
                </div>
                <!-- <div class="terms">
                <input type="checkbox" required>
                <span>
                    <li _ngcontent-ng-c2442006695=""><a _ngcontent-ng-c2442006695="" routerlink="/contact" class="text-decoration-none text-muted" href="/contact"> Contact Us </a></li>
                    <li _ngcontent-ng-c2442006695=""><a _ngcontent-ng-c2442006695="" routerlink="/terms" class="text-decoration-none text-muted" href="/terms"> Terms and Conditions </a></li>
                </span>
            </div> -->
        </div>

    </div>


</body>

</html>