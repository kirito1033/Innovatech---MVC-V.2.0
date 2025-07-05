<?php

namespace App\Models;

use CodeIgniter\Model;


/**
 * Modelo para interactuar con la tabla `ofertas`.
 * 
 * Este modelo permite gestionar los registros de ofertas en el sistema,
 * como descuentos, fechas de vigencia, estado e imagen relacionada con productos.
 */
class OfertasModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'ofertas';
    //Llave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si la clave primaria se incrementa automáticamente.
    protected $useAutoIncrement = true;
    //Tipo de dato retornado por las consultas (array u objeto).
    protected $returnType       = 'array';
    //Indica si se usa el borrado lógico (soft delete).
    protected $useSoftDeletes   = false;
    //Si los campos están protegidos para evitar asignaciones masivas.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = [
        'descuento',
        'imagen',
        'fechaini',
        'fechafin',
        'descripcion',
        'estado',
        'productos_id'
    ];

     //Indica si se permiten inserciones con campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el manejo automático de marcas de tiempo.
    protected $useTimestamps = true;
    //Nombre del campo para guardar la fecha de creación.
    protected $createdField  = 'created_at';
    //Nombre del campo para guardar la fecha de actualización.
    protected $updatedField  = 'updated_at';
}
