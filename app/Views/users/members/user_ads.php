<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <h3 class="mb-3">User Ads</h3>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Location</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach($ads as $ad): ?>

                    <?php
                    $imgs = explode(',', $ad->images);
                    ?>

                    <tr>

                        <td><?= $ad->id ?></td>

                        <td>
                            <?php if(!empty($imgs[0])): ?>
                                <img src="<?= base_url('uploads/ads/'.$imgs[0]) ?>"
                                     width="80">
                            <?php endif; ?>
                        </td>

                        <td><?= $ad->title ?></td>

                        <td><?= $ad->category_id?></td>

                        <td>₹<?= number_format($ad->price) ?></td>

                        <td><?= $ad->location ?></td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>