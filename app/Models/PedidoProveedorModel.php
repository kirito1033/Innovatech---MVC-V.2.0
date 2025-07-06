<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para interactuar con la tabla `pedido_proveedor`.
 * 
 * Este modelo permite registrar y gestionar pedidos realizados a proveedores,
 * incluyendo información como la factura, el proveedor, los productos y las cantidades.
 */
class PedidoProveedorModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'pedido_proveedor';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Define si el campo de clave primaria se autoincrementa.
    protected $useAutoIncrement = true;
    //Tipo de retorno para los resultados de consulta (array u objeto).
    protected $returnType       = 'array';
    //Indica si se usa borrado lógico (no se elimina físicamente el registro).
    protected $useSoftDeletes   = false;
    //Habilita protección de campos para evitar asignaciones masivas no deseadas.
    protected $protectFields    = true;

    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = [
        'numero_factura', // Número de la factura del proveedor
        'id_proveedor', // ID del proveedor al que se le realiza el pedido
        'producto_id', // ID del producto solicitado al proveedor
        'cantidad', // Cantidad del producto pedido
        'updated_at']; // Fecha de última actualización (opcional, útil si se gestiona manualmente)

    //No permite insertar registros con todos los campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita la gestión automática de marcas de tiempo.
    protected $useTimestamps = true;
    //Campo para registrar la fecha de creación del registro.
    protected $createdField  = 'created_at';
    //Campo para registrar la fecha de última actualización del registro.
    protected $updatedField  = 'updated_at';


}
