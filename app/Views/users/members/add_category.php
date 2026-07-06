<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">

        <div class="card-header">
            <h3>Add Category</h3>
        </div>

        <div class="card-body">

            <form action="<?= base_url('users/members/save_category') ?>" method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Category Icon</label>

                        <select name="icon" class="form-control" required>

                            <option value="">-- Select Icon --</option>

                            <option value="🏠">🏠 Rooms</option>

                            <option value="🚗">🚗 Cars</option>

                            <option value="💒">💒 Hall</option>

                            <option value="🏍️">🏍️ Bikes</option>

                            <option value="🏢">🏢 Offices</option>

                            <option value="🛌">🛌 PG/Hostel</option>

                            <option value="🛋️">🛋️ Furniture</option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="5" class="form-control"></textarea>

                    </div>

                </div>

                <button class="btn btn-success">
                    <i class="mdi mdi-content-save"></i>
                    Save Category
                </button>

                <a href="<?= base_url('users/members/categoryindex') ?>" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>