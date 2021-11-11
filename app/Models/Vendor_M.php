<?php

namespace App\Models;

use CodeIgniter\Model;

class Vendor_M extends Model
{
    protected $table         = 'tbl_vendor';
    protected $primaryKey    = 'id_vendor';
    protected $allowedFields = ['nama_vendor', 'alamat_vendor', 'created_at', 'updated_at'];
    protected $returnType    = 'App\Entities\Vendor_E';
    protected $useTimestamps = true;
}
