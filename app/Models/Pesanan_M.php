<?php

namespace App\Models;

use CodeIgniter\Model;

class Pesanan_M extends Model
{
    protected $table         = 'tbl_pesanan';
    protected $primaryKey    = 'id_pesanan';
    protected $allowedFields = ['pesanan','nama_pemesan', 'jumlah_pesanan', 'harga_total', 'deadline', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Pesanan_E';
    protected $useTimestamps = true;
}