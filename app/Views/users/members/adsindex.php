<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <h3 class="mb-3">All Ads</h3>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach($ads as $ad): ?>

                    <?php
                    $images = explode(',', $ad->images);
                    ?>

                    <tr>

                        <td><?= $ad->id ?></td>

                        <td>
                            <?php if(!empty($images[0])): ?>
                                <img src="<?= base_url('uploads/ads/'.$images[0]) ?>"
                                     width="80">
                            <?php endif; ?>
                        </td>

                        <td><?= esc($ad->title) ?></td>

                        <td>₹<?= number_format($ad->price) ?></td>

                        <td><?= esc($ad->location) ?></td>

                        <td>
                            <?php if($ad->status == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>