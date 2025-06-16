<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoProveedorModel extends Model
{
    protected $table            = 'pedido_proveedor';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['numero_factura', 'id_proveedor', 'producto_id', 'cantidad', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
