<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
class LoginModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['correo','password'];

    protected bool $allowEmptyInserts = false;

    protected $updatedField  = 'update_at';
    protected $deletedField  = 'create_at';

}
