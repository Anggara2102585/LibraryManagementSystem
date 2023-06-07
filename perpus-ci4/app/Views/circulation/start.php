<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->section('content') ?>

<?php if (!session()->get('id_member')) { ?>
    <?php if (session()->get('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><?= session()->getFlashdata('error') ?></strong>
        </div>
    <?php endif ?>

    <div class="card card-info">
        <div class="card-header"></div>
        <!-- form start -->
        <form action="circulation/set" method="post" class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Member ID</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" id="inputEmail3" name="member_id">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-info">Start transactions</button>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </form>
    </div>
<?php } else { ?>
<?php } ?>

<?= $this->endSection() ?>