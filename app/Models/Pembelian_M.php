<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembelian_M extends Model
{
    protected $table         = 'tbl_pembelian';
    protected $primaryKey    = 'id_pembelian';
    protected $allowedFields = ['vendor_penyedia','id_pesanan', 'material_dibeli', 'jumlah_beli', 'harga_beli', 'lama_pesanan','status', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Pembelian_E';
    protected $useTimestamps = true;
}