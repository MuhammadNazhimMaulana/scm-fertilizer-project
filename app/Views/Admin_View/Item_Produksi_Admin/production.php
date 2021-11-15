<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

$id_produksi = [
    'name' => 'id_produksi',
    'id' => 'id_produksi',
    'readonly' => true,
    'value' => $production->id_produksi,
    'class' => 'form-control'
];

$tanggal_produksi = [
    'name' => 'tanggal_produksi',
    'id' => 'tanggal_produksi',
    'readonly' => true,
    'value' => $production->tanggal_produksi,
    'class' => 'form-control'
];

// Pilih Item Material Produksi
$nomor_produksi = [
    'name' => 'id_produksi',
    'id' => 'id_produksi',
    'type' => 'hidden',
    'value' => $production->id_produksi,
    'class' => 'form-control'
];

$nomor_material = [
    'name' => 'id_material',
    'id' => 'id_material',
    'options' => $daftar_material,
    'class' => 'form-control'
];

$jumlah_digunakan = [
    'name' => 'jumlah_digunakan',
    'id' => 'jumlah_digunakan',
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
                <h5>Pilih Item Produksi</h5>
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


                <div class="row">
                    <div class="col-md-6 mb-4">
                        <?= form_label("Nomor Pesanan", "id_produksi") ?>
                        <?= form_input($id_produksi) ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Nama Pelanggan", "tanggal_produksi") ?>
                        <?= form_input($tanggal_produksi) ?>
                    </div>
                </div>

                <!-- Membuat Form dengan Form Helper -->
                <?= form_open('Admin/Item_Produksi_A/tambah_produksi/' . $production->id_produksi) ?>

                <div class="row mt-5">
                    <?= form_input($nomor_produksi) ?>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Nama Material", "nomor_material") ?>
                        <?= form_dropdown($nomor_material) ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Jumlah Penggunaan (Kg)", "jumlah_digunakan") ?>
                        <?= form_input($jumlah_digunakan) ?>
                    </div>

                </div>

                <div class="mb-4 d-flex justify-content-center">

                    <!-- Form submit terkait submit-->
                    <?= form_submit($submit) ?>
                </div>

                <?= form_close() ?>

            </div>
        </div>

        <div class="col-lg-12 mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nomor Produksi</th>
                        <th scope="col">Nama Material</th>
                        <th scope="col">Jumlah Pakai</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($produksi as $index => $productions) : ?>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $productions->id_produksi ?></td>
                            <td><?= $productions->nama_material ?></td>
                            <td><?= $productions->jumlah_digunakan ?></td>
                            <td>
                                <a href="#modalUpdate<?= $productions->id_item ?>" data-bs-toggle="modal" onclick="" class="btn btn-warning">Update</a>
                                <a href="#modalDelete<?= $productions->id_item ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
                            </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="4">Total Beli (Kg)</td>
                    <td colspan="2"></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>