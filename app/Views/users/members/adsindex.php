<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <h3 class="mb-3">All Ads</h3>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-end mb-3">
                <form method="get" action="" style="width:400px;">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Search by Title or Price..."
                            value="<?= esc($_GET['search'] ?? '') ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($ads as $ad): ?>

                        <?php
                        $images = explode(',', $ad->images);
                        ?>

                        <tr>

                            <td><?= $ad->id ?></td>

                            <td>
                                <?php if (!empty($images[0])): ?>
                                    <img src="<?= base_url('uploads/ads/' . $images[0]) ?>" width="80">
                                <?php endif; ?>
                            </td>

                            <td><?= esc($ad->title) ?></td>

                            <td>₹<?= number_format($ad->price) ?></td>

                            <td><?= esc($ad->location) ?></td>

                            <td>
                                <?php if ($ad->status == 1): ?>
                                    <span class="badge bg-success">Activeted</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Deactiveted</span>
                                <?php endif; ?>
                            </td>



                            <td>
                                <a href="<?= base_url('users/members/view_ads/' . $ad->id) ?>">
                                    <i class="mdi mdi-eye"></i>
                                </a>



                                <?php if ($ad->status == 1): ?>

                                    <a href="<?= base_url('users/members/deactivate_ads/' . $ad->id) ?>"
                                        onclick="return confirm('Deactivate this ad?')">
                                        <i class="mdi mdi-lock text-danger"></i>
                                    </a>

                                <?php else: ?>

                                    <a href="<?= base_url('users/members/activate_ads/' . $ad->id) ?>"
                                        onclick="return confirm('Activate this ad?')">
                                        <i class="mdi mdi-lock-open text-success"></i>
                                    </a>

                                <?php endif; ?>

                                <a href="<?= base_url('users/members/delete_ads/' . $ad->id) ?>"
                                    onclick="return confirm('Delete this ads?')">
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