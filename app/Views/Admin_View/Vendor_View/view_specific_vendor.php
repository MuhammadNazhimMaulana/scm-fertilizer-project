<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin');
$session = session();
?>
<div class="text">

    <div class="row justify-content-center">
        <div class="col-md-6 mt-5 ms-5">
            <div class="card">
                <h2 class="card-header text-center">Data Vendor</h2>
                <div class="card-body">
                    <?php if ($session->getFlashdata('informasi')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $session->getFlashdata('informasi') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($session->getFlashdata('update')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $session->getFlashdata('update') ?>
                        </div>
                    <?php endif ?>
                    <a href="<?= site_url('Admin/Vendor_A/read') ?>" class="btn btn-primary mb-3">Kembali ke Daftar</a>
                    <h3 class="text-center mb-5"><?= $vendor->nama_vendor ?></h3>
                    <p><?= $vendor->alamat_vendor ?> adalah Jumlahnya</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>