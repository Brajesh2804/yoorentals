<?= $this->extend('admin/_layouts/master') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="card">

        <div class="card-header">

            <h3>Subscriber Details</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="200">Subscriber ID</th>

                    <td><?= $subscriber->id ?></td>

                </tr>

                <tr>

                    <th>Email</th>

                    <td><?= esc($subscriber->email) ?></td>

                </tr>

            </table>

            <a href="<?= base_url('admin/subscribers') ?>"
               class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>