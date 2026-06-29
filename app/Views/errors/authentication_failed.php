<!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-danger">
        <h3>Access Denied</h3>
        <p>You do not have permission to access this page.</p>

        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary">
            Back to Dashboard
        </a>
    </div>
</div>

</body>
</html>