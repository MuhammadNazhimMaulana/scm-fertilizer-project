<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin') ?>
<?php

    $nama_material = [
        'name' => 'nama_material',
        'id' => 'nama_material',
        'value' => null,
        'class' => 'form-control'
    ];
  
    $jumlah_material = [
        'name' => 'jumlah_material',
        'id' => 'jumlah_material',
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
    <div class="row justify-content-center h-100">
        <div class="card w-50 my-auto">
            <div class="card-header text-center">
                <h1>Form Tambah Material</h1>
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
                <?= form_open('Admin/Material_A/create') ?>

                <div class="form-group mt-3">
                        <?= form_label("Nama Material", "nama_material") ?>
                        <?= form_input($nama_material) ?>
                </div>

                <div class="form-group mt-3">
                        <?= form_label("Jumlah Material", "jumlah_material") ?>
                        <?= form_input($jumlah_material) ?>
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
