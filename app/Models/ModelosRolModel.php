<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelosRolModel extends Model
{ 
    protected $table            = 'modelos_rol';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Modelosid', 'Rolid', 'updated_at'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
