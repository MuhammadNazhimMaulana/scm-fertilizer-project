<?php

namespace App\Models;

use CodeIgniter\Model;

class Item_Produksi_M extends Model
{
    protected $table         = 'tbl_item_produksi';
    protected $primaryKey    = 'id_item';
    protected $allowedFields = ['id_material', 'id_produksi', 'jumlah_digunakan', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Item_Produksi_E';
    protected $useTimestamps = true;
}
