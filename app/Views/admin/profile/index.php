<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>
<div class="content-wrapper">
    <main id="main" class="main">

        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2>User Details</h2>
                <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-info">Back</a>
            </div>
        </div>
        <section class="section profile">
            <div class="row">

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="<?= base_url('assets/upload/users/' . $profile->image) ?>" alt="Profile"
                                class="rounded-circle" width="120">

                            <h2 class="mt-3"><?= $profile->name ?></h2>
                            <h5><?= $profile->email ?></h5>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">

                            <div class="d-flex justify-content-between">
                                <h3>Profile Details</h3>
                                <a href="<?= base_url('admin/edit_profile/' . $profile->user_id) ?>"
                                    class="btn btn-primary btn-sm">Edit</a>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?= $profile->name ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $profile->email ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8"><?= $profile->phone ?? 'N/A' ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8"><?= $profile->address ?? 'N/A' ?></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <?= $profile->status == 1 ? 'Active' : 'Inactive' ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
</div <?= $this->endSection() ?>