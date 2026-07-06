<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3>CMS Pages</h3>

            <form method="get" action="<?= base_url('admin/cms') ?>" class="d-flex">

                <input type="text" name="search" value="<?= esc($search ?? '') ?>" class="form-control me-2"
                    placeholder="Search Page">

                <button class="btn btn-primary">
                    Search
                </button>

            </form>

        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th>Key</th>
                        <th width="120">Status</th>
                        <th width="120">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($pages)): ?>

                        <?php $i = 1;
                        foreach ($pages as $row): ?>

                            <tr>

                                <td><?= $i++ ?></td>

                                <td><?= esc($row->page_title) ?></td>

                                <td>
                                    <span class="badge bg-primary">
                                        <?= esc($row->page_key) ?>
                                    </span>
                                </td>

                                <td>

                                    <?php if ($row->status == 1): ?>

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

                                    <a href="<?= base_url('admin/cms/edit/' . $row->id) ?>" class="btn btn-primary btn-sm">

                                        <i class="mdi mdi-pencil"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="5" class="text-center">
                                No CMS Pages Found
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>