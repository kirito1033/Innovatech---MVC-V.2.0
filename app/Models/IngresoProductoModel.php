<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo IngresoProductoModel
 * 
 * Este modelo gestiona la interacción con la tabla `ingreso_producto`, que almacena
 * los registros de ingreso de productos al sistema, incluyendo datos de factura,
 * usuario responsable y nombre del documento.
 */
class IngresoProductoModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'ingreso_producto';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si se utiliza autoincremento en la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de retorno de los resultados de consulta (arreglo asociativo).
    protected $returnType       = 'array';
    //Define si se utilizará eliminación lógica (false = eliminación física).
    protected $useSoftDeletes   = false;
    //Indica si se deben proteger los campos permitidos.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserciones y actualizaciones.
    protected $allowedFields    = [
        'factura', // Código o número de factura del ingreso
        'usuario_id', // ID del usuario responsable del ingreso
        'nombre_factura', // Nombre o descripción de la factura
        'updated_at']; // Fecha de última modificación

        //Impide que se realicen inserciones con campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el uso automático de campos de marca de tiempo.
    protected $useTimestamps = true;
    //Campo que almacena la fecha de creación del registro.
    protected $createdField  = 'created_at';
    //Campo que almacena la fecha de actualización del registro.
    protected $updatedField  = 'updated_at';

}
