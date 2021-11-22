<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Storage_M;
use App\Entities\Storage_E;


class Storage_A extends BaseController
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
        $model = new Storage_M();

        $keyword = '';

        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "storage" => $model->like('tbl_storage.nama_produk', $keyword)->paginate(3, 'storage'),
            "pager" => $model->pager,
            "title" => 'Storage',
            "keyword" => $keyword
        ];

        return view('Admin_View/Storage_View/view_storage', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_storage = $this->request->uri->getSegment(4);

        $model = new Storage_M();

        $storage = $model->find($id_storage);

        // Data yang akan dikirim ke view specific
        $data = [
            "storage" => $storage,
            "title" => 'Storage'
        ];

        return view('Admin_View/Storage_View/view_specific_storage', $data);
    }


    public function update()
    {
        $id_storage = $this->request->uri->getSegment(4);

        $model = new Storage_M();

        $storage = $model->find($id_storage);

        $data = [
            'storage' => $storage,
            "title" => 'Storage'
        ];

        if ($this->request->getPost()) {
            $data_storage = $this->request->getPost();
            $this->validation->run($data_storage, 'update_storage');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $storage = new Storage_E();
                $storage->id_storage = $id_storage;
                $storage->fill($data_storage);

                $storage->updated_at = date("Y-m-d H:i:s");

                $model->save($storage);

                $segments = ['Admin', 'Storage_A', 'view', $id_storage];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Storage_View/update_storage', $data);
    }

    public function delete()
    {
        $id_storage = $this->request->uri->getSegment(4);

        $model = new Storage_M();

        $delete = $model->delete($id_storage);

        return redirect()->to(site_url('Admin/Storage_A/read'));
    }
}
