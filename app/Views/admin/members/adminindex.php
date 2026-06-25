<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Admins</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <?php if (session()->getFlashdata('message')): ?>
                <div id="flash-message">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>
                
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Admin List</h6>

                    <?php if (is_privilege(1, 2)) { ?>
                        <a href="<?= base_url('admin/members/add_admin') ?>" class="btn btn-primary">
                            Add Admin
                        </a>
                    <?php } ?>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Privilege</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sn = 1;
                                if (!empty($admins)):
                                    foreach ($admins as $admin):

                                        if ($admin->status == 1) {
                                            $status = '<span class="badge bg-success">Active</span>';
                                        } else {
                                            $status = '<span class="badge bg-danger">Inactive</span>';
                                        }
                                        ?>

                                        <tr>

                                            <td><?= $sn++; ?></td>

                                            <td>
                                                <?php if (!empty($admin->image)) { ?>
                                                    <img src="<?= base_url('uploads/profile/' . $admin->image) ?>" width="65"
                                                        height="75" alt="image">
                                                <?php } else { ?>
                                                    <img src="<?= base_url('assets/uploads/profile/default.png') ?>" width="65"
                                                        height="75" alt="image">
                                                <?php } ?>
                                            </td>

                                            <td><?= esc($admin->name) ?></td>

                                            <td>
                                                <?= esc($admin->group_name ?? 'N/A') ?>
                                            </td>

                                            <td><?= esc($admin->email) ?></td>

                                            <td><?= esc($admin->phone) ?></td>

                                            <td><?= $status ?></td>

                                            <td>

                                                <?php if (is_privilege(1, 3)) { ?>
                                                    <a href="<?= base_url('admin/members/edit_admin/' . $admin->user_id) ?>">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                <?php } ?>

                                                <?php if (is_privilege(1, 4)) { ?>
                                                    <a href="<?= base_url('admin/members/view_admin/' . $admin->user_id) ?>">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                <?php } ?>

                                                <?php if (is_privilege(1, 5)) { ?>
                                                    <?php if ($admin->user_id != 1) { ?>
                                                        <a href="<?= base_url('admin/members/delete_admin/' . $admin->user_id) ?>"
                                                            onclick="return confirm('Are you sure?')" style="color:red">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>

                                        </tr>

                                        <?php
                                    endforeach;
                                endif;
                                ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        setTimeout(function () {

            let flash = document.getElementById('flash-message');

            if (flash) {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = "0";

                setTimeout(function () {
                    flash.remove();
                }, 500);
            }

        }, 3000);

    });
</script>

<?= $this->endSection() ?>