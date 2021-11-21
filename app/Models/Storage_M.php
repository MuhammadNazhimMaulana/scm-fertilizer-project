<?php

namespace App\Models;

use CodeIgniter\Model;

class Storage_M extends Model
{
    protected $table         = 'tbl_storage';
    protected $primaryKey    = 'id_storage';
    protected $allowedFields = ['id_produksi', 'nama_produk', 'isi_storage', 'tanggal_simpan', 'jam_simpan', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Storage_E';
    protected $useTimestamps = true;
}
