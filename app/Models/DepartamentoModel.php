<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'departamento'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los departamentos del sistema.
 * Incluye el manejo automático de fechas de creación y actualización.
 */
class DepartamentoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'departamento';
    // Campo clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Indica que la clave primaria es auto incremental
    protected $useAutoIncrement = true;
    // Tipo de resultado devuelto por el modelo: arreglo asociativo
    protected $returnType       = 'array';
    // No se usa borrado lógico (los registros se eliminan de forma permanente)
    protected $useSoftDeletes   = false;
    // Habilita la protección de campos contra asignación masiva
    protected $protectFields    = true;
    // Campos que pueden ser insertados o actualizados
    protected $allowedFields    = ['nom', 'updated_at'];

     // No permite inserciones con todos los campos vacíos
    protected bool $allowEmptyInserts = false;

    // Habilita el manejo automático de campos de fecha
    protected $useTimestamps = true;
    // Campo para registrar la fecha de creación
    protected $createdField  = 'created_at';
    // Campo para registrar la fecha de última modificación
    protected $updatedField  = 'updated_at';


}
