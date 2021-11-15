<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Produksi_M;
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

        $data = [
            "produksi" => $model->like('tbl_produksi.tanggal_produksi', $keyword)->paginate(3, 'produksi'),
            "pager" => $model->pager,
            "title" => 'Produksi',
            "keyword" => $keyword
        ];

        return view('Admin_View/Produksi_View/view_produksi', $data);
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
}
