<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'estado_envio'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los distintos estados 
 * que puede tener un envío dentro del sistema logístico.
 * 
 * Incluye manejo automático de timestamps y protección contra asignaciones masivas.
 */
class EstadoEnvioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'estado_envio';
    // Nombre del campo clave primaria
    protected $primaryKey       = 'id';
    // Indica si la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Tipo de retorno de los resultados: arreglo asociativo
    protected $returnType       = 'array';
    // No se utiliza soft delete; los registros se eliminan directamente
    protected $useSoftDeletes   = false;
    // Protección contra asignación masiva no autorizada
    protected $protectFields    = true;
    // Campos que pueden ser insertados o actualizados directamente
    protected $allowedFields    = ['nom', 'updated_at'];

    // Impide insertar registros completamente vacíos
    protected bool $allowEmptyInserts = false;

    // Activación del manejo automático de fechas de creación y modificación
    protected $useTimestamps = true;
    // Campo para registrar la fecha de creación
    protected $createdField  = 'created_at';
    // Campo para registrar la fecha de última actualización
    protected $updatedField  = 'updated_at';
}
