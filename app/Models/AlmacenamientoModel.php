<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'almacenamiento'.
 * Este modelo permite realizar operaciones CRUD sobre los registros de almacenamiento.
 */
class AlmacenamientoModel extends Model
{
    // Nombre de la tabla asociada al modelo
    protected $table            = 'almacenamiento';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Indica si la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Tipo de dato devuelto por las consultas (array u objeto)
    protected $returnType       = 'array';
    // Desactiva el borrado suave (soft deletes)
    protected $useSoftDeletes   = false;
    // Protege los campos contra asignación masiva no autorizada
    protected $protectFields    = true;
    // Campos permitidos para inserción y actualización
    protected $allowedFields    = ['num', 'unidadestandar', 'updated_at'];

    // No permite insertar registros vacíos
    protected bool $allowEmptyInserts = false;
    
    // Habilita el uso automático de timestamps
    protected $useTimestamps = true;
    // Campo utilizado para guardar la fecha de creación
    protected $createdField  = 'created_at';
    // Campo utilizado para guardar la fecha de actualización
    protected $updatedField  = 'updated_at';

}
