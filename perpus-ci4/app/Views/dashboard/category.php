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

<!-- Category List -->
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Add category</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="todo-list" data-widget="todo-list">
            <?php foreach ($category as $data) : ?>
                <li>
                    <!-- text -->
                    <span class="text"><?= $data['name'] ?></span>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <button type="button" data-toggle="modal" data-target="#modalEdit" class="btn btn-sm btn-warning" id="btn-edit" data-id="<?= $data['id_category'] ?>" data-name="<?= $data['name'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#modalDelete" class="btn btn-sm btn-danger" id="btn-delete" data-id="<?= $data['id_category'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Add category</button>
    </div>
</div>
<!-- /.card -->

<!-- Modal Add -->
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/addCategory'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addName">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Category name">
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

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="dashboard/deleteCategory" method="post">
                <div class="modal-body">
                    Confirm deletion
                    <input type="hidden" name="id_category" id="id-delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/editCategory'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_category" id="id-edit">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" name="name" id="name-edit">
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