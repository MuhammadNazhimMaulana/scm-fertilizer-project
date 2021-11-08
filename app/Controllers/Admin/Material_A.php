<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Material_M;
use App\Entities\Material_E;


class Material_A extends BaseController
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
        $model = new Material_M();

        $keyword = '';

        if($this->request->getPost())
        {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "material" => $model->like('tbl_material.nama_material', $keyword)->paginate(3, 'material'),
            "pager" => $model->pager,
            "title" => 'Material',
            "keyword" => $keyword
        ];

        return view('Admin_View/Material_View/view_material', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_material = $this->request->uri->getSegment(4);

        $model = new Material_M();

      $material = $model->find($id_material);

        // Data yang akan dikirim ke view specific
        $data = [
            "material" =>$material,
            "title" => 'Material'
        ];

        return view('Admin_View/Material_View/view_specific_material', $data);
    }

    public function create()
    {
        $data_material = [
            "title" => 'Material'
        ];

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'material');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Material_M();

              $material = new Material_E();

                // Fill untuk assign value data kecuali gambar
              $material->fill($data);
              $material->created_at = date("Y-m-d H:i:s");

                $model->save($material);

                $id_material = $model->insertID();


                $segments = ['Admin', 'Material_A', 'view', $id_material];

                // Pesan
                $this->session->setFlashdata('informasi', 'Berhasil Menambahkan Data Material');
                
                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));

            }
            $this->session->setFlashdata('errors', $errors);
        }

        return view('Admin_View/Material_View/create_material', $data_material);
    }

    public function update()
    {
        $id_material = $this->request->uri->getSegment(4);

        $model = new Material_M();

      $material = $model->find($id_material);

        $data = [
            'material' =>$material,
            "title" => 'Material'
        ];

        if ($this->request->getPost()) {
            $data_material = $this->request->getPost();
            $this->validation->run($data_material, 'material_update');
            $errors = $this->validation->getErrors();

            if (!$errors) {
              $material = new Material_E();
              $material->id_material = $id_material;
              $material->fill($data_material);

              $material->updated_at = date("Y-m-d H:i:s");

                $model->save($material);

                $segments = ['Admin', 'Material_A', 'view', $id_material];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Material_View/update_material', $data);
    }

    public function delete()
    {
        $id_material = $this->request->uri->getSegment(4);

        $model = new Material_M();

        $delete = $model->delete($id_material);

        return redirect()->to(site_url('Admin/Material_A/read'));
    }

}
