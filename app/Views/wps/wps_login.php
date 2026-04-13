<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Yoo Rental</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/ti-icons/css/themify-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/css/vendor.bundle.base.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/font-awesome/css/font-awesome.min.css') ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url('assets/admin/images/logo1a.png') ?>" />
</head>

<body class="bg-gradient-login">
  <div class="container-fluid py-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="mx-auto"
          style="max-width:750px; background:#fff; padding:50px 40px; border-radius:5px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
          <!-- Logo -->
          <div class="text-center mb-4">
            <img src="<?= base_url('assets/admin/images/logo1.png') ?>" style="max-width:130px;">
          </div>
          <!-- Flash Message -->
          <?php echo session()->getFlashdata('message'); ?>
          <!-- Form -->
          <?= form_open(base_url('/wpsadmin')) ?>

          <!-- Email -->
          <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Enter Email Address"
              value="<?= set_value('email') ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->showError('email') : ''; ?></small>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password"
              value="<?= set_value('password') ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->showError('password') : ''; ?></small>
          </div>
          <!-- Login Button -->
          <button type="submit" class="btn btn-primary w-100 py-3" style="font-size:15px;">Login</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url('assets/admin/vendors/js/vendor.bundle.base.js') ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url('assets/admin/js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/misc.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/settings.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/todolist.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/jquery.cookie.js') ?>"></script>
  <!-- endinject -->
</body>

</html>