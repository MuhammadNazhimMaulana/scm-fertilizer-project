<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pembelian_M;
use App\Entities\Pembelian_E;


class Pembelian_A extends BaseController
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
        $model = new Pembelian_M();

        $keyword = '';

        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "title" => 'Pembelian',
            "pembelian" => $model->like('tbl_pembelian.lama_pesanan', $keyword)->paginate(3, 'pembelian'),
            "pager" => $model->pager,
            "keyword" => $keyword
        ];

        return view('Admin_View/Pembelian_View/view_pembelian', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_pembelian = $this->request->uri->getSegment(4);

        $model = new Pembelian_M();

        $pembelian = $model->find($id_pembelian);

        // Data yang akan dikirim ke view specific
        $data = [
            "pembelian" => $pembelian,
            "title" => 'Pembelian'
        ];

        return view('Admin_View/Pembelian_View/view_specific_pembelian', $data);
    }

    public function delete()
    {
        $id_pembelian = $this->request->uri->getSegment(4);

        $model = new Pembelian_M();

        $delete = $model->delete($id_pembelian);

        return redirect()->to(site_url('Admin/Pembelian_A/read'));
    }

    public function buy_check()
    {
        $id_pembelian = $this->request->uri->getSegment(4);

        $model = new Pembelian_M();

        // Dapatkan Post
        $data_perubahan = $this->request->getPost();

        $pembelian = new Pembelian_E();
        $pembelian->id_pembelian = $id_pembelian;
        $pembelian->fill($data_perubahan);

        //Input Harga
        $pembelian->updated_at = date("Y-m-d H:i:s");

        $model->save($pembelian);

        $segments = ['Admin', 'Pembelian_A', 'check_out_beli', $id_pembelian];

        return redirect()->to(site_url($segments));
    }

    public function check_out_beli()
    {
        $id_pembelian = $this->request->uri->getSegment(4);

        $model = new Pembelian_M();

        $pembelian = $model->find($id_pembelian);

        $data = [
            "title" => 'Pembelian',
            'pembelian' => $pembelian
        ];

        if ($this->request->getPost()) {
            $data_final = $this->request->getPost();
            $this->validation->run($data_final, 'pembelian_update');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $pembelian = new Pembelian_E();
                $pembelian->id_pembelian = $id_pembelian;
                $pembelian->fill($data_final);

                $pembelian->updated_at = date("Y-m-d H:i:s");

                $model->save($pembelian);

                $segments = ['Admin', 'Pembelian_A', 'view', $id_pembelian];

                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }

        return view('Admin_View/Pembelian_View/check_out_pembelian', $data);
    }
}
