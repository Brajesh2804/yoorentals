<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h1 class="h3 mb-0 text-gray-800">Admins</h1>

        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/dashboard') ?>">Admin</a>
            </li>
            <li class="breadcrumb-item active">
                Edit Admin
            </li>
        </ol> -->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card mb-4">

                <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Edit Admin
                    </h6>
                </div>

                <div class="card-body">

                    <form action="<?= current_url(); ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field(); ?>

                        <!-- Name -->
                        <div class="form-group row">
                            <label class="col-md-2">Admin Name</label>

                            <div class="col-md-10">
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="<?= set_value('name', $admin->name) ?>"
                                    placeholder="Enter Admin Name">

                                <span class="text-danger">
                                    <?= isset($validation) ? get_error($validation,'name') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label class="col-md-2">Email</label>

                            <div class="col-md-10">
                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= set_value('email', $admin->email) ?>"
                                    placeholder="Enter Email"
                                    <?= ($admin->group_id == 1) ? 'readonly' : '' ?>>

                                <span class="text-danger">
                                    <?= isset($validation) ? get_error($validation,'email') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group row">
                            <label class="col-md-2">Phone</label>

                            <div class="col-md-10">
                                <input type="text"
                                    name="phone"
                                    class="form-control"
                                    value="<?= set_value('phone', $admin->phone) ?>"
                                    placeholder="Enter Phone">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label class="col-md-2">Address</label>

                            <div class="col-md-10">
                                <input type="text"
                                    name="address"
                                    class="form-control"
                                    value="<?= set_value('address', $admin->address) ?>"
                                    placeholder="Enter Address">
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group row">
                            <label class="col-md-2">Profile Image</label>

                            <div class="col-md-4">
                                <input type="file"
                                    name="image"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <?php if(!empty($admin->image)){ ?>
                                    <img src="<?= base_url('uploads/profile/'.$admin->image) ?>"
                                        width="60"
                                        height="60">
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Group -->
                        <div class="form-group row">
                            <label class="col-md-2">Privilege Group</label>

                            <div class="col-md-10">

                                <?php if($admin->group_id == 1){ ?>

                                    <span class="badge badge-danger">
                                        Super Admin
                                    </span>

                                <?php } else { ?>

                                    <select name="group_id" class="form-control">

                                        <option value="">
                                            Select Group
                                        </option>

                                        <?php foreach($groups as $group){ ?>

                                            <option value="<?= $group->group_id ?>"
                                                <?= ($group->group_id == $admin->group_id) ? 'selected' : '' ?>>

                                                <?= $group->group_name ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                <?php } ?>

                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">

                            <label class="col-md-2">Status</label>

                            <div class="col-md-10">

                                <?php if($admin->group_id == 1){ ?>

                                    <span class="badge badge-success">
                                        Active
                                    </span>

                                <?php } else { ?>

                                    <div class="custom-control custom-radio">
                                        <input type="radio"
                                            id="active"
                                            name="status"
                                            value="1"
                                            class="custom-control-input"
                                            <?= ($admin->status == 1) ? 'checked' : '' ?>>

                                        <label class="custom-control-label" for="active">
                                            Active
                                        </label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio"
                                            id="inactive"
                                            name="status"
                                            value="0"
                                            class="custom-control-input"
                                            <?= ($admin->status == 0) ? 'checked' : '' ?>>

                                        <label class="custom-control-label" for="inactive">
                                            Inactive
                                        </label>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                        <button type="reset" class="btn btn-info">
                            Reset
                        </button>

                        <a href="<?= base_url('admin/members/adminindex') ?>"
                            class="btn btn-warning">
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>