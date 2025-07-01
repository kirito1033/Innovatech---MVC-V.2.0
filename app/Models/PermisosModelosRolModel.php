<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla `permisos_modelos_rol`.
 *
 * Esta tabla actúa como tabla intermedia para asignar permisos
 * a combinaciones específicas de modelos y roles, permitiendo
 * un control de acceso detallado.
 */
class PermisosModelosRolModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'permisos_modelos_rol';
    //Llave primaria de la tabla.
    protected $primaryKey       = 'id'; 
    //Define si el campo de clave primaria se autoincrementa.
    protected $useAutoIncrement = true;
    //Tipo de dato devuelto por defecto (array u objeto).
    protected $returnType       = 'array';
    //Indica si se usa soft delete (borrado lógico).
    protected $useSoftDeletes   = false;
    //Protege los campos frente a inserciones masivas no autorizadas.
    protected $protectFields    = true;
    //Campos permitidos para inserción o actualización.
    protected $allowedFields    = [
        'Permisosid', // ID del permiso (clave foránea a `permisos`)
        'ModelosRolId', // ID de la relación modelo-rol (clave foránea a `modelos_rol`)
        'updated_at']; // Fecha de última modificación (si se desea actualizar manualmente)

    //Impide insertar registros completamente vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el uso automático de campos de fecha.
    protected $useTimestamps = true;
    //Campo de fecha para la creación del registro.
    protected $createdField  = 'created_at';
    // Campo de fecha para la actualización del registro.
    protected $updatedField  = 'updated_at';

    //Obtiene los registros de `modelos_rol` junto con los nombres de modelo y rol.
    public function obtenerModelosRolConNombres()
    {
        return $this->db->table('modelos_rol')
            ->select('modelos_rol.id, modelos.Ruta, rol.nom')
            ->join('modelos', 'modelos.id = modelos_rol.Modelosid')
            ->join('rol', 'rol.id = modelos_rol.Rolid')
            ->get()
            ->getResultArray();
    }

    /**
     * Obtiene un arreglo de permisos activados (por ID) para un rol específico y ruta de modelo.
     *
     * @param int $rolId          ID del rol a consultar.
     * @param string $modeloRuta  Ruta del modelo para filtrar.
     * @return array              Lista de permisos donde el ID del permiso es clave y el valor es true.
     */
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
            $permisos[$row['id']] = true; // Marca el permiso como activo
        }

        return $permisos;
    }
    
}
