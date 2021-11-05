<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\Pengguna_M;
use App\Entities\Pengguna_E;

class Authorisasi extends BaseController
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

    public function register()
    {
        $data_auth = [
            'title' => 'Halaman Register'
        ];

        if ($this->request->getPost()) {

            // Validasi data yang di post
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'register');

            $errors = $this->validation->getErrors();

            //Jika tidak ada error
            if (!$errors) {

                $model = new Pengguna_M();
                $anggota = new Pengguna_E();

                $anggota->fill($data);

                $anggota->password = $this->request->getPost('password');
                $anggota->role = 0;

                $model->save($anggota);

                $data_login = [
                    'title' => 'Halaman Login'
                ];

                return view('Auth_View/Tampilan_Login', $data_login);
            }

            $this->session->setFlashdata('errors', $errors);
        }

        return view('Auth_View/Tampilan_Register', $data_auth);
    }

    public function login()
    {
        $data = [
            'title' => 'Halaman Login'
        ];

        if ($this->request->getPost()) {

            // Validasi data yang di post
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');

            $errors = $this->validation->getErrors();

            if ($errors) {
                return view('login');
            }

            $model = new Pengguna_M();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $model->where('username', $username)->first();

            if (password_verify($password, $user->password) == false) {

                $this->session->setFlashdata('errors', ['Password Salah']);
            } else {
                $session_data = [
                    'username' => $user->username,
                    'id_user' => $user->id_user,
                    'role' => $user->role,
                    'isLoggedIn' => TRUE
                ];

                $this->session->set($session_data);

                return redirect()->to(site_url('Admin/Main_A/home'));
            }
            
            $this->session->setFlashdata('errors', $errors);
            
        }
        return view('Auth_View/Tampilan_Login', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('Auth/Authorisasi/login'));
    }
}