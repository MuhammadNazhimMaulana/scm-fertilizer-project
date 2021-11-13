<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

$id_pembelian = [
    'name' => 'id_pembelian',
    'id' => 'id_pembelian',
    'readonly' => true,
    'value' => $pembelian->id_pembelian,
    'class' => 'form-control'
];

$lama_pesanan = [
    'name' => 'lama_pesanan',
    'id' => 'lama_pesanan',
    'readonly' => true,
    'value' => $pembelian->lama_pesanan,
    'class' => 'form-control'
];

// Beli Item Vendor
$nomor_pembelian = [
    'name' => 'id_pembelian',
    'id' => 'id_pembelian',
    'type' => 'hidden',
    'value' => $pembelian->id_pembelian,
    'class' => 'form-control'
];

$nomor_vendor = [
    'name' => 'id_vendor',
    'id' => 'id_vendor',
    'type' => 'hidden',
    'value' => null,
    'class' => 'form-control'
];

$nama_vendor = [
    'name' => 'nama_vendor',
    'id' => 'nama_vendor',
    'options' => $daftar_vendor,
    'class' => 'form-control'
];

$item_beli = [
    'name' => 'item_beli',
    'id' => 'item_beli',
    'type' => 'number',
    'value' => null,
    'class' => 'form-control'
];

$nama_item = [
    'name' => 'id_material',
    'id' => 'nama_item',
    'options' => $daftar_item,
    'class' => 'form-control'
];

$jumlah_beli = [
    'name' => 'jumlah_beli',
    'id' => 'jumlah_beli',
    'type' => 'hidden',
    'value' => $total[0]->jumlah,
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

<h1 class="text-center">Pick Item</h1>

<div class="container mt-4 vh-100">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-header text-center">
                <h5>Pilih Item dari Vendor</h5>
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
                        <?= form_label("Nomor Pembelian", "id_pembelian") ?>
                        <?= form_input($id_pembelian) ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Lama Pesanan", "lama_pesanan") ?>
                        <?= form_input($lama_pesanan) ?>
                    </div>
                </div>

                <!-- Membuat Form dengan Form Helper -->
                <?= form_open('Admin/Item_Vendor_A/tambah_pembelian/' . $pembelian->id_pembelian) ?>

                <div class="row mt-5">
                    <?= form_input($nomor_pembelian) ?>
                    <?= form_input($nomor_vendor) ?>

                    <div class="col-md-4 mb-4">
                        <?= form_label("Nama Vendor", "nama_vendor") ?>
                        <?= form_dropdown($nama_vendor) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Jumlah Pesanan (Kg)", "item_beli") ?>
                        <?= form_input($item_beli) ?>
                    </div>

                    <div class="col-md-4 mb-4">
                        <?= form_label("Nama Material", "nama_item") ?>
                        <?= form_dropdown($nama_item) ?>
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
                        <th scope="col">Nomor pembelian</th>
                        <th scope="col">Nama Vendor</th>
                        <th scope="col">Nama item</th>
                        <th scope="col">Jumlah Beli</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($beli as $index => $buys) : ?>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $buys->id_pembelian ?></td>
                            <td><?= $buys->nama_vendor ?></td>
                            <td><?= $buys->nama_material ?></td>
                            <td><?= $buys->item_beli ?></td>
                            <td>
                                <a href="#modalUpdate<?= $buys->id_item_vendor ?>" data-bs-toggle="modal" onclick="" class="btn btn-warning">Update</a>
                                <a href="#modalDelete<?= $buys->id_item_vendor ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
                            </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="4">Total Beli (Kg)</td>
                    <td colspan="2"><?= $total[0]->jumlah ?></td>
                </tr>
                </tbody>
            </table>

            <!-- Awal Penyesuaian Transaksi Pembelian -->
            <?= form_open('Admin/Pembelian_A/buy_check/' . $pembelian->id_pembelian) ?>

            <div class="col-sm-4">
                <?= form_input($jumlah_beli) ?>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <!-- Form submit terkait submit-->
                <?= form_submit($submit) ?>
            </div>
            <?= form_close() ?>
            <!-- Akhir Penyesuaian Transaksi Pembelian -->

        </div>
    </div>
</div>

<!-- Awal Modal Update -->
<!-- Modal -->
<?php foreach ($beli as $index => $buys) : ?>
    <!-- Mendapatkan Nilai dari yang dipilih -->
    <?php
    $nomor_beli = [
        'name' => 'id_pembelian',
        'id' => 'id_pembelian',
        'type' => 'hidden',
        'class' => 'form-control',
        'value' => $buys->id_pembelian,
        'readonly' => true
    ];

    $nomor_vendor = [
        'name' => 'id_vendor',
        'id' => 'id_vendor',
        'type' => 'hidden',
        'class' => 'form-control',
        'value' => $buys->id_vendor,
        'readonly' => true
    ];

    $nomor_material = [
        'name' => 'id_material',
        'id' => 'id_material',
        'options' => $daftar_item,
        'class' => 'form-control',
        'selected' => $buys->id_material,
        'readonly' => true
    ];

    $banyak_beli = [
        'name' => 'item_beli',
        'id' => 'banyak_beli',
        'type' => 'number',
        'class' => 'form-control',
        'value' => $buys->item_beli,
    ];

    ?>

    <div class="modal fade" id="modalUpdate<?= $buys->id_item_vendor ?>" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Perubahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Awal Input Item -->
                    <?= form_open('Admin/Item_Vendor_A/update_pembelian/' . $buys->id_item_vendor) ?>
                    <div class="row">
                        <div class="col-sm-6 input">
                            <?= form_label("Nama Material", "nomor_material") ?>
                            <?= form_dropdown($nomor_material) ?>
                        </div>

                        <div class="col-sm-6 input">
                            <?= form_label("Jumlah Pesan", "banyak_beli") ?>
                            <?= form_input($banyak_beli) ?>
                        </div>

                        <div class="col-sm-4 input">
                            <?= form_input($nomor_vendor) ?>
                            <?= form_input($nomor_beli) ?>
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
<?php foreach ($beli as $index => $buys) : ?>
    <!-- Mendapatkan Nilai dari yang dipilih -->
    <?php
    $membeli = [
        'name' => 'id_pembelian',
        'id' => 'order',
        'type' => 'hidden',
        'class' => 'form-control',
        'value' => $buys->id_pembelian,
        'readonly' => true
    ];

    ?>

    <div class="modal fade" id="modalDelete<?= $buys->id_item_vendor ?>" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Awal Input Item -->
                    <?= form_open('Admin/Item_Vendor_A/hapus_pembelian/' . $buys->id_item_vendor) ?>
                    <div class="row">

                        <div class="col-sm-4 input">
                            <?= form_input($membeli) ?>
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

<!-- Bagian Script -->
<?= $this->section('script') ?>

<!-- Mendapatkan Harga Otomatis -->
<script>
    $(document).ready(function() {

        $('#nama_vendor').change(function() {

            var nama_vendor = $('#nama_vendor').val();

            var action = 'get_vendor';

            if (nama_vendor != '') {
                $.ajax({
                    url: "<?= base_url('Admin/Item_Vendor_A/action'); ?>",
                    method: "POST",
                    data: {
                        nama_vendor: nama_vendor,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_vendor').val(data.id_vendor);
                    }
                });

            } else {
                $('#id_vendor').val('');
            }
        });

    });
</script>
<?= $this->endSection() ?>