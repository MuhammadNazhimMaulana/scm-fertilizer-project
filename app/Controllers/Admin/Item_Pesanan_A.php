<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pesanan_M;
use App\Entities\Pesanan_E;

use App\Models\Item_Order_M;
use App\Entities\Item_Order_E;

use App\Models\Produk_M;
use App\Entities\Produk_E;

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

        $model_produk = new Produk_M();

        $produk = $model_produk->findAll();
        $list_produk = [null => 'Pilih Satu'];

        // Buat looping
        foreach ($produk as $products) {
            $list_produk[$products->nama_pupuk] = $products->nama_pupuk;
        }

        $orderan = $model->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_item_pesanan.id_pesanan')->join('tbl_produk', 'tbl_produk.id_produk = tbl_item_pesanan.id_produk')->where('tbl_item_pesanan.id_pesanan', $id_pesanan)->findAll();
        
        // Mendapatkan Total Bayar
        $total_bayar = $model->select('SUM(tbl_item_pesanan.harga_item) AS jumlah')->where('tbl_item_pesanan.id_pesanan', $id_pesanan)->get();

        $data = [
            'title' => 'Item Pesanan',
            'daftar_produk' => $list_produk,
            'order' => $orderan,
            'pesanan' => $model_pesanan->find($id_pesanan),
            'total' => $total_bayar->getResult()
        ];

        return view('Admin_View/Item_Pesanan_Admin/order_item', $data);
    }

    public function action()
    {
        if($this->request->getVar('action'))
        {
            $action = $this->request->getVar('action');

            if($action == 'get_harga')
            {
                $model = new Produk_M();

                $data = $model->where('nama_pupuk', $this->request->getVar('nama_pupuk'))->first();

                echo json_encode($data);
            }
        }
    }

    public function tambah_order(){

        $id_pesanan = $this->request->uri->getSegment(4);
        
        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data_orderan = $this->request->getPost();
            $this->validation->run($data_orderan, 'order_item');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Item_Order_M();

               $item = new Item_Order_E();
                
               // Fill untuk assign value data kecuali gambar
               $item->fill($data_orderan);

               //Input
               $item->created_at = date("Y-m-d H:i:s");

                $model->save($item);

                $segments = ['Admin', 'Item_Pesanan_A', 'order', $id_pesanan];

                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));

            }

            $this->session->setFlashdata('errors', $errors);
        }        
    }  

    public function update_order()
    {
        $id_item_order = $this->request->uri->getSegment(4);

        $data_item_order = $this->request->getPost();

            // Simpan data
            $model = new Item_Order_M();

            $items = new Item_Order_E();
            $items->id_item_order = $id_item_order;
            $items->fill($data_item_order);

            //Input Total Harga
            $items->updated_at = date("Y-m-d H:i:s");

            $model->save($items);

            $id_pesanan = $items->id_pesanan;
            
            $segments = ['Admin', 'Item_Pesanan_A', 'order', $id_pesanan];

            return redirect()->to(site_url($segments));
    }

    public function hapus_order(){

        $id_item_order = $this->request->uri->getSegment(4);

        $data_order = $this->request->getPost();

        $model = new Item_Order_M();

        $items = new Item_Order_E();
        $items->id_item_order = $id_item_order;
        $items->fill($data_order);

        // Hapus Data
        $delete = $model->delete($id_item_order);

        // id_pesanan agar kembali ke input
        $id_pesanan = $items->id_pesanan;
        
        $segments = ['Admin', 'Item_Pesanan_A', 'order', $id_pesanan];

        return redirect()->to(site_url($segments));
    }    
}
