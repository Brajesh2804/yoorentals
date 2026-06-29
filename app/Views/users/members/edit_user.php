<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="<?= $user->name ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?= $user->email ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?= $user->phone ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">

                            <option value="1"
                                <?= ($user->status == 1) ? 'selected' : '' ?>>
                                Active
                            </option>

                            <option value="0"
                                <?= ($user->status == 0) ? 'selected' : '' ?>>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <!-- <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="4"><?= $user->address ?></textarea>
                    </div> -->

                    <div class="col-md-12">

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i>
                            Update User
                        </button>

                        <a href="<?= base_url('users/members/userindex') ?>"
                           class="btn btn-secondary">
                            Back
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>