<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h1 class="h3 mb-0 text-gray-800">Admins</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card mb-4">

                <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Add Admin
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
                                    value="<?= set_value('name') ?>"
                                    placeholder="Enter Admin Name">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('name') : '' ?>
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
                                    value="<?= set_value('email') ?>"
                                    placeholder="Enter Email">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('email') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">

                            <label class="col-md-2">Password</label>

                            <div class="col-md-4">
                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Password">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('password') : '' ?>
                                </span>
                            </div>

                            <label class="col-md-2">Confirm Password</label>

                            <div class="col-md-4">
                                <input type="password"
                                    name="cpassword"
                                    class="form-control"
                                    placeholder="Confirm Password">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('cpassword') : '' ?>
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
                                    value="<?= set_value('phone') ?>"
                                    placeholder="Enter Phone">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('phone') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label class="col-md-2">Address</label>

                            <div class="col-md-10">
                                <input type="text"
                                    name="address"
                                    class="form-control"
                                    value="<?= set_value('address') ?>"
                                    placeholder="Enter Address">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('address') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group row">
                            <label class="col-md-2">Profile Image</label>

                            <div class="col-md-10">
                                <input type="file"
                                    name="image"
                                    class="form-control">

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('image') : '' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Group -->
                        <div class="form-group row">
                            <label class="col-md-2">Privilege Group</label>

                            <div class="col-md-10">

                                <select name="group_id" class="form-control">

                                    <option value="">
                                        Select Group
                                    </option>

                                    <?php foreach($groups as $group){ ?>

                                        <option value="<?= $group->group_id ?>"
                                            <?= set_select('group_id', $group->group_id) ?>>

                                            <?= $group->group_name ?>

                                        </option>

                                    <?php } ?>

                                </select>

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('group_id') : '' ?>
                                </span>

                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">

                            <label class="col-md-2">Status</label>

                            <div class="col-md-10">

                                <div class="custom-control custom-radio">
                                    <input type="radio"
                                        id="active"
                                        name="status"
                                        value="1"
                                        class="custom-control-input"
                                        <?= set_radio('status', '1') ?>>

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
                                        <?= set_radio('status', '0') ?>>

                                    <label class="custom-control-label" for="inactive">
                                        Inactive
                                    </label>
                                </div>

                                <span class="text-danger">
                                    <?= isset($validation) ? $validation->getError('status') : '' ?>
                                </span>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit
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