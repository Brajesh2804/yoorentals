<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">

    <div class="card shadow">
        <div class="card-header">
            <h3>User Profile</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-8">

                    <table class="table table-borderless">

                        <tr>
                            <th width="200">Full Name</th>
                            <td><?= $member->name ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?= $member->email ?></td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td><?= $member->phone ?></td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td><?= $member->address ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if($member->status == 1): ?>
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Created Date</th>
                            <td><?= $member->created_at ?? '-' ?></td>
                        </tr>

                    </table>

                    <a href="<?= base_url('admin/members/user') ?>"
                       class="btn btn-primary">
                        Back
                    </a>

                </div>

                <div class="col-md-4 text-center">

                    <?php if(!empty($member->image)): ?>

                        <img src="<?= base_url('uploads/profile/'.$member->image) ?>"
                             class="img-thumbnail"
                             style="width:200px;height:200px;object-fit:cover;">

                    <?php else: ?>

                        <img src="<?= base_url('public/assets/images/default-user.png') ?>"
                             class="img-thumbnail"
                             style="width:200px;height:200px;object-fit:cover;">

                    <?php endif; ?>

                    

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>