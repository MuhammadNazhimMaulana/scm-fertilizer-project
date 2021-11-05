<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pesanan_M;
use App\Entities\Pesanan_E;

use App\Models\Item_Order_M;
use App\Entities\Item_Order_E;

class Item_Pesanan_A extends BaseController
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

    public function order()
    {
        // Dapatkan Id dari segmen
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Item_Order_M();
        $model_pesanan = new Pesanan_M();

        $orderan = $model->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_item_pesanan.id_pesanan')->join('tbl_storage', 'tbl_storage.id_storage = tbl_item_pesanan.id_storage')->where('tbl_item_pesanan.id_pesanan', $id_pesanan)->first();

        $data = [
            'title' => 'Item Pesanan',
            'pesanan' => $orderan,
            'pesanan' => $model_pesanan->find($id_pesanan)
        ];

        return view('Admin_View/Item_Pesanan_Admin/order_item', $data);
    }

    public function tambah_order(){
        
    }  

    public function hapus_order(){

    }    
}
