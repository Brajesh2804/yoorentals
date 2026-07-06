<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">
        <div class="card-header">
            <h3>Ad Details</h3>
        </div>

        <div class="card-body">

            <?php
            $images = explode(',', $ad->images);
            ?>

            <div class="row">

                <div class="col-md-4">

                    <?php if(!empty($images[0])): ?>

                        <img src="<?= base_url('uploads/ads/'.$images[0]) ?>"
                             class="img-fluid img-thumbnail">

                    <?php endif; ?>

                </div>

                <div class="col-md-8">

                    <table class="table table-bordered">

                        <tr>
                            <th width="180">Title</th>
                            <td><?= esc($ad->title) ?></td>
                        </tr>

                        <tr>
                            <th>Category</th>
                            <td><?= esc($ad->category_id) ?></td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>₹<?= number_format($ad->price) ?></td>
                        </tr>

                        <tr>
                            <th>Location</th>
                            <td><?= esc($ad->location) ?></td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td><?= esc($ad->phone) ?></td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td><?= nl2br(esc($ad->description)) ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>

                            <td>

                                <?php if($ad->status==1): ?>

                                    <span class="badge bg-success">Active</span>

                                <?php else: ?>

                                    <span class="badge bg-danger">Inactive</span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    </table>

                    <a href="<?= base_url('users/members/adsindex') ?>"
                       class="btn btn-info">

                        Back

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>