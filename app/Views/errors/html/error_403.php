

<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f0f0;
            margin: 0;
        }
        .box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 { color: #e74c3c; font-size: 40px; margin: 0; }
        p { margin-top: 10px; font-size: 18px; color: #555; }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            background: #333;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🚫 403 Forbidden</h1>
        <p>Sorry! You don't have permission to access this page.</p>
        <a href="<?= base_url('/') ?>">⬅ Back to Home</a>
    </div>
</body>
</html>