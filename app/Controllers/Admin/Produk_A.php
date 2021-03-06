<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Produk_M;
use App\Entities\Produk_E;


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
        $model = new Produk_M();

        $keyword = '';

        if($this->request->getPost())
        {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "produk" => $model->like('tbl_produk.nama_pupuk', $keyword)->paginate(3, 'produk'),
            "pager" => $model->pager,
            "title" => 'Produk',
            "keyword" => $keyword
        ];

        return view('Admin_View/Produk_View/view_produk', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_produk = $this->request->uri->getSegment(4);

        $model = new Produk_M();

      $produk = $model->find($id_produk);

        // Data yang akan dikirim ke view specific
        $data = [
            "produk" =>$produk,
            "title" => 'Produk'
        ];

        return view('Admin_View/Produk_View/view_specific_produk', $data);
    }

    public function create()
    {
        $data_produk = [
            "title" => 'Produk'
        ];

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'produk');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Produk_M();

              $produk = new Produk_E();

                // Fill untuk assign value data kecuali gambar
              $produk->fill($data);
              $produk->created_at = date("Y-m-d H:i:s");

                $model->save($produk);

                $id_produk = $model->insertID();


                $segments = ['Admin', 'Produk_A', 'view', $id_produk];
    
                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));

            }
            $this->session->setFlashdata('errors', $errors);
        }
        return view('Admin_View/Produk_View/create_produk', $data_produk);
    }

    public function update()
    {
        $id_produk = $this->request->uri->getSegment(4);

        $model = new Produk_M();

      $produk = $model->find($id_produk);

        $data = [
            'produk' =>$produk,
            "title" => 'Produk'
        ];

        if ($this->request->getPost()) {
            $data_pesanan = $this->request->getPost();
            $this->validation->run($data_pesanan, 'produk_update');
            $errors = $this->validation->getErrors();

            if (!$errors) {
              $produk = new Produk_E();
              $produk->id_produk = $id_produk;
              $produk->fill($data_pesanan);

              $produk->updated_at = date("Y-m-d H:i:s");

                $model->save($produk);

                $segments = ['Admin', 'Produk_A', 'view', $id_produk];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Produk_View/update_produk', $data);
    }

    public function delete()
    {
        $id_produk = $this->request->uri->getSegment(4);

        $model = new Produk_M();

        $delete = $model->delete($id_produk);

        return redirect()->to(site_url('Admin/Produk_A/read'));
    }

}
