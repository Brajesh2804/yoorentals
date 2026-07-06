<?= $this->extend('admin/_layouts/master') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between">

                        <h4>CMS Pages</h4>

                        <form>

                            <div class="input-group">

                                <input type="text" name="search" class="form-control" placeholder="Search Page">

                                <button class="btn btn-primary">

                                    Search

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Title</th>

                                <th>Key</th>

                                <th>Status</th>

                                <th width="150">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($pages as $row): ?>

                                <tr>

                                    <td><?= $row->id ?></td>

                                    <td><?= esc($row->page_title) ?></td>

                                    <td>

                                        <span class="badge bg-info">

                                            <?= $row->page_key ?>

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

                                        <a href="<?= base_url('admin/cms/edit/' . $row->id) ?>"
                                            class="btn btn-sm btn-primary">

                                            Edit

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>