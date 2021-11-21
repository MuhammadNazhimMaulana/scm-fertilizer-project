<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// Produk
use App\Models\Produk_M;
use App\Models\Produksi_M;

// Storage
use App\Models\Storage_M;
use App\Entities\Storage_E;

use App\Entities\Produksi_E;


class Produksi_A extends BaseController
{
    public function __construct()
    {
        // Memanggil Helper
        helper('form');

        // Load Validasi
        $this->validation = \Config\Services::validation();

        // Load Session
        $this->session = session();
    }

    public function read()
    {
        $model = new Produksi_M();

        $keyword = '';

        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }

        // Mendapatkan seluruh data Produk
        $model_produks = new Produk_M();

        $produk = $model_produks->findAll();
        $list_produk = [null => 'Pilih Produk untuk Produksi'];

        // Buat looping
        foreach ($produk as $products) {
            $list_produk[$products->id_produk] = $products->nama_pupuk;
        }

        $data = [
            "produksi" => $model->like('tbl_produksi.tanggal_produksi', $keyword)->paginate(3, 'produksi'),
            "pager" => $model->pager,
            "title" => 'Produksi',
            'daftar_produk' => $list_produk,
            "keyword" => $keyword
        ];

        return view('Admin_View/Produksi_View/view_produksi', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_produksi = $this->request->uri->getSegment(4);

        $model = new Produksi_M();

        $produksi = $model->find($id_produksi);

        // Data yang akan dikirim ke view specific
        $data = [
            "produksi" => $produksi,
            "title" => 'Produksi'
        ];

        return view('Admin_View/Produksi_View/view_specific_produksi', $data);
    }

    public function create()
    {
        // Remember Validation

        $data = $this->request->getPost();

        // Simpan data
        $model = new Produksi_M();

        $produksi = new Produksi_E();

        // Fill untuk assign value data kecuali gambar
        $produksi->fill($data);
        $produksi->tanggal_produksi = date("Y-m-d");
        $produksi->created_at = date("Y-m-d H:i:s");

        $model->save($produksi);

        $id_produksi = $model->insertID();

        $segments = ['Admin', 'Item_Produksi_A', 'production', $id_produksi];

        // Akan redirect ke /Admin/Rak_A/view/$id_barang
        return redirect()->to(site_url($segments));
    }

    public function check_production()
    {
        $id_produksi = $this->request->uri->getSegment(4);

        $model = new Produksi_M();

        // Dapatkan Post
        $data_perubahan = $this->request->getPost();

        $produksi = new Produksi_E();
        $produksi->id_produk = $this->request->getPost('nomor_pupuk');
        $produksi->id_produksi = $id_produksi;
        $produksi->fill($data_perubahan);

        //Input Harga
        $produksi->updated_at = date("Y-m-d H:i:s");

        $model->save($produksi);

        $segments = ['Admin', 'Produksi_A', 'check_out_produksi', $id_produksi];

        return redirect()->to(site_url($segments));
    }

    public function check_out_produksi()
    {
        $id_produksi = $this->request->uri->getSegment(4);

        $model = new Produksi_M();

        $produksi = $model->join('tbl_produk', 'tbl_produk.id_produk = tbl_produksi.id_produk')->where('tbl_produksi.id_produksi', $id_produksi)->first();

        $data = [
            "title" => 'Produksi',
            'produksi' => $produksi
        ];

        if ($this->request->getPost()) {
            $data_final = $this->request->getPost();
            $this->validation->run($data_final, 'update_produksi');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $production = new Produksi_E();
                $production->id_produksi = $id_produksi;
                $production->fill($data_final);

                $production->produksi_selesai = date("Y-m-d");
                $production->updated_at = date("Y-m-d H:i:s");

                $model->save($production);

                // Menyimpan hasil produksi ke Storage
                $model_storage = new Storage_M();

                $storage = new Storage_E();
                $storage->id_produksi = $id_produksi;
                $storage->nama_produk = $produksi->nama_pupuk;
                $storage->tanggal_simpan = date("Y-m-d");
                $storage->created_at = date("Y-m-d H:i:s");

                $model_storage->save($storage);

                $segments = ['Admin', 'Storage_A', 'read'];

                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }

        return view('Admin_View/Produksi_View/check_out_produksi', $data);
    }
}
