$(document).on('click', '#btn-delete', function () {
    $('.modal-body #id-delete').val($(this).attr('data-id'));
})

$(document).on('click', '#btn-edit', function () {
    $('.modal-body #id-edit').val($(this).attr('data-id'));
    $('.modal-body #name-edit').val($(this).attr('data-name'));
    $('.modal-body #email-edit').val($(this).attr('data-email'));
})

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    // buat edit item
    $('#category-select').select2('val', $('#val-category').attr('val-category'))
})

function previewImg() {
    const cover = document.querySelector('#exampleInputFile');
    const coverLabel = document.querySelector('.custom-file-label');
    const imgPreview = document.querySelector('.img-preview');

    coverLabel.textContent = cover.files[0].name;

    const fileCover = new FileReader();
    fileCover.readAsDataURL(cover.files[0]);

    fileCover.onload = function (e) {
        imgPreview.src = e.target.result;
    }
}