<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<?php
$recentUsers = \Config\Database::connect()
  ->table('users')
  ->orderBy('user_id', 'DESC')
  ->limit(5)
  ->get()
  ->getResult();
?>
<div class="content-wrapper">

  <?php if (session()->getFlashdata('message')): ?>
    <div id="flash-message">
      <?= session()->getFlashdata('message'); ?>
    </div>

    <script>
      // 3 second baad message ko gayab karne ke liye
      setTimeout(function () {
        var msg = document.getElementById('flash-message');
        if (msg) {
          msg.style.display = 'none';
        }
      }, 3000);
    </script>
  <?php endif; ?>
  <div class="row">

    <!-- Total Users -->
    <div class="col-md-3 stretch-card grid-margin">
      <div class="card bg-gradient-primary card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">
            Total Users
            <i class="mdi mdi-account-group mdi-24px float-end"></i>
          </h4>

          <h2 class="mb-3"><?= $total_users ?></h2>

          <a href="<?= base_url('users/members/userindex') ?>" class="text-white">
            View Users
          </a>
        </div>
      </div>
    </div>

    <!-- Total Ads -->
    <div class="col-md-3 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">
            Total Ads
            <i class="mdi mdi-view-grid mdi-24px float-end"></i>
          </h4>

          <h2 class="mb-3"><?= $total_ads ?></h2>

          <a href="<?= base_url('users/members/adsindex') ?>" class="text-white">
            View Ads
          </a>
        </div>
      </div>
    </div>

    <!-- Active Ads -->
    <div class="col-md-3 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">
            Active Ads
            <i class="mdi mdi-check-circle mdi-24px float-end"></i>
          </h4>

          <h2 class="mb-3"><?= $active_ads ?></h2>

          <span>Currently Active</span>
        </div>
      </div>
    </div>

    <!-- Blocked Users -->
    <div class="col-md-3 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">
            Blocked Users
            <i class="mdi mdi-account-cancel mdi-24px float-end"></i>
          </h4>

          <h2 class="mb-3"><?= $total_blocked_users ?></h2>

          <a href="<?= base_url('users/members/userindex') ?>" class="text-white">
            View Users
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">

    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Recent Users</h5>
        </div>

        <div class="card-body">

          <table class="table table-bordered table-hover">

            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($recentUsers as $user): ?>
                <tr>
                  <td>
                    <?= $user->user_id ?>
                  </td>
                  <td>
                    <?= esc($user->name) ?>
                  </td>
                  <td>
                    <?= esc($user->email) ?>
                  </td>
                  <td>
                    <?= esc($user->phone) ?>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>

          </table>

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Quick Stats</h5>
        </div>

        <div class="card-body">

          <p>
            <strong>Total Users:</strong>
            <?= $total_users ?>
          </p>

          <p>
            <strong>Total Ads:</strong>
            <?= $total_ads ?>
          </p>

          <p>
            <strong>Active Ads:</strong>
            <?= $active_ads ?>
          </p>

          <p>
            <strong>Blocked Users:</strong>
            <?= $total_blocked_users ?>
          </p>

        </div>
      </div>
    </div>

  </div>
  <?= $this->endSection() ?>