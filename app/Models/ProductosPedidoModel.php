<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ProductosPedidoModel
 *
 * Representa la tabla intermedia 'productos_pedido' que establece
 * una relación muchos a muchos entre productos y pedidos.
 */
class ProductosPedidoModel extends Model
{
    // Nombre de la tabla en la base de datos.
    protected $table            = 'productos_pedido';
     /**
     * Clave primaria compuesta.
     * No se usa un campo autoincremental porque se trata de una tabla pivot.
     */
    protected $primaryKey       = ['ProductosId_Producto', 'PedidoId_Pedido'];
    //Desactiva el autoincremento porque se usa clave compuesta.
    protected $useAutoIncrement = false;
    // Tipo de datos que retorna el modelo (arreglo asociativo).
    protected $returnType       = 'array';
     /**
     * No se utiliza soft delete en esta tabla.
     * Las eliminaciones son permanentes.
     */
    protected $useSoftDeletes   = false;
    //Activa la protección de campos para evitar asignaciones masivas.
    protected $protectFields    = true;
    //Campos permitidos para inserción y actualización.
    protected $allowedFields    = ['ProductosId_Producto', 'PedidoId_Pedido'];

      /**
     * No se permiten inserciones vacías.
     * Se debe proporcionar información válida al insertar.
     */
    protected bool $allowEmptyInserts = false;
 
    // Activa el uso de timestamps automáticos.
    protected $useTimestamps = true;
    //Campo que se llena automáticamente con la fecha de creación.
    protected $createdField  = 'created_at';
    //Campo que se actualiza automáticamente con la fecha de modificación.
    protected $updatedField  = 'updated_at';


   
}
