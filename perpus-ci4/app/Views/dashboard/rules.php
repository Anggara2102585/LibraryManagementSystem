<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->section('content') ?>

<?php if (session()->get('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?= session()->getFlashdata('message') ?></strong>
    </div>
<?php endif ?>
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
    <form action="dashboard/updateRules" method="post" class="form-horizontal">
        <div class="card-body">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Loan Periode (day)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" name="loan_periode" value="<?= $rules['loan_periode'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Fine Amount (Rp)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassword3" name="fine_amount" value="<?= $rules['fine_amount'] ?>">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>