<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Material_M;

use App\Models\Produksi_M;

use App\Models\Item_Produksi_M;
use App\Entities\Item_Produksi_E;

// Untuk validation production_item

class Item_Produksi_A extends BaseController
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

    public function production()
    {
        // Dapatkan Id dari segmen
        $id_produksi = $this->request->uri->getSegment(4);

        $model = new Item_Produksi_M();
        $model_produksi = new Produksi_M();

        // Mendapatkan seluruh data Material
        $model_material = new Material_M();

        $material = $model_material->findAll();
        $list_item = [null => 'Pilih Material'];

        // Buat looping
        foreach ($material as $materials) {
            $list_item[$materials->id_material] = $materials->nama_material;
        }

        $produksi = $model->join('tbl_material', 'tbl_material.id_material = tbl_item_produksi.id_material')->join('tbl_produksi', 'tbl_produksi.id_produksi = tbl_item_produksi.id_produksi')->where('tbl_item_produksi.id_produksi', $id_produksi)->findAll();

        // Mendapatkan Total Beli
        $total_kebutuhan = $model->select('SUM(tbl_item_produksi.jumlah_digunakan) AS jumlah')->where('tbl_item_produksi.id_produksi', $id_produksi)->get();


        $data = [
            "title" => 'Item Produksi',
            'daftar_material' => $list_item,
            "produksi" => $produksi,
            "production" => $model_produksi->find($id_produksi),
            'total' => $total_kebutuhan->getResult()
        ];

        return view('Admin_View/Item_Produksi_Admin/production', $data);
    }


    public function tambah_produksi()
    {

        $id_produksi = $this->request->uri->getSegment(4);

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data_production = $this->request->getPost();
            $this->validation->run($data_production, 'production_item');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Item_Produksi_M();

                $item = new Item_Produksi_E();

                // Fill untuk assign value data kecuali gambar
                $item->fill($data_production);

                //Input
                $item->created_at = date("Y-m-d H:i:s");

                $model->save($item);

                $segments = ['Admin', 'Item_Produksi_A', 'production', $id_produksi];

                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }
    }


    public function update_produksi()
    {
        $id_item = $this->request->uri->getSegment(4);

        $data_item_produksi = $this->request->getPost();

        // Simpan data
        $model = new Item_Produksi_M();

        $items = new Item_Produksi_E();
        $items->id_item = $id_item;
        $items->fill($data_item_produksi);

        //Input Total Harga
        $items->updated_at = date("Y-m-d H:i:s");

        $model->save($items);

        $id_produksi = $items->id_produksi;

        $segments = ['Admin', 'Item_Produksi_A', 'production', $id_produksi];

        return redirect()->to(site_url($segments));
    }

    public function hapus_produksi()
    {

        $id_item = $this->request->uri->getSegment(4);

        $data_produksi = $this->request->getPost();

        $model = new Item_Produksi_M();

        $items = new Item_Produksi_E();
        $items->id_item = $id_item;
        $items->fill($data_produksi);

        // Hapus Data
        $model->delete($id_item);

        // id_produksi agar kembali ke input
        $id_produksi = $items->id_produksi;

        $segments = ['Admin', 'Item_Produksi_A', 'production', $id_produksi];

        return redirect()->to(site_url($segments));
    }
}
