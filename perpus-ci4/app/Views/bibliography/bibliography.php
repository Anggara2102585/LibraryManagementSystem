<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <a href="bibliography/add" type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Copies</th>
                    <th style="width: 150px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($items as $data) : ?>
                    <tr>
                        <td><?= $i ?>.</td>
                        <td><img src="img/<?= $data['cover'] ?>" style="width: 50px;"></td>
                        <td><?= $data['title'] ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['copies'] ?></td>
                        <td>
                            <a href="bibliography/edit/<?= $data['id_book'] ?>" type="button" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="bibliography/delete" method="post" class="d-inline">
                                <input type="hidden" name="id_book" value="<?= $data['id_book'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirm deletion')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="bibliography/detail/<?= $data['id_book'] ?>" type="button" class="btn btn-sm btn-info">
                                Items
                            </a>
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

<?= $this->endSection() ?>