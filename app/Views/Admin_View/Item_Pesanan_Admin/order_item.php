<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php
  
$id_pesanan = [
    'name' => 'id_pesanan',
    'id' => 'id_pesanan',
    'readonly' => true,
    'value' => $pesanan->id_pesanan,
    'class' => 'form-control'
];
  
$nama_pemesan = [
    'name' => 'nama_pemesan',
    'id' => 'nama_pemesan',
    'readonly' => true,
    'value' => $pesanan->nama_pemesan,
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
                <h5>Pilih Item Pesanan</h5>
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
                        <?= form_label("Nomor Pesanan", "id_pesanan") ?>
                        <?= form_input($id_pesanan) ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Nama Pelanggan", "nama_pemesan") ?>
                        <?= form_input($nama_pemesan) ?>
                    </div>
                </div>
                
                <!-- Membuat Form dengan Form Helper -->
                <?= form_open('Admin/Item_pesanan_A/tambah_order') ?>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <?= form_label("Nomor Pesanan", "id_pesanan") ?>
                        <?= form_input($id_pesanan) ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?= form_label("Nama Pelanggan", "nama_pemesan") ?>
                        <?= form_input($nama_pemesan) ?>
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
