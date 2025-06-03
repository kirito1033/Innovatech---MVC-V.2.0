<?php

namespace App\Models;

use CodeIgniter\Model;

class AlmacenamientoModel extends Model
{
    protected $table            = 'almacenamiento';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['num', 'unidadestandar', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
