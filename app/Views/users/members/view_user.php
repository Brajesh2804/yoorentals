<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">
        <div class="card-header">
            <h4>User Details</h4>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">

                    <?php if(!empty($user->image) && $user->image != '0'): ?>
                        <img src="<?= base_url('uploads/profile/'.$user->image) ?>"
                             class="img-fluid rounded">
                    <?php endif; ?>

                </div>

                <div class="col-md-9">

                    <table class="table table-bordered">

                        <tr>
                            <th>User ID</th>
                            <td><?= $user->user_id ?></td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td><?= $user->name ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?= $user->email ?></td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td><?= $user->phone ?></td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td><?= $user->address ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <?= $user->status == 1 ? 'Active' : 'Inactive' ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Blocked</th>
                            <td>
                                <?= $user->is_blocked == 1 ? 'Yes' : 'No' ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Created</th>
                            <td><?= $user->created_at ?></td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>