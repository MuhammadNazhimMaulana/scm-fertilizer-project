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

$submit = [
  'name' => 'submit',
  'value' => 'Cari',
  'type' =>'submit',
  'class' => 'btn btn-outline-secondary'
];

?>

<h1 class="text-center">Pesanan</h1>

<div class="row mt-5">
  <div class="col-md-12">
    <div class="card text-dark bg-light mb-3">
      <div class="card-header"></div>
      <div class="card-body">
        <a href="<?= site_url('Admin/Pesanan_A/create') ?>" class="btn btn-success">Tambah Pesanan</a>
        <h5 class="card-title text-center mb-3">Daftar Seluruh Pesanan</h5>

        <!-- Awal Searching -->
        <?= form_open('Admin/Admin_A/read') ?>
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
              <th scope="col">Nama Pemesan</th>
              <th scope="col">Pesanan</th>
              <th scope="col">Deadline</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php $i = 1;?>
              <?php foreach ($pesanan as $index => $order) :?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $order->nama_pemesan ?></td>
              <td><?= $order->pesanan ?></td>
              <td><?= $order->deadline ?></td>
              <td>
                <a href="<?= site_url('Admin/Pesanan_A/view/' . $order->id_pesanan) ?>" class="btn btn-primary">View</a>
                <a href="<?= site_url('Admin/Pesanan_A/update/' . $order->id_pesanan) ?>" class="btn btn-warning">Update</a>
                <a href="#modalDelete<?= $order->id_pesanan ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            <?php endforeach ?>
        </table>
      </div>
          <div class="card-footer">
            <?= $pager->links('pesanan', 'custom_pagination') ?>
          </div>
    </div>
  </div>
</div>

<!-- Modal -->
<?php foreach ($pesanan as $index => $order) :?>
<div class="modal fade" id="modalDelete<?= $order->id_pesanan ?>" tabindex="-1" data-bs-backdrop="static">
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
          <button class="btn btn-danger"><a href="<?= site_url('Admin/Pesanan_Admin/delete/' . $order->id_pesanan) ?>">Delete</a></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>


<?= $this->endSection() ?>
