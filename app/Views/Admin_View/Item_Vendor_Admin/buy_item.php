<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php
$keyword = [
    'name' => 'keyword',
    'value' => $keyword,
    'placeholder' => 'Keyword Pencarian...',
    'class' => 'form-control',
    'type' => 'text'
];

$submit = [
    'name' => 'submit',
    'value' => 'Cari',
    'type' => 'submit',
    'class' => 'btn btn-outline-secondary'
];

$session = session();
?>

<h1 class="text-center">Pick Item</h1>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="card text-dark bg-light mb-3">
            <div class="card-header"></div>
            <div class="card-body">

                <p class="card-text mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer">
                <?= $pager->links('material', 'custom_pagination') ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>