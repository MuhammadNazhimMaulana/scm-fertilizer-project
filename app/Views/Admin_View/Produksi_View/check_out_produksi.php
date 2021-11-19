<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

$penggunaan_item = [
    'name' => 'penggunaan_item',
    'id' => 'penggunaan_item',
    'readonly' => true,
    'value' => $produksi->penggunaan_item,
    'class' => 'form-control'
];

$tanggal_produksi = [
    'name' => 'tanggal_produksi',
    'id' => 'tanggal_produksi',
    'readonly' => true,
    'value' => $produksi->tanggal_produksi,
    'class' => 'form-control'
];

$hasil_produksi = [
    'name' => 'hasil_produksi',
    'id' => 'hasil_produksi',
    'type' => 'number',
    'value' => null,
    'class' => 'form-control'
];

$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-success',
    'type' => 'submit'
];

$session = session();
$errors = $session->getFlashdata('errors');
?>

<div class="container mt-4 vh-100">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-header text-center">
                <h5>Selesaikan Produksi</h5>
            </div>
            <div class="card-body">
                <?php if ($errors != null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Terjadi Kesalahan</h4>
                        <hr>
                        <p class="mb-0">
                            <?php foreach ($errors as $err) {
                                echo $err . '<br>';
                            }

                            ?>
                        </p>
                    </div>
                <?php endif ?>

                <!-- Membuat Form dengan Form Helper -->
                <?= form_open('Admin/Produksi_A/check_out_produksi/' . $produksi->id_produksi) ?>
                <div class="row mt-5">

                    <div class="col-md-4 mb-4">
                        <?= form_label("Jumlah Penggunaan Material (Kg)", "penggunaan_item") ?>
                        <?= form_input($penggunaan_item) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Tanggal Mulai Produksi", "tanggal_produksi") ?>
                        <?= form_input($tanggal_produksi) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Hasil Produksi (Kg)", "hasil_produksi") ?>
                        <?= form_input($hasil_produksi) ?>
                    </div>

                </div>

                <div class="mb-4 d-flex justify-content-center">

                    <!-- Form submit terkait submit-->
                    <?= form_submit($submit) ?>
                </div>

                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>