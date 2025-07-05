<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para interactuar con la tabla 'salida_producto'.
 * Esta tabla representa los registros de salida de productos, posiblemente relacionados con facturas.
 */
class SalidaProductoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'salida_producto';
      /**
     * Llave primaria compuesta. Incluye los campos:
     * - id: Identificador del registro de salida
     * - facturaid: Referencia a la factura asociada
     * - Productosid: Identificador del producto
     */
    protected $primaryKey       = ['id', 'facturaid', 'Productosid'];
    // No se utiliza autoincremento porque la clave primaria es compuesta
    protected $useAutoIncrement = false;
    // Tipo de dato que retorna el modelo (arreglo asociativo)
    protected $returnType       = 'array';
    // No se utiliza borrado lógico (soft deletes)
    protected $useSoftDeletes   = false;
    // Campos protegidos para inserciones/actualizaciones masivas
    protected $protectFields    = true;
    /**
     * Campos que pueden ser asignados de forma masiva.
     * Incluye datos como cantidad, precio y referencias de relación con factura y producto.
     */
    protected $allowedFields    = ['id', 'Fecha', 'Cantidad', 'Precio', 'facturaid', 'Productosid'];

    // Desactiva la posibilidad de insertar registros con campos vacíos
    protected bool $allowEmptyInserts = false;

    // Habilita el uso automático de timestamps (created_at y updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
