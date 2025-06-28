<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'ciudad'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los registros de ciudades,
 * incluyendo su código, nombre, departamento al que pertenecen y fechas de creación/actualización.
 */
class CiudadModel extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table            = 'ciudad';
    // Campo que actúa como clave primaria
    protected $primaryKey       = 'id';
    // Indica que la clave primaria es auto incremental
    protected $useAutoIncrement = true;
    // Tipo de datos retornados por las consultas: arreglo asociativo
    protected $returnType       = 'array';
    // No se utiliza soft delete, los registros se eliminan permanentemente
    protected $useSoftDeletes   = false;
    // Evita la asignación masiva de campos no definidos
    protected $protectFields    = true;
    // Campos permitidos para inserción y actualización
    protected $allowedFields    = ['code', 'name','department', 'updated_at'];

    // No se permite insertar registros completamente vacíos
    protected bool $allowEmptyInserts = false;

    // Habilita el manejo automático de fechas de creación y actualización
    protected $useTimestamps = true;
    // Campo que almacena la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo que almacena la fecha de la última actualización del registro
    protected $updatedField  = 'updated_at';


}
