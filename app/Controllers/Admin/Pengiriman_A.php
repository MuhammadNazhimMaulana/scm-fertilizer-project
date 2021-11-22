<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pesanan_M;

use App\Models\Pengiriman_M;
use App\Entities\Pengiriman_E;


class Pengiriman_A extends BaseController
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
        $model = new Pengiriman_M();

        $keyword = '';

        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "pengiriman" => $model->like('tbl_pengiriman.alamat', $keyword)->paginate(3, 'pengiriman'),
            "pager" => $model->pager,
            "title" => 'Pengiriman',
            "keyword" => $keyword
        ];

        return view('Admin_View/Pengiriman_View/view_pengiriman', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_pengiriman = $this->request->uri->getSegment(4);

        $model = new Pengiriman_M();

        $pengiriman = $model->find($id_pengiriman);

        // Data yang akan dikirim ke view specific
        $data = [
            "pengiriman" => $pengiriman,
            "title" => 'Pengiriman'
        ];

        return view('Admin_View/Pengiriman_View/view_specific_pengiriman', $data);
    }

    public function create()
    {
        // Mendapatkan seluruh data Pesanan
        $model_pesanan = new Pesanan_M();

        $pesanan = $model_pesanan->findAll();
        $list_nomor_pesanan = [null => 'Pilih Nama Pemesan'];

        // Buat looping
        foreach ($pesanan as $orders) {
            $list_nomor_pesanan[$orders->id_pesanan] = $orders->nama_pemesan;
        }

        $data_pengiriman = [
            "title" => 'Pengiriman',
            "daftar_pesanan" => $list_nomor_pesanan
        ];

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'pengiriman');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Pengiriman_M();

                $pengiriman = new Pengiriman_E();

                // Fill untuk assign value data kecuali gambar
                $pengiriman->fill($data);
                $pengiriman->created_at = date("Y-m-d H:i:s");

                $model->save($pengiriman);

                $id_pengiriman = $model->insertID();

                $segments = ['Admin', 'Pengiriman_A', 'view', $id_pengiriman];

                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));
            }
            $this->session->setFlashdata('errors', $errors);
        }
        return view('Admin_View/Pengiriman_View/create_pengiriman', $data_pengiriman);
    }

    public function update()
    {
        $id_pengiriman = $this->request->uri->getSegment(4);

        $model = new Pengiriman_M();

        $pengiriman = $model->find($id_pengiriman);

        $data = [
            'pengiriman' => $pengiriman,
            "title" => 'Pengiriman'
        ];

        if ($this->request->getPost()) {
            $data_pengiriman = $this->request->getPost();
            $this->validation->run($data_pengiriman, 'update_pengiriman');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $storage = new Pengiriman_E();
                $storage->id_pengiriman = $id_pengiriman;
                $storage->fill($data_pengiriman);

                $storage->updated_at = date("Y-m-d H:i:s");

                $model->save($storage);

                $segments = ['Admin', 'Pengiriman_A', 'view', $id_pengiriman];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Pengiriman_View/update_pengiriman', $data);
    }

    public function delete()
    {
        $id_pengiriman = $this->request->uri->getSegment(4);

        $model = new Pengiriman_M();

        $delete = $model->delete($id_pengiriman);

        return redirect()->to(site_url('Admin/Pengiriman_A/read'));
    }
}
