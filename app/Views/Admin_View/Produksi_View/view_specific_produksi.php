<?= $this->extend('Template/Layouts/Admin') ?>
<?= $this->section('content_admin');
$session = session();
?>
<div class="text">

    <div class="row justify-content-center">
        <div class="col-md-6 mt-5 ms-5">
            <div class="card">
                <h2 class="card-header text-center">Data Produksi</h2>
                <div class="card-body">
                    <a href="<?= site_url('Admin/Produksi_A/read') ?>" class="btn btn-primary mb-3">Kembali ke Daftar</a>
                    <h3 class="text-center mb-5"><?= $produksi->tanggal_produksi ?></h3>
                    <p><?= $produksi->produksi_selesai ?> adalah Tanggal Selesainya</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>