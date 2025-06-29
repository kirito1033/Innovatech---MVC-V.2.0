<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'color'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los colores registrados en el sistema.
 * Utiliza timestamps automáticos y protege los campos contra asignación masiva no deseada.
 */
class ColorModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'color';
    // Clave primaria personalizada de la tabla
    protected $primaryKey       = 'id_color';
    // Indica que la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Define el tipo de datos devueltos (array asociativo)
    protected $returnType       = 'array';
    // No se usa soft delete, los registros se eliminan definitivamente
    protected $useSoftDeletes   = false;
    // Protege los campos de asignación masiva
    protected $protectFields    = true;
    // Campos que se pueden insertar o actualizar directamente
    protected $allowedFields    = ['nom', 'updated_at'];

    // Evita inserciones completamente vacías
    protected bool $allowEmptyInserts = false;

    // Activa el manejo automático de timestamps
    protected $useTimestamps = true;
    // Campo que registra la fecha de creación del registro
    protected $createdField  = 'created_at';
     // Campo que registra la fecha de última modificación
    protected $updatedField  = 'updated_at';
}
