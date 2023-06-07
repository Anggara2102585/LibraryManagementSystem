<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->section('content') ?>

<a href="circulation/finish" type="button" class="btn btn-block btn-danger">
    Finish Transaction
</a>
<br>
<!-- Member data -->
<!-- general form elements disabled -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Member</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Name</label>
                    <p><?= $member['member_name'] ?></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>ID</label>
                    <p><?= $member['id_member'] ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- textarea -->
                <div class="form-group">
                    <label>Email</label>
                    <p><?= $member['email'] ?></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Register date</label>
                    <p><?= $member['register_date'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Tab -->
<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Borrow</a> <!-- Loan -->
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Borrowed</a> <!-- Current Loan -->
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Borrow History</a> <!-- Loan History -->
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Fines</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
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
            <!-- LOAN TAB -->
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <form action="circulation/processLoan" method="post" class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">ID Item</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputEmail3" name="id_book_detail">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Borrow item</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- CURRENT LOAN TAB -->
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ID item</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Loan date</th>
                            <th>Due return</th>
                            <th>Fine</th>
                            <th style="width: 95px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($loan as $data) : ?>
                            <tr>
                                <td><?= $i ?>.</td>
                                <td><?= $data['id_book_detail'] ?></td>
                                <td><?= $data['title'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['loan_date'] ?></td>
                                <td><?= $data['due_return_date'] ?></td>
                                <td><?= $data['fine_amount'] ?></td>
                                <td>
                                    <a href="circulation/return/<?= $data['id_loan'] ?>/<?= $data['id_book_detail'] ?>" type="button" class="btn btn-sm btn-primary">
                                        <strong>Return</strong>
                                    </a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- LOAN HISTORY TAB -->
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ID item</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Due return</th>
                            <th>Return date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($loan_history as $data) : ?>
                            <tr>
                                <td><?= $i ?>.</td>
                                <td><?= $data['id_book_detail'] ?></td>
                                <td><?= $data['title'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['due_return_date'] ?></td>
                                <td><?= $data['return_date'] ?></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- FINES TAB -->
            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                <strong class="text-danger">
                    Total of unpaid fines (Rp): <?= $unpaid ?>
                </strong>
                <form action="circulation/payment" method="post" onsubmit="return confirm('Payment confirmation')">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-success">Add payment</button>
                        </div>
                        <input type="number" class="form-control" placeholder="Payment amount" name="amount" required>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Amount</th>
                            <th>Payment date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($payment_history as $data) : ?>
                            <tr>
                                <td><?= $i ?>.</td>
                                <td><?= $data['amount'] ?></td>
                                <td><?= $data['payment_date'] ?></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

<?= $this->endSection() ?>