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

<div class="card">
    <div class="card-header">
        <a href="bibliography" type="button" class="btn btn-default">Back</a>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Add item</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>ID Item</th>
                    <th>Status</th>
                    <th>Condition</th>
                    <th style="width: 95px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($items as $data) : ?>
                    <tr>
                        <td><?= $i ?>.</td>
                        <td><?= $data['id_book_detail'] ?></td>
                        <td><?= $data['status'] ?></td>
                        <td><?= $data['book_condition'] ?></td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#modalEdit" class="btn btn-sm btn-warning" id="btn-edit" data-id="<?= $data['id_book_detail'] ?>" data-name="<?= $data['status'] ?>" data-email="<?= $data['book_condition'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="bibliography/deleteDetail" method="post" class="d-inline">
                                <input type="hidden" name="id_book_detail" value="<?= $data['id_book_detail'] ?>">
                                <input type="hidden" name="id_book" value="<?= $data['id_book'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirm deletion')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Add -->
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bibliography/addDetail'); ?>" method="post">
                <input type="hidden" name="id_book" value="<?= $idBook ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="status">
                    </div>
                    <div class="form-group">
                        <label>Condition</label>
                        <input type="text" class="form-control" name="book_condition">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bibliography/editDetail'); ?>" method="post">
                <input type="hidden" name="id_book" value="<?= $idBook ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_book_detail" id="id-edit">
                    <div class="form-group">
                        <label for="editName">Status</label>
                        <input type="text" class="form-control" name="status" id="name-edit">
                        <label for="editEmail">Condition</label>
                        <input type="text" class="form-control" name="book_condition" id="email-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>