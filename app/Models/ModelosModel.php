<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelosModel extends Model
{
    protected $table            = 'modelos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Ruta', 'Descripción', 'updated_at'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   public function getModelosByRol($rolId)
    {
        return $this->db->table('modelos_rol')
            ->select('modelos.*, modelos_rol.grupo, modelos_rol.Rolid') // Asegúrate de incluir grupo
            ->join('modelos', 'modelos.id = modelos_rol.Modelosid')
            ->where('modelos_rol.Rolid', $rolId)
            ->get()
            ->getResultArray();
    }

}

// ModelosModel.php
