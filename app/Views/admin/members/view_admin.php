<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h1 class="h3 mb-0 text-gray-800">View Admin</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card mb-4">

                <div class="card-header py-1">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Admin Details
                    </h6>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2">Profile Image</label>

                        <div class="col-md-10">
                            <?php if(!empty($admin->image)){ ?>
                                <img src="<?= base_url('uploads/profile/'.$admin->image) ?>"
                                     width="120"
                                     height="120">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Name</label>

                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control"
                                   value="<?= esc($admin->name) ?>"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Email</label>

                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control"
                                   value="<?= esc($admin->email) ?>"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Phone</label>

                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control"
                                   value="<?= esc($admin->phone) ?>"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Address</label>

                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control"
                                   value="<?= esc($admin->address) ?>"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Privilege</label>

                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control"
                                   value="<?= esc($admin->group_name) ?>"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Status</label>

                        <div class="col-md-10">

                            <?php if($admin->status == 1){ ?>
                                <span class="badge badge-success">
                                    Active
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-danger">
                                    Inactive
                                </span>
                            <?php } ?>

                        </div>
                    </div>

                    <a href="<?= base_url('admin/members/adminindex') ?>"
                       class="btn btn-warning">
                        Back
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>