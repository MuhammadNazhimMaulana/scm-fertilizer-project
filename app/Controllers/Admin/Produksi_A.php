<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Produksi_M;
use App\Entities\Produksi_E;


class Produk_A extends BaseController
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
}
