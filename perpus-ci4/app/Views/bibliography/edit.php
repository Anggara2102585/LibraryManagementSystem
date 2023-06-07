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

<!-- general form elements -->
<div class="card">
    <div class="card-header">
        <a href="bibliography" type="button" class="btn btn-default">Back</a>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="bibliography/editProcess" method="post" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
        <input type="hidden" name="id_book" value="<?= $item['id_book'] ?>">
        <input type="hidden" name="oldCover" value="<?= $item['cover'] ?>">
        <div class="card-body">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" name="title" value="<?= $item['title'] ?>">
            </div>
            <div class="form-group">
                <label>ISBN:</label>
                <input type="number" class="form-control" name="isbn" value="<?= $item['isbn'] ?>">
            </div>
            <div class="form-group">
                <label>Publication date:</label>
                <input type="date" class="form-control" name="publication_date" value="<?= $item['publication_date'] ?>">
            </div>
            <div class="form-group">
                <label>Category:</label>
                <input type="hidden" val-category="<?= $item['id_category'] ?>" id="val-category">
                <select class="form-control select2" id="category-select" style="width: 100%;" name="id_category" value="<?= $item['id_category'] ?>">
                    <?php foreach ($category as $data) : ?>
                        <option value="<?= $data['id_category'] ?>"><?= $data['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <select class="select2" multiple="multiple" style="width: 100%;" name="author[]">
                    <?php foreach ($author as $data) : ?>
                        <option value="<?= $data['id_author'] ?>" <?= in_array($data['id_author'], $authored) ? 'selected' : '' ?>>
                            <?= $data['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Number of copies:</label>
                <input disabled type="number" class="form-control" name="copies" value="<?= $item['copies'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Cover</label>
                <div class="">
                    <img src="/img/<?= $item['cover'] ?>" class="img-thumbnail img-preview">
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="cover" onchange="previewImg()">
                        <label class="custom-file-label" for="exampleInputFile"><?= $item['cover'] ?></label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<!-- /.card -->

<?= $this->endSection() ?>