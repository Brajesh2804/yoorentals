<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">

    <div class="card">
        <div class="card-header">
            <h4>Block User</h4>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">
                        Block Reason
                    </label>

                    <textarea
                        name="block_reason"
                        class="form-control"
                        rows="4"
                        required></textarea>
                </div>

                <button type="submit"
                    class="btn btn-danger">
                    Block User
                </button>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>