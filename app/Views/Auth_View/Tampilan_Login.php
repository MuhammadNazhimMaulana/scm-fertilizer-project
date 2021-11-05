<?= $this->extend('Template/Layouts/Auth') ?>
<?= $this->section('auth') ?>
<?php

$username = [
    'name' => 'username',
    'id' => 'username',
    'value' => null,
    'class' => 'form-control'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];

$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'value' => 'Login',
    'class' => 'btn btn-danger w-50',
    'type' => 'submit'
];

$session = session();
$errors = $session->getFlashdata('errors');
?>

   <!-- Awal Login -->
    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 bg-white rounded p-4 shadow">
                <div class="row justify-content-center mb-4">
                    <p class="text-center  mb-4">Login SCM</p>
                    <img src="<?= base_url('img/Bonevian.png') ?>" class="w-25" />
                </div>

                <?= form_open('Auth/Authorisasi/login') ?>
                    <div class="mb-4">
                        <?= form_label("Username", "username") ?>
                        <?= form_input($username) ?>
                    </div>

                    <div class="mb-4">
                        <?= form_label("Password", "password") ?>
                        <?= form_password($password) ?>
                    </div>

                    <div class="mb-4 d-flex justify-content-center">

                        <!-- Form submit terkait submit-->
                        <?= form_submit($submit) ?>
                    </div>

                <?= form_close() ?>
                
                <p class="mb-0 text-center">Belum Register? <a href="<?= site_url('Auth/Authorisasi/register') ?>" class="text-decoration-none">Daftar Disini</a></p>
            </div>
        </div>
    </div>
    <!-- Akhir Login -->

    <?= $this->endSection() ?>
