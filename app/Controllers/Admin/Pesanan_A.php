<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pesanan_M;
use App\Entities\Pesanan_E;

use App\Models\Item_Order_M;
use App\Entities\Item_Order_E;

class Pesanan_A extends BaseController
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
        $model = new Pesanan_M();

        $keyword = '';

        if($this->request->getPost())
        {
            $keyword = $this->request->getPost('keyword');
        }

        $data = [
            "pesanan" => $model->like('tbl_pesanan.nama_pemesan', $keyword)->paginate(3, 'pesanan'),
            "pager" => $model->pager,
            "title" => 'Pesanan',
            "keyword" => $keyword
        ];

        return view('Admin_View/Pesanan_Admin/view_pemesanan', $data);
    }

    public function view()
    {
        // Dapatkan Id dari segmen
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Pesanan_M();

       $pesanan = $model->find($id_pesanan);

        // Data yang akan dikirim ke view specific
        $data = [
            "pesanan" =>$pesanan,
            "title" => 'Pesanan'
        ];

        return view('Admin_View/Pesanan_Admin/view_specific_pemesanan', $data);
    }

    public function create()
    {
        $data_pesanan = [
            "title" => 'Pesanan'
        ];

        if ($this->request->getPost()) {
            // Jikalau ada data di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'pesanan');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // Simpan data
                $model = new Pesanan_M();

               $pesanan = new Pesanan_E();

                // Fill untuk assign value data kecuali gambar
               $pesanan->fill($data);
               $pesanan->created_at = date("Y-m-d H:i:s");

                $model->save($pesanan);

                $id_pesanan = $model->insertID();


                $segments = ['Admin', 'Item_Pesanan_A', 'order', $id_pesanan];
    
                // Akan redirect ke /Admin/Rak_A/view/$id_barang
                return redirect()->to(site_url($segments));

            }
            $this->session->setFlashdata('errors', $errors);
        }
        return view('Admin_View/Pesanan_Admin/create_pemesanan', $data_pesanan);
    }

    public function update()
    {
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Pesanan_M();

       $pesanan = $model->find($id_pesanan);

        $data = [
            'pesanan' =>$pesanan,
            "title" => 'Pesanan'
        ];

        if ($this->request->getPost()) {
            $data_pesanan = $this->request->getPost();
            $this->validation->run($data_pesanan, 'pesanan_update');
            $errors = $this->validation->getErrors();

            if (!$errors) {
               $pesanan = new Pesanan_E();
               $pesanan->id_pesanan = $id_pesanan;
               $pesanan->fill($data_pesanan);

               $pesanan->updated_at = date("Y-m-d H:i:s");

                $model->save($pesanan);

                $segments = ['Admin', 'Pesanan_A', 'view', $id_pesanan];

                return redirect()->to(site_url($segments));
            }
        }

        return view('Admin_View/Pesanan_Admin/update_pemesanan', $data);
    }

    public function delete()
    {
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Pesanan_M();

        $delete = $model->delete($id_pesanan);

        return redirect()->to(site_url('Admin/Pesanan_A/read'));
    }

    public function order_check()
    {
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Pesanan_M();

        // Dapatkan Post
        $data_perubahan = $this->request->getPost();

        $pesanan = new Pesanan_E();
        $pesanan->id_pesanan = $id_pesanan;
        $pesanan->fill($data_perubahan);

        //Input Harga
        $pesanan->updated_at = date("Y-m-d H:i:s");

        $model->save($pesanan);

        $segments = ['Admin', 'Pesanan_A', 'check_out', $id_pesanan];

        return redirect()->to(site_url($segments));
    }

    public function check_out(){
        $id_pesanan = $this->request->uri->getSegment(4);

        $model = new Pesanan_M();

        $pesanan = $model->find($id_pesanan);

        $data = [
            "title" => 'Pesanan',
            'order' => $pesanan
        ];
       
        return view('Admin_View/Pesanan_Admin/check_out_pesanan', $data);
    }

}
