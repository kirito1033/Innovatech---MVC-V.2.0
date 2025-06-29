<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'carrito'.
 * 
 * Este modelo representa los datos del carrito de compras de los usuarios,
 * permitiendo realizar operaciones CRUD sobre los productos agregados por cada usuario.
 */
class CarritoModel extends Model
{
  // Nombre de la tabla en la base de datos
  protected $table            = 'carrito';
  // Clave primaria de la tabla
  protected $primaryKey       = 'carrito_id';
  // Indica si la clave primaria se autoincrementa
  protected $useAutoIncrement = true;
  // Formato de retorno de los resultados: arreglo asociativo
  protected $returnType       = 'array';
  // No se usa borrado suave, los registros se eliminan directamente
  protected $useSoftDeletes   = false;
   // Protege los campos ante asignaciones masivas no autorizadas
  protected $protectFields    = true;
  // Campos que pueden ser insertados o actualizados directamente
  protected $allowedFields    = ['usuario_id', 'producto_id', 'cantidad'];

  // No permite insertar registros completamente vacíos
  protected bool $allowEmptyInserts = false;

  // No se utilizan campos de fecha de creación o modificación
  protected $useTimestamps = false;
  protected $createdField  = '';
  protected $updatedField  = '';
}