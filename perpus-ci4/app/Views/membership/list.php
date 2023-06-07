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
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Add member</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Register date</th>
                    <th style="width: 95px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($member as $data) : ?>
                    <tr>
                        <td><?= $i ?>.</td>
                        <td><?= $data['id_member'] ?></td>
                        <td><?= $data['member_name'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['register_date'] ?></td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#modalEdit" class="btn btn-sm btn-warning" id="btn-edit" data-id="<?= $data['id_member'] ?>" data-name="<?= $data['member_name'] ?>" data-email="<?= $data['email'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#modalDelete" class="btn btn-sm btn-danger" id="btn-delete" data-id="<?= $data['id_member'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
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
                <h5 class="modal-title">Add Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/addMember'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="member_name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
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
            <form action="member/deleteMember" method="post">
                <div class="modal-body">
                    Confirm deletion
                    <input type="hidden" name="id_member" id="id-delete">
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
                <h5 class="modal-title">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/editMember'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_member" id="id-edit">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" name="member_name" id="name-edit">
                        <label for="editEmail">Email</label>
                        <input type="text" class="form-control" name="email" id="email-edit">
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