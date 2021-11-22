<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

$nama_produk = [
    'name' => 'nama_produk',
    'id' => 'nama_produk',
    'readonly' => true,
    'value' => $storage->nama_produk,
    'class' => 'form-control'
];

$isi_storage = [
    'name' => 'isi_storage',
    'id' => 'isi_storage',
    'type' => 'number',
    'value' => $storage->isi_storage,
    'class' => 'form-control'
];

$tanggal_simpan = [
    'name' => 'tanggal_simpan',
    'id' => 'tanggal_simpan',
    'value' => $storage->tanggal_simpan,
    'class' => 'form-control'
];

$nomor_produksi = [
    'name' => 'id_produksi',
    'id' => 'id_produksi',
    'type' => 'number',
    'readonly' => true,
    'value' => $storage->id_produksi,
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
                <h1>Form Update Storage</h1>
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
                <?= form_open('Admin/Storage_A/update/' . $storage->id_storage) ?>

                <div class="form-group mt-3">
                    <?= form_label("Nama Pupuk", "nama_produk") ?>
                    <?= form_input($nama_produk) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Harga Pupuk", "nomor_produksi") ?>
                    <?= form_input($nomor_produksi) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Isi Storage", "isi_storage") ?>
                    <?= form_input($isi_storage) ?>
                </div>

                <div class="form-group mt-3">
                    <?= form_label("Tanggal Simpan", "tanggal_simpan") ?>
                    <?= form_input($tanggal_simpan) ?>
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