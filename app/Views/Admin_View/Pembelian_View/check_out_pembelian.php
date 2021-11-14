<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

$jumlah_beli = [
    'name' => 'jumlah_beli',
    'id' => 'jumlah_beli',
    'readonly' => true,
    'value' => $pembelian->jumlah_beli,
    'class' => 'form-control'
];

$status = [
    'name' => 'status',
    'id' => 'status',
    'type' => 'hidden',
    'value' => $pembelian->status,
    'class' => 'form-control'
];

$lama_pesanan = [
    'name' => 'lama_pesanan',
    'id' => 'lama_pesanan',
    'readonly' => true,
    'type' => 'date',
    'value' => $pembelian->lama_pesanan,
    'class' => 'form-control'
];

if ($pembelian->jumlah_beli != null) {
    $harga_beli = [
        'name' => 'harga_beli',
        'id' => 'harga_beli',
        'readonly' => true,
        'type' => 'number',
        'value' => $pembelian->jumlah_beli * 20000,
        'class' => 'form-control'
    ];
} else {
    $harga_beli = [
        'name' => 'harga_beli',
        'id' => 'harga_beli',
        'readonly' => true,
        'type' => 'number',
        'value' => null,
        'class' => 'form-control'
    ];
}

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
                <h5>Selesaikan Pembelian</h5>
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
                <?= form_open('Admin/Pembelian_A/check_out_beli/' . $pembelian->id_pembelian) ?>
                <div class="row mt-5">

                    <div class="col-md-4 mb-4">
                        <?= form_label("Jumlah Pembelian Material (Kg)", "jumlah_beli") ?>
                        <?= form_input($jumlah_beli) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Tanggal Pesanan", "lama_pesanan") ?>
                        <?= form_input($lama_pesanan) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Harge Pembelian", "harga_beli") ?>
                        <?= form_input($harga_beli) ?>
                    </div>

                    <?= form_input($status) ?>

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