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

$id_produk = [
    'name' => 'id_produk',
    'id' => 'id_produk',
    'type' => 'hidden',
    'readonly' => true,
    'value' => $production->id_produk,
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

$penggunaan_item = [
    'name' => 'penggunaan_item',
    'id' => 'penggunaan_item',
    'type' => 'hidden',
    'value' => $total[0]->jumlah,
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
                    <td colspan="3">Total Penggunaan Material (Kg)</td>
                    <td colspan="2"><?= $total[0]->jumlah ?></td>
                </tr>
                </tbody>
            </table>

            <!-- Awal Penyesuaian Transaksi Produksi -->
            <?= form_open('Admin/Produksi_A/check_production/' . $production->id_produksi) ?>

            <div class="col-sm-4">
                <?= form_input($penggunaan_item) ?>
                <?= form_input($id_produk) ?>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <!-- Form submit terkait submit-->
                <?= form_submit($submit) ?>
            </div>
            <?= form_close() ?>
            <!-- Akhir Penyesuaian Transaksi Produksi -->

        </div>
    </div>
</div>


<!-- Awal Modal Update -->
<!-- Modal -->
<?php foreach ($produksi as $index => $productions) : ?>
    <!-- Mendapatkan Nilai dari yang dipilih -->
    <?php
    $nmr_material = [
        'name' => 'id_material',
        'id' => 'nmr_material',
        'options' => $daftar_material,
        'selected' => $productions->id_material,
        'class' => 'form-control'
    ];

    $nomor_produksi = [
        'name' => 'id_produksi',
        'id' => 'id_produksi',
        'type' => 'hidden',
        'class' => 'form-control',
        'value' => $productions->id_produksi,
        'readonly' => true
    ];

    $penggunaan = [
        'name' => 'jumlah_digunakan',
        'id' => 'penggunaan',
        'type' => 'number',
        'class' => 'form-control',
        'value' => $productions->jumlah_digunakan,
    ];

    ?>

    <div class="modal fade" id="modalUpdate<?= $productions->id_item ?>" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Perubahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Awal Input Item -->
                    <?= form_open('Admin/Item_Produksi_A/update_produksi/' . $productions->id_item) ?>
                    <div class="row">
                        <div class="col-sm-6 input">
                            <?= form_label("Nama Material", "nmr_material") ?>
                            <?= form_dropdown($nmr_material) ?>
                        </div>

                        <div class="col-sm-6 input">
                            <?= form_label("Jumlah Pemakaian", "penggunaan") ?>
                            <?= form_input($penggunaan) ?>
                        </div>

                        <div class="col-sm-4 input">
                            <?= form_input($nomor_produksi) ?>
                        </div>

                    </div>

                </div>
                <div class="modal-footer mt-3">
                    <div class="d-flex justify-content-end mt-3">
                        <!-- Form submit terkait submit-->
                        <?= form_submit($submit) ?>
                    </div>

                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- Akhir Modal Update -->


<!-- Awal Modal Hapus -->
<!-- Modal -->
<?php foreach ($produksi as $index => $productions) : ?>
    <!-- Mendapatkan Nilai dari yang dipilih -->
    <?php
    $produksi = [
        'name' => 'id_produksi',
        'id' => 'order',
        'type' => 'hidden',
        'class' => 'form-control',
        'value' => $productions->id_produksi,
        'readonly' => true
    ];

    ?>

    <div class="modal fade" id="modalDelete<?= $productions->id_item ?>" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Awal Input Item -->
                    <?= form_open('Admin/Item_Produksi_A/hapus_produksi/' . $productions->id_item) ?>
                    <div class="row">

                        <div class="col-sm-4 input">
                            <?= form_input($produksi) ?>
                        </div>

                    </div>

                </div>
                <div class="modal-footer mt-3">
                    <div class="d-flex justify-content-end mt-3">
                        <!-- Form submit terkait submit-->
                        <?= form_submit($submit) ?>
                    </div>

                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- Akhir Modal Hapus -->

<?= $this->endSection() ?>