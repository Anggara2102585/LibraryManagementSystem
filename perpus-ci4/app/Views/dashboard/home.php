<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->section('content') ?>

<!-- Small Box (Stat card) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $collections['id_book'] ?></h3>
                <p>Total of collections</p>
            </div>
            <div class="icon">
                <i class="fas fa-bookmark"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $items['id_book_detail'] ?></h3>
                <p>Total of items</p>
            </div>
            <div class="icon">
                <i class="fas fa-barcode"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $borrowed['id_book_detail'] ?></h3>
                <p>Borrowed</p>
            </div>
            <div class="icon">
                <i class="fas fa-archive"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $available['id_book_detail'] ?></h3>
                <p>Available</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<?= $this->endSection() ?>