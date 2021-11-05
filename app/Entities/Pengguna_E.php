<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pengguna_E extends Entity
{
    // // Logika untuk menyimpan File gambar
    // public function setFotoPengguna($file)
    // {
    //     $fileName = $file->getRandomName();
    //     $writePath = './upload/Foto Pengguna';

    //     // Save ke folder uploads
    //     $file->move($writePath, $fileName);

    //     // Simpan nama file
    //     $this->attributes['foto_pengguna'] = $fileName;
    //     return $this;
    // }

    // Set Password user
    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }
}