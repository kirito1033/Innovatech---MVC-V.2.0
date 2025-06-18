<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisosModelosRolModel extends Model
{
    protected $table            = 'permisos_modelos_rol';
    protected $primaryKey       = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Permisosid', 'ModelosRolId', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function obtenerModelosRolConNombres()
    {
        return $this->db->table('modelos_rol')
            ->select('modelos_rol.id, modelos.Ruta, rol.nom')
            ->join('modelos', 'modelos.id = modelos_rol.Modelosid')
            ->join('rol', 'rol.id = modelos_rol.Rolid')
            ->get()
            ->getResultArray();
    }
    public function getPermisosPorRol($rolId, $modeloRuta)
    {
        $builder = $this->db->table('permisos_modelos_rol');
        $builder->select('permisos.id, permisos.nombre'); // ← AÑADIDO permisos.id
        $builder->join('modelos_rol', 'modelos_rol.id = permisos_modelos_rol.ModelosRolId');
        $builder->join('modelos', 'modelos.id = modelos_rol.Modelosid');
        $builder->join('permisos', 'permisos.id = permisos_modelos_rol.Permisosid');
        $builder->where('modelos_rol.Rolid', $rolId);
        $builder->where('modelos.Ruta', $modeloRuta);
        $query = $builder->get();

        $permisos = [];
        foreach ($query->getResultArray() as $row) {
            $permisos[$row['id']] = true; // Ahora sí existe $row['id']
        }

        return $permisos;
    }
    
}
