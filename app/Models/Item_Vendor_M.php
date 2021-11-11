<?php

namespace App\Models;

use CodeIgniter\Model;

class Item_Vendor_M extends Model
{
    protected $table         = 'tbl_item_vendor';
    protected $primaryKey    = 'id_item_vendor';
    protected $allowedFields = ['id_pembelian', 'id_vendor', 'item_beli', 'nama_item', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Item_Vendor_E';
    protected $useTimestamps = true;
}
