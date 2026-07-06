<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">

        <div class="card-header">
            <h3> Settings (CMS)</h3>
        </div>

        <div class="card-body">

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/settings/update') ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Website Name</label>

                        <input type="text"
                               name="site_name"
                               value="<?= $settings->site_name ?? '' ?>"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Logo</label>

                        <input type="file"
                               name="logo"
                               class="form-control">

                        <?php if(!empty($settings->logo)): ?>

                            <img src="<?= base_url('uploads/settings/'.$settings->logo) ?>"
                                 width="120"
                                 class="mt-2">

                        <?php endif; ?>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Phone</label>

                        <input type="text"
                               name="phone"
                               value="<?= $settings->phone ?? '' ?>"
                               class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Email</label>

                        <input type="email"
                               name="email"
                               value="<?= $settings->email ?? '' ?>"
                               class="form-control">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label>Address</label>

                        <textarea name="address"
                                  class="form-control"
                                  rows="3"><?= $settings->address ?? '' ?></textarea>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label>Footer Text</label>

                        <textarea name="footer_text"
                                  class="form-control"
                                  rows="3"><?= $settings->footer_text ?? '' ?></textarea>

                    </div>

                </div>

                <button class="btn btn-success">

                    <i class="mdi mdi-content-save"></i>

                    Save Settings

                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>