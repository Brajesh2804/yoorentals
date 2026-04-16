<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>
<div class="content-wrapper">
    <main>
        <!-- <div class="container-fluid px-4"> -->

        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2>Change Password</h2>
                <a href="<?= base_url('admin/profile') ?>" class="btn btn-info">Back</a>
            </div>
        </div>
        <?php if (session()->has('message')) {
            echo session()->get('message');
        } ?>

        <div class="card shadow-lg border-0 mb-4">
            <!-- <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div> -->
            <div class="card-body">
                <form autocomplete="off" action="<?= base_url('admin/profile/change_password') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <?php /* <div class="col-md-8 my-2">
                 <div class="form-group">
                     <label for="oldpwd">Old Password</label>
                     <input type="password" class="form-control" name="oldpwd" id="oldpwd" value="<?=set_value('oldpwd'); ?>" placeholder="Old Password">
                     <span class="text-danger"><?=isset($validation)?$validation->showError('oldpwd'):''; ?></span>
                 </div>
             </div> */ ?>
                        <div class="col-md-8 my-2">
                            <div class="form-group">
                                <label for="pwd">New Password</label>
                                <input type="password" class="form-control" name="pwd" id="pwd"
                                    value="<?= set_value('pwd'); ?>" placeholder="Enter Password">
                                <span
                                    class="text-danger"><?= isset($validation) ? $validation->showError('pwd') : ''; ?></span>
                            </div>
                        </div>
                        <div class="col-md-8 my-2">
                            <div class="form-group">
                                <label for="cpwd">Confirm Password</label>
                                <input type="password" class="form-control" name="cpwd" id="cpwd"
                                    value="<?= set_value('cpwd'); ?>" placeholder="Enter Confirm Password">
                                <span
                                    class="text-danger"><?= isset($validation) ? $validation->showError('cpwd') : ''; ?></span>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary me-3">Submit</button>

                </form>
            </div>
        </div>
        <!-- </div> -->
    </main>
</div>
<?php if (isset($password_changed) && $password_changed): ?>
    <script type="text/javascript">
        setTimeout(function () {
            
            window.location.href = "<?= base_url('/wpsadmin') ?>";
        }, 2000);
    </script>
<?php endif; ?>

<?= $this->endSection() ?>