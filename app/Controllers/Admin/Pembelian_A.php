<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pembelian_M;
use App\Entities\Pembelian_E;


class Pembelian_A extends BaseController
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
        $data = [
            "title" => 'Pembelian',
        ];

        return view('Admin_View/Material_View/view_material', $data);
    }


}
