<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">
        <div class="card-header">
            <h4>Settings</h4>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label>Website Name</label>
                    <input type="text" class="form-control"
                           name="site_name"
                           value="Yoo Rental">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control"
                           name="email">
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" class="form-control"
                           name="phone">
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Settings
                </button>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>