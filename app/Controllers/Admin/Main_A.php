<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pengguna_M;
use App\Entities\Pengguna_E;

class Main_A extends BaseController
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

    public function home()
    {
        $data_dashboard = [
            'title' => 'Halaman Register'
        ];

        return view('Admin_View/Main_View/dashboard');
    }
}