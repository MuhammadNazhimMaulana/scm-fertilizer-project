<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk_M extends Model
{
    protected $table         = 'tbl_produk';
    protected $primaryKey    = 'id_produk';
    protected $allowedFields = ['nama_pupuk','id_storage', 'harga_pupuk', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Produk_E';
    protected $useTimestamps = true;
}