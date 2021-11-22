<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengiriman_M extends Model
{
    protected $table         = 'tbl_pengiriman';
    protected $primaryKey    = 'id_pengiriman';
    protected $allowedFields = ['id_pesanan', 'alamat', 'ongkir', 'total_bayar', 'nama_penerima', 'tlp_penerima', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Pengiriman_E';
    protected $useTimestamps = true;
}
