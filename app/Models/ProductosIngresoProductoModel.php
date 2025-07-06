<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ProductosIngresoProductoModel
 *
 * Este modelo gestiona la tabla 'productos_ingreso_producto', que representa
 * la relación entre los productos y sus ingresos al inventario, incluyendo
 * la cantidad de cada producto en cada ingreso.
 */
class ProductosIngresoProductoModel extends Model
{
    //Nombre de la tabla en la base de datos
    protected $table            = 'productos_ingreso_producto';
    //Llave primaria de la tabla
    protected $primaryKey       = 'id';
    //Uso de incremento automático en la llave primaria
    protected $useAutoIncrement = true;
    //Tipo de dato que se retornará (array en este caso)
    protected $returnType       = 'array';
    //Desactiva el uso de borrado suave (soft deletes)
    protected $useSoftDeletes   = false;
    //Permite proteger los campos del modelo para evitar asignaciones masivas no deseadas
    protected $protectFields    = true;
    //Campos permitidos para inserción y actualización masiva
    protected $allowedFields    = [
        'producto_id', // ID del producto
        'ingreso_producto_id',  // ID del ingreso de producto
        'cantidad']; // Cantidad de producto ingresada

    //Evita que se inserten registros con todos los campos vacíos
    protected bool $allowEmptyInserts = false;

   // Configuración de timestamps
   //Habilita el manejo automático de campos de fecha (created_at y updated_at)
    protected $useTimestamps = true;
    //Campo que se actualizará automáticamente al crear un registro
    protected $createdField  = 'created_at';
    //Campo que se actualizará automáticamente al modificar un registro
    protected $updatedField  = 'updated_at';


   
}
