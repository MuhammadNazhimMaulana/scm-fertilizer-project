<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Vendor_M;
use App\Entities\Vendor_E;


class Vendor_A extends BaseController
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
        $model = new Vendor_M();

        $keyword = '';

        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "vendor" => $model->like('tbl_vendor.nama_vendor', $keyword)->paginate(3, 'vendor'),
            "pager" => $model->pager,
            "title" => 'Vendor',
            "keyword" => $keyword
        ];

        return view('Admin_View/Vendor_View/view_vendor', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_vendor = $this->request->uri->getSegment(4);

        $model = new Vendor_M();

        $vendor = $model->find($id_vendor);

        // Data yang akan dikirim ke view specific
        $data = [
            "vendor" => $vendor,
            "title" => 'Vendor'
        ];

        return view('Admin_View/Vendor_View/view_specific_vendor', $data);
    }

    public function create()
    {
        $data_vendor = [
            "title" => 'Vendor'
        ];

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'vendor');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Vendor_M();

                $vendor = new Vendor_E();

                // Fill untuk assign value data kecuali gambar
                $vendor->fill($data);
                $vendor->created_at = date("Y-m-d H:i:s");

                $model->save($vendor);

                $id_vendor = $model->insertID();


                $segments = ['Admin', 'Vendor_A', 'view', $id_vendor];

                // Pesan
                $this->session->setFlashdata('informasi', 'Berhasil Menambahkan Data Vendor');

                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }

        return view('Admin_View/Vendor_View/create_vendor', $data_vendor);
    }

    public function update()
    {
        $id_vendor = $this->request->uri->getSegment(4);

        $model = new Vendor_M();

        $vendor = $model->find($id_vendor);

        $data = [
            'vendor' => $vendor,
            "title" => 'Material'
        ];

        if ($this->request->getPost()) {
            $data_vendor = $this->request->getPost();
            $this->validation->run($data_vendor, 'vendor_update');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $vendor = new Vendor_E();
                $vendor->id_vendor = $id_vendor;
                $vendor->fill($data_vendor);

                $vendor->updated_at = date("Y-m-d H:i:s");

                $model->save($vendor);

                // Pesan
                $this->session->setFlashdata('update', 'Berhasil Update Data Vendor');

                $segments = ['Admin', 'Vendor_A', 'view', $id_vendor];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Vendor_View/update_vendor', $data);
    }

    public function delete()
    {
        $id_vendor = $this->request->uri->getSegment(4);

        $model = new Vendor_M();

        $delete = $model->delete($id_vendor);

        return redirect()->to(site_url('Admin/Vendor_A/read'));
    }
}
