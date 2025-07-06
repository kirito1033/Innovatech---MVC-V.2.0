<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaCompraModel extends Model
{
    protected $table      = 'facturas_compras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'reference_code', 'factura_json', "numero"];
    protected $useTimestamps = true;
}
