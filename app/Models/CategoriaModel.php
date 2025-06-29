<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'categoria'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre las categorías del sistema,
 * como su creación, edición o listado. Las fechas de creación y actualización se manejan automáticamente.
 */
class CategoriaModel extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table            = 'categoria';
    // Nombre del campo que actúa como clave primaria
    protected $primaryKey       = 'id';
     // Indica que la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Especifica que los resultados se devolverán como arrays asociativos
    protected $returnType       = 'array';
    // No se utiliza borrado lógico (soft delete)
    protected $useSoftDeletes   = false;
    // Activa la protección contra asignación masiva no deseada
    protected $protectFields    = true;
    // Campos que pueden ser insertados o actualizados directamente
    protected $allowedFields    = ['nom', 'updated_at'];

    // Evita la inserción de registros con todos los campos vacíos
    protected bool $allowEmptyInserts = false;

    // Manejo automático de campos de fechas
    protected $useTimestamps = true;
    // Campo que guarda la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo que guarda la fecha de última actualización
    protected $updatedField  = 'updated_at';
    
}
