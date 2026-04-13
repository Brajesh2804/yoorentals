<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YooRantal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets/admin/images/logo1a.png') ?>" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <?= $this->include('_layout/navbar') ?>
    <main class="flex-grow">
        <?= $this->renderSection('content') ?>
    </main>
    <?= $this->include("_layout/footer") ?>
    <script src="<?= base_url('assets/admin/js/error_remove.js') ?>"></script>
</body>
</html>