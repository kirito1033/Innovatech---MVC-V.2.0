<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'estado_usuario'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los estados que puede tener un usuario.
 * Es útil para representar estados como "Activo", "Inactivo", "Bloqueado", etc., y facilita 
 * el control del flujo de usuarios dentro del sistema.
 * 
 * Incluye soporte para timestamps automáticos y protección contra asignaciones masivas.
 */
class EstadoUsuarioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'estado_usuario';
    // Campo que actúa como clave primaria
    protected $primaryKey       = 'id';
    // Permite que el valor de la clave primaria se genere automáticamente
    protected $useAutoIncrement = true;
    // Formato de retorno: array asociativo
    protected $returnType       = 'array';
    // No se usa soft delete (eliminación lógica)
    protected $useSoftDeletes   = false;
    // Protege los campos contra asignaciones masivas indebidas
    protected $protectFields    = true;
    // Campos que pueden ser insertados o actualizados directamente
    protected $allowedFields    = ['Nombre', 'Descripción','updated_at'];

    // No permite la inserción de registros vacíos
    protected bool $allowEmptyInserts = false;

    // Manejo automático de fechas de creación y actualización
    protected $useTimestamps = true;
    // Campo para guardar la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo para guardar la fecha de la última modificación
    protected $updatedField  = 'updated_at';
}
