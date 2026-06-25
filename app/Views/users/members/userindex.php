<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <h3 class="mb-3">Users List</h3>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Block</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td><?= $user->user_id ?></td>

                            <td>
                                <?php if (!empty($user->image) && $user->image != '0'): ?>
                                    <img src="<?= base_url('uploads/profile/' . $user->image) ?>" width="60">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>

                            <td><?= esc($user->name) ?></td>

                            <td><?= esc($user->email) ?></td>

                            <td><?= esc($user->phone) ?></td>

                            <td>
                                <?= $user->status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>' ?>
                            </td>

                            <td>
                                <?php if ($user->is_blocked == 1): ?>
                                    <span class="badge bg-danger">Blocked</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Unblocked</span>
                                <?php endif; ?>
                            </td>

                            <td>

                                <a href="<?= base_url('users/members/view_user/' . $user->user_id) ?>">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <a href="<?= base_url('users/members/edit_user/' . $user->user_id) ?>">
                                    <i class="mdi mdi-lead-pencil text-warning"></i>
                                </a>

                                <a href="<?= base_url('users/members/user_ads/' . $user->user_id) ?>">
                                    <i class="mdi mdi-view-grid text-info"></i>
                                </a>

                                <?php if ($user->is_blocked == 0): ?>

                                    <a href="<?= base_url('users/members/block_user/' . $user->user_id) ?>"
                                        onclick="return confirm('Block this user?')">
                                        <i class="mdi mdi-lock text-danger"></i>
                                    </a>

                                <?php else: ?>

                                    <a href="<?= base_url('users/members/unblock_user/' . $user->user_id) ?>"
                                        onclick="return confirm('Unblock this user?')">
                                        <i class="mdi mdi-lock-open text-success"></i>
                                    </a>

                                <?php endif; ?>

                                <a href="<?= base_url('users/members/delete_user/' . $user->user_id) ?>"
                                    onclick="return confirm('Delete this user?')">
                                    <i class="mdi mdi-delete text-danger"></i>
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>