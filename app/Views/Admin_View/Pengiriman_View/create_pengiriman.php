<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php


$id_pesanan = [
    'name' => 'id_pesanan',
    'id' => 'id_pesanan',
    'options' => $daftar_pesanan,
    'class' => 'form-control'
];


$alamat = [
    'name' => 'alamat',
    'id' => 'alamat',
    'value' => null,
    'class' => 'form-control'
];

$ongkir = [
    'name' => 'ongkir',
    'id' => 'ongkir',
    'type' => 'number',
    'value' => null,
    'class' => 'form-control'
];

$total_bayar = [
    'name' => 'total_bayar',
    'id' => 'total_bayar',
    'type' => 'number',
    'value' => null,
    'class' => 'form-control'
];

$nama_penerima = [
    'name' => 'nama_penerima',
    'id' => 'nama_penerima',
    'value' => null,
    'class' => 'form-control'
];

$tlp_penerima = [
    'name' => 'tlp_penerima',
    'id' => 'tlp_penerima',
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
    <div class="row justify-content-center h-100">
        <div class="card w-50 my-auto">
            <div class="card-header text-center">
                <h1>Form Tambah Pesanan</h1>
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
                <?= form_open('Admin/Pengiriman_A/create') ?>

                <div class="form-group mt-3">
                    <?= form_label("Nomor Pesanan", "id_pesanan") ?>
                    <?= form_dropdown($id_pesanan) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Alamat", "alamat") ?>
                    <?= form_textarea($alamat) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Ongkos Kirim", "ongkir") ?>
                    <?= form_input($ongkir) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Total Pembayaran", "total_bayar") ?>
                    <?= form_input($total_bayar) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Nama Penerima", "nama_penerima") ?>
                    <?= form_input($nama_penerima) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Telepon Penerima", "tlp_penerima") ?>
                    <?= form_input($tlp_penerima) ?>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <!-- Form submit terkait submit-->
                    <?= form_submit($submit) ?>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>