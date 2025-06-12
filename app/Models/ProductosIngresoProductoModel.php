<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosIngresoProductoModel extends Model
{
    protected $table            = 'productos_ingreso_producto';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['producto_id', 'ingreso_producto_id', 'cantidad'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


   
}
