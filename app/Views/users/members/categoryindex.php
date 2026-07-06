<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Manage Categories</h3>

        <a href="<?= base_url('users/members/add_category') ?>" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Add Category
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-end mb-3">

                <form method="get" action="">

                    <div class="input-group" style="width:300px;">

                        <input type="text" name="search" class="form-control form-control-sm"
                            placeholder="Search Category..." value="<?= esc($_GET['search'] ?? '') ?>">

                        <button class="btn btn-primary btn-sm">
                            <i class="mdi mdi-magnify"></i>
                        </button>

                    </div>

                </form>

            </div>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Icon</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($categories)): ?>

                        <?php foreach ($categories as $cat): ?>

                            <tr>

                                <td><?= $cat->category_id ?></td>

                                <td style="font-size:25px;">
                                    <?= $cat->icon ?>
                                </td>

                                <td><?= esc($cat->category_name) ?></td>

                                <td><?= esc($cat->slug) ?></td>

                                <td>

                                    <?php if ($cat->status == 1): ?>

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a href="<?= base_url('users/members/view_category/' . $cat->category_id) ?>">
                                        <i class="mdi mdi-eye text-primary"></i>
                                    </a>

                                    <!-- <a href="<?= base_url('admin/category/edit/' . $cat->category_id) ?>">
                                        <i class="mdi mdi-lead-pencil text-warning"></i>
                                    </a> -->

                                    <a href="<?= base_url('users/members/delete_category/' . $cat->category_id) ?>"
                                        onclick="return confirm('Delete this category?')">
                                        <i class="mdi mdi-delete text-danger"></i>
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center">

                                No Category Found

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>