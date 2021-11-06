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

// Order Item
$nomor_pesanan = [
    'name' => 'id_pesanan',
    'id' => 'id_pesanan',
    'type' => 'hidden',
    'value' => $pesanan->id_pesanan,
    'class' => 'form-control'
];
  
$nomor_produk = [
    'name' => 'id_produk',
    'id' => 'id_produk',
    'type' => 'hidden',
    'value' => null,
    'class' => 'form-control'
];
  
$nama_produk = [
    'name' => 'nama_produk',
    'id' => 'nama_pupuk',
    'options' => $daftar_produk,
    'class' => 'form-control'
];
  
$jumlah_pesan = [
    'name' => 'jumlah_pesan',
    'id' => 'jumlah_pesan',
    'type' => 'number',
    'value' => null,
    'class' => 'form-control'
];
  
$harga_pupuk = [
    'name' => 'harga_item',
    'id' => 'harga_pupuk',
    'readonly' => true,
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
                <?= form_open('Admin/Item_pesanan_A/tambah_order/' . $pesanan->id_pesanan) ?>
                <div class="row mt-5">

                    <?= form_input($nomor_pesanan) ?>
                    <?= form_input($nomor_produk) ?>

                    <div class="col-md-4 mb-4">
                        <?= form_label("Nama Produk", "nama_produk") ?>
                        <?= form_dropdown($nama_produk) ?>
                    </div>
                    <div class="col-md-4 mb-4">
                        <?= form_label("Jumlah Pesanan", "jumlah_pesan") ?>
                        <?= form_input($jumlah_pesan) ?>
                    </div>

                    <div class="col-md-4 mb-4">
                        <?= form_label("Harga Produk", "harga_pupuk") ?>
                        <?= form_input($harga_pupuk) ?>
                    </div>
                </div>

                    <div class="mb-4 d-flex justify-content-center">

                        <!-- Form submit terkait submit-->
                        <?= form_submit($submit) ?>
                    </div>

                <?= form_close() ?>

            </div>
        </div>
            <!-- Ini Tabel transaksi Sementara -->
            <div class="col-lg-12 mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php $i = 1;?>
                            <?php foreach ($order as $index => $orders) :?>
                            <th scope="row"><?= $i++ ?></th>
                                <td><?= $orders->id_pesanan ?></td>
                                <td><?= $orders->nama_produk ?></td>
                                <td><?= $orders->jumlah_pesan ?></td>
                                <td><?= $orders->harga_item ?></td>
                                <td>
                                    <a href="#modalUpdate<?= $orders->id_item_order ?>" data-bs-toggle="modal" onclick="" class="btn btn-warning">Update</a>
                                    <a href="#modalDelete<?= $orders->id_item_order ?>" data-bs-toggle="modal" onclick="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach ?>

                            <tr>
                                <td colspan="4">Total Bayar</td>
                                <td colspan="2"><?= $total[0]->jumlah ?></td>
                            </tr>
                        </tbody>
                    </table>
    </div>
</div>


<!-- Awal Modal Update -->
      <!-- Modal -->
      <?php foreach ($order as $index => $orders) :?>
        <!-- Mendapatkan Nilai dari yang dipilih -->
            <?php
                $nomor_order = [
                    'name' => 'id_pesanan',
                    'id' => 'id_pesanan',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'value' => $orders->id_pesanan,
                    'readonly' => true
                    ];

                $nomor_barang = [
                    'name' => 'id_produk',
                    'id' => 'id_produk',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'value' => $orders->id_produk,
                    'readonly' => true
                    ];

                $produk_pupuk = [
                    'name' => 'nama_produk',
                    'id' => 'nama_produk',
                    'options' => $daftar_produk,
                    'class' => 'form-control',
                    'selected' => $orders->nama_produk,
                    'readonly' => true
                    ];

                $banyak_order = [
                    'name' => 'jumlah_pesan',
                    'id' => 'jumlah_pesan',
                    'type' => 'number',
                    'class' => 'form-control',
                    'value' => $orders->jumlah_pesan,
                    ];

                $harga_barang = [
                    'name' => 'harga_item',
                    'id' => 'harga_item',
                    'class' => 'form-control',
                    'value' => $orders->harga_item,
                    'readonly' => true
                    ];

            ?>
        
        <div class="modal fade" id="modalUpdate<?= $orders->id_item_order ?>" tabindex="-1" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Perubahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  
                    <!-- Awal Input Item -->
                        <?= form_open('Admin/Item_Pesanan_A/update_order/'. $orders->id_item_order) ?>
                            <div class="row">
                                <div class="col-sm-4 input">
                                    <?= form_label("Nama Produk", "produk_pupuk") ?>
                                    <?= form_dropdown($produk_pupuk) ?>
                                </div>
                                                    
                                <div class="col-sm-4 input">
                                    <?= form_label("Jumlah Pesan", "banyak_order") ?>
                                    <?= form_input($banyak_order) ?>
                                </div>
                                
                                <div class="col-sm-4 input">
                                    <?= form_label("Harga Barang", "harga_barang") ?>
                                    <?= form_input($harga_barang) ?>
                                </div>
                                
                                <div class="col-sm-4 input">
                                    <?= form_input($nomor_barang) ?>
                                    <?= form_input($nomor_order) ?>
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
      <?php foreach ($order as $index => $orders) :?>
        <!-- Mendapatkan Nilai dari yang dipilih -->
            <?php
                $order = [
                    'name' => 'id_item_order',
                    'id' => 'id_item_order',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'value' => $orders->id_item_order,
                    'readonly' => true
                    ];
            ?>
        
        <div class="modal fade" id="modalDelete<?= $orders->id_item_order ?>" tabindex="-1" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  
                    <!-- Awal Input Item -->
                        <?= form_open('Admin/Item_Pesanan_A/hapus_order/'. $orders->id_item_order) ?>
                            <div class="row">

                                <div class="col-sm-4 input">
                                    <?= form_input($order) ?>
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
<?= $this->section('script')?>

<!-- Mendapatkan Harga Otomatis -->
    <script>
        $(document).ready(function(){

            $('#nama_pupuk').change(function(){

                var nama_pupuk = $('#nama_pupuk').val();

                var action = 'get_harga';

                if(nama_pupuk != '')
                {
                    $.ajax({
                        url:"<?= base_url('Admin/Item_Pesanan_A/action'); ?>",
                        method:"POST",
                        data:{nama_pupuk:nama_pupuk, action:action},
                        dataType:"JSON",
                        success:function(data)
                        {
                            
                            $('#harga_pupuk').val(data.harga_pupuk);
                            $('#id_produk').val(data.id_produk);
                        }
                    });

                }
                else
                {
                    $('#harga_pupuk').val('');
                }
            });

        });
    </script>
<?= $this->endSection() ?>
