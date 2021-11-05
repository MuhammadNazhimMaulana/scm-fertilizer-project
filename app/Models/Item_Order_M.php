<?php

namespace App\Models;

use CodeIgniter\Model;

class Item_Order_M extends Model
{
    protected $table         = 'tbl_item_pesanan';
    protected $primaryKey    = 'id_item_order';
    protected $allowedFields = ['id_pesanan','id_storage', 'nama_produk', 'jumlah_pesan', 'harga_item', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Item_Order_E';
    protected $useTimestamps = true;
}