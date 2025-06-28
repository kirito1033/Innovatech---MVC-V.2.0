<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'almacenamiento_aleatorio'.
 * Este modelo permite realizar operaciones CRUD sobre los datos de almacenamiento aleatorio.
 */

class AlmacenamientoAleatorioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'almacenamiento_aleatorio';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Indica si la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Tipo de dato que se devolverá (array u objeto)
    protected $returnType       = 'array';
    // Indica si se utiliza el borrado suave (soft deletes)
    protected $useSoftDeletes   = false;
    // Si se deben proteger los campos contra asignación masiva
    protected $protectFields    = true;
    // Campos permitidos para la inserción/actualización
    protected $allowedFields    = ['num', 'unidadestandar', 'updated_at'];

    // Evita la inserción de registros con todos los campos vacíos
    protected bool $allowEmptyInserts = false;
    
    // Activación del manejo automático de fechas
    protected $useTimestamps = true;
    // Campo que almacena la fecha de creación
    protected $createdField  = 'created_at';
    // Campo que almacena la fecha de actualización
    protected $updatedField  = 'updated_at';

}
