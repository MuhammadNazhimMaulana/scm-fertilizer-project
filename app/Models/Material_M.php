<?php

namespace App\Models;

use CodeIgniter\Model;

class Material_M extends Model
{
    protected $table         = 'tbl_material';
    protected $primaryKey    = 'id_material';
    protected $allowedFields = ['nama_material','jumlah_material', 'material_masuk', 'material_keluar', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Material_E';
    protected $useTimestamps = true;
}