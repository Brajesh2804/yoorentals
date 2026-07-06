<?= $this->extend('admin/_layouts/master') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card">

        <div class="card-header">

            <h4>Edit CMS Page</h4>

        </div>

        <div class="card-body">

            <form action="<?= base_url('admin/cms/update/' . $page->id) ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field() ?>
                

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Page Title</label>

                        <input type="text" name="page_title" class="form-control" value="<?= esc($page->page_title) ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Page Key</label>

                        <input type="text" class="form-control" value="<?= esc($page->page_key) ?>" readonly>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Page Content

                    </label>

                    <textarea id="editor" name="page_content" rows="15"
                        class="form-control"><?= $page->page_content ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">

                            Page Image

                        </label>

                        <input type="file" name="page_image" class="form-control">

                    </div>

                    <div class="col-md-6">

                        <?php if (!empty($page->page_image)): ?>

                            <img src="<?= base_url('uploads/cms/' . $page->page_image) ?>" style="height:120px">

                        <?php endif; ?>

                    </div>

                </div>

                <div class="row mt-4">

                    <div class="col-md-4">

                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1" <?= $page->status == 1 ? 'selected' : '' ?>>

                                Active

                            </option>

                            <option value="0" <?= $page->status == 0 ? 'selected' : '' ?>>

                                Inactive

                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <button class="btn btn-success">

                    <i class="mdi mdi-content-save"></i>

                    Update Page

                </button>

                <a href="<?= base_url('admin/cms') ?>" class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace('editor');

</script>

<?= $this->endSection() ?>