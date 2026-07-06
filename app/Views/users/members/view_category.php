<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">

        <div class="card-header">
            <h3>Category Details</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- <div class="col-md-4 text-center">

                    <?php if (!empty($category->image)): ?>

                        <img src="<?= base_url('uploads/category/' . $category->image) ?>"
                             class="img-fluid img-thumbnail"
                             style="max-height:250px;">

                    <?php else: ?>

                        <img src="<?= base_url('assets/images/no-image.png') ?>"
                             class="img-fluid img-thumbnail"
                             style="max-height:250px;">

                    <?php endif; ?>

                </div> -->

                <div class="col-md-8">

                    <table class="table table-bordered">

                        <tr>
                            <th width="180">Category ID</th>
                            <td><?= $category->category_id ?></td>
                        </tr>

                        <tr>
                            <th>Category Name</th>
                            <td><?= esc($category->category_name) ?></td>
                        </tr>

                        <tr>
                            <th>Slug</th>
                            <td><?= esc($category->slug) ?></td>
                        </tr>

                        <tr>
                            <th>Icon</th>
                            <td style="font-size:30px;">
                                <?= $category->icon ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td><?= nl2br(esc($category->description)) ?></td>
                        </tr>

                        <tr>
                            <th>Sort Order</th>
                            <td><?= $category->sort_order ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>

                            <td>
                                <?php if ($category->status == 1): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>

                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td><?= $category->created_at ?></td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td><?= $category->updated_at ?></td>
                        </tr>

                    </table>

                    <a href="<?= base_url('users/members/categoryindex') ?>"
                       class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Back
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>