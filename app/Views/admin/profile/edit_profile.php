<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Edit User</h4>
                <a href="<?= base_url('admin/profile') ?>" class="btn btn-info">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= current_url() ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-8">
                        <!-- Your existing form fields -->
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" name="name" id="name" value="<?= set_value('name', $user->name) ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" value="<?= set_value('email', $user->email) ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('email') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="phone"
                                value="<?= set_value('phone', $user->phone ?? '') ?>" class="form-control">

                            <span class="text-danger">
                                <?= (isset($validation)) ? $validation->showError('phone') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="form-control"><?= set_value('address', $user->address ?? '') ?></textarea>

                            <span class="text-danger">
                                <?= (isset($validation)) ? $validation->showError('address') : '' ?>
                            </span>
                        </div>
                        
                        <div class="form-group">
                            <label for=""><input type="image" src="" alt=""></label>
                            <input type="file" name="image" id="image" class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('image') : '' ?></span>
                        </div>
                        <div class="form-group px-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" id="status"
                                    <?= ($user->status == 1) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0" id="status2"
                                    <?= ($user->status == 0) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="status2">Inactive</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>