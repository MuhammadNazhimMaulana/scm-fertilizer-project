<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pesanan_M;
use App\Entities\Pesanan_E;

use App\Models\Item_Vendor_M;
use App\Entities\Item_Vendor_E;

class Item_Vendor_A extends BaseController
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

    public function buy()
    {

        return view('Admin_View/Item_Vendor_Admin/buy_item');
    }
}
