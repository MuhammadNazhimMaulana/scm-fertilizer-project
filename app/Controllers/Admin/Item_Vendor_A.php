<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Item_Order_E;
use App\Models\Vendor_M;
use App\Entities\Vendor_E;

use App\Models\Pembelian_M;
use App\Entities\Pembelian_E;

use App\Models\Item_Vendor_M;
use App\Entities\Item_Vendor_E;

use App\Models\Material_M;

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
        // Dapatkan Id dari segmen
        $id_pembelian = $this->request->uri->getSegment(4);

        $model = new Item_Vendor_M();
        $model_pembelian = new Pembelian_M();

        $model_vendor = new Vendor_M();

        $vendor = $model_vendor->findAll();
        $list_vendor = [null => 'Pilih Satu'];

        // Buat looping
        foreach ($vendor as $vendors) {
            $list_vendor[$vendors->nama_vendor] = $vendors->nama_vendor;
        }

        $model_material = new Material_M();

        $material = $model_material->findAll();
        $list_item = [null => 'Pilih Material'];

        // Buat looping
        foreach ($material as $materials) {
            $list_item[$materials->id_material] = $materials->nama_material;
        }

        $pembelian = $model->join('tbl_material', 'tbl_material.id_material = tbl_item_vendor.id_material')->join('tbl_pembelian', 'tbl_pembelian.id_pembelian = tbl_item_vendor.id_pembelian')->join('tbl_vendor', 'tbl_vendor.id_vendor = tbl_item_vendor.id_vendor')->where('tbl_item_vendor.id_pembelian', $id_pembelian)->findAll();

        // Mendapatkan Total Beli
        $total_beli = $model->select('SUM(tbl_item_vendor.item_beli) AS jumlah')->where('tbl_item_vendor.id_pembelian', $id_pembelian)->get();

        $data = [
            'title' => 'Vendor Item',
            'daftar_vendor' => $list_vendor,
            'daftar_item' => $list_item,
            'beli' => $pembelian,
            'pembelian' => $model_pembelian->find($id_pembelian),
            'total' => $total_beli->getResult()
        ];

        return view('Admin_View/Item_Vendor_Admin/buy_item', $data);
    }


    public function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_vendor') {
                $model = new Vendor_M();

                $data = $model->where('nama_vendor', $this->request->getVar('nama_vendor'))->first();

                echo json_encode($data);
            }
        }
    }

    public function tambah_pembelian()
    {

        $id_pembelian = $this->request->uri->getSegment(4);

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data_pembelian = $this->request->getPost();
            $this->validation->run($data_pembelian, 'buy_item');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Item_Vendor_M();

                $item = new Item_Order_E();

                // Fill untuk assign value data kecuali gambar
                $item->fill($data_pembelian);

                //Input
                $item->created_at = date("Y-m-d H:i:s");

                $model->save($item);

                $segments = ['Admin', 'Item_Vendor_A', 'buy', $id_pembelian];

                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }
    }

    public function update_pembelian()
    {
        $id_item_vendor = $this->request->uri->getSegment(4);

        $data_item_order = $this->request->getPost();

        // Simpan data
        $model = new Item_Vendor_M();

        $items = new Item_Vendor_E();
        $items->id_item_vendor = $id_item_vendor;
        $items->fill($data_item_order);

        //Input Total Harga
        $items->updated_at = date("Y-m-d H:i:s");

        $model->save($items);

        $id_pembelian = $items->id_pembelian;

        $segments = ['Admin', 'Item_Vendor_A', 'buy', $id_pembelian];

        return redirect()->to(site_url($segments));
    }

    public function hapus_pembelian()
    {

        $id_item_vendor = $this->request->uri->getSegment(4);

        $data_order = $this->request->getPost();

        $model = new Item_Vendor_M();

        $items = new Item_Vendor_E();
        $items->id_item_vendor = $id_item_vendor;
        $items->fill($data_order);

        // Hapus Data
        $delete = $model->delete($id_item_vendor);

        // id_pembelian agar kembali ke input
        $id_pembelian = $items->id_pembelian;

        $segments = ['Admin', 'Item_Vendor_A', 'buy', $id_pembelian];

        return redirect()->to(site_url($segments));
    }
}
