<?php

namespace App\Models;

use CodeIgniter\Model;

class Produksi_M extends Model
{
    protected $table         = 'tbl_produksi';
    protected $primaryKey    = 'id_produksi';
    protected $allowedFields = ['penggunaan_item', 'id_produk', 'tanggal_produksi', 'produksi_selesai', 'hasil_produksi', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Produksi_E';
    protected $useTimestamps = true;
}
