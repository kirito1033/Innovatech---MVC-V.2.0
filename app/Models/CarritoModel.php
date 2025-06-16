<?php

namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model
{
  protected $table            = 'carrito';
  protected $primaryKey       = 'carrito_id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['usuario_id', 'producto_id', 'cantidad'];

  protected bool $allowEmptyInserts = false;

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = '';
  protected $updatedField  = '';
}