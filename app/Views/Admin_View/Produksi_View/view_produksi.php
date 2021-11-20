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

$create = [
    'name' => 'create',
    'value' => 'New Production',
    'type' => 'submit',
    'class' => 'btn btn-outline-success'
];

$nomor_pupuk = [
    'name' => 'id_produk',
    'id' => 'id_produk',
    'options' => $daftar_produk,
    'class' => 'form-control'
];

$submit = [
    'name' => 'submit',
    'value' => 'Cari',
    'type' => 'submit',
    'class' => 'btn btn-outline-secondary'
];

$session = session();
?>

<h1 class="text-center">Pembelian</h1>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="card text-dark bg-light mb-3">
            <div class="card-header"></div>
            <div class="card-body">

                <!-- Awal Create -->
                <div class="input-group mb-3 justify-content-left">
                    <a href="#modalInsert" data-bs-toggle="modal" onclick="" class="btn btn-success">Insert Data</a>
                </div>
                <!-- Akhir Create -->

                <h5 class="card-title text-center mb-3">Daftar Seluruh Produksi</h5>

                <!-- Awal Searching -->
                <?= form_open('Admin/Produksi_A/read') ?>
                <div class="input-group mb-3 justify-content-end">
                    <div>
                        <?= form_input($keyword) ?>
                    </div>
                    <div>
                        <?= form_submit($submit) ?>
                    </div>
                </div>
                <?= form_close() ?>
                <!-- Akhir Searching -->

                <p class="card-text mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Produksi</th>
                            <th scope="col">Hasil Produksi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($produksi as $index => $productions) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $productions->tanggal_produksi ?></td>
                                <td><?= $productions->hasil_produksi ?></td>
                                <td>
                                    <a href="<?= site_url('Admin/Produksi_A/view/' . $productions->id_produksi) ?>" class="btn btn-primary">View</a>
                                    <a href="<?= site_url('Admin/Item_Produksi_A/production/' . $productions->id_produksi) ?>" class="btn btn-warning">Produksi</a>
                                    <a href="#modalDelete<?= $productions->id_produksi ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                </table>
            </div>
            <div class="card-footer">
                <?= $pager->links('material', 'custom_pagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($produksi as $index => $productions) : ?>
    <div class="modal fade" id="modalDelete<?= $productions->id_produksi ?>" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger"><a href="<?= site_url('Admin/Produksi_A/delete/' . $productions->id_produksi) ?>">Delete</a></button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Insert-->
<div class="modal fade" id="modalInsert" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Produksi Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open('Admin/Produksi_A/create') ?>

                <div class="row">
                    <div class="col-sm-12 input">
                        <?= form_label("Nama Produk", "nomor_pupuk") ?>
                        <?= form_dropdown($nomor_pupuk) ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end mt-3">
                    <!-- Form submit terkait submit-->
                    <?= form_submit($create) ?>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>


    <?= $this->endSection() ?>