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

$session = session();
?>

<h1 class="text-center">Material</h1>

<div class="row mt-5">
  <div class="col-md-12">
    <div class="card text-dark bg-light mb-3">
      <div class="card-header"></div>
      <div class="card-body">
        <a href="<?= site_url('Admin/Material_A/create') ?>" class="btn btn-success">Tambah Material</a>
        <h5 class="card-title text-center mb-3">Daftar Seluruh Material</h5>

        <!-- Awal Searching -->
        <?= form_open('Admin/Material_A/read') ?>
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
              <th scope="col">Nama Material</th>
              <th scope="col">Jumlah Material</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php $i = 1;?>
              <?php foreach ($material as $index =>$materials) :?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?=$materials->nama_material ?></td>
              <td><?=$materials->jumlah_material ?></td>
              <td>
                <a href="<?= site_url('Admin/Material_A/view/' .$materials->id_material) ?>" class="btn btn-primary">View</a>
                <a href="<?= site_url('Admin/Material_A/update/' .$materials->id_material) ?>" class="btn btn-warning">Update</a>
                <a href="#modalDelete<?=$materials->id_material ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
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
<?php foreach ($material as $index =>$materials) :?>
<div class="modal fade" id="modalDelete<?=$materials->id_material ?>" tabindex="-1" data-bs-backdrop="static">
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
          <button class="btn btn-danger"><a href="<?= site_url('Admin/Material_A/delete/' .$materials->id_material) ?>">Delete</a></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>


<?= $this->endSection() ?>
