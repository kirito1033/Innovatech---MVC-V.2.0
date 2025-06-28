<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo GarantiaModel
 * 
 * Gestiona la interacción con la tabla `garantia` en la base de datos.
 * Esta tabla almacena información relacionada con garantías, organizadas por número
 * y mes/año, posiblemente para seguimiento o control de productos o servicios con garantía.
 */
class GarantiaModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'garantia';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si se debe usar autoincremento para la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de datos retornados por las consultas (array asociativo).
    protected $returnType       = 'array';
    //Habilita o deshabilita borrado lógico (no se usa en este caso).
    protected $useSoftDeletes   = false;
    //Si es `true`, solo se permitirán campos definidos en `allowedFields` para inserción/actualización.
    protected $protectFields    = true;
    //Campos permitidos para inserción y actualización.
    protected $allowedFields    = ['numero_mes_año', 'mes_año', 'updated_at'];

    //Indica si se permiten inserciones con campos vacíos (no permitido).
    protected bool $allowEmptyInserts = false;

    // Habilita la gestión automática de campos de fecha (`created_at` y `updated_at`).
    protected $useTimestamps = true;
    // Nombre del campo que almacena la fecha de creación.
    protected $createdField  = 'created_at';
    //Nombre del campo que almacena la fecha de última actualización.
    protected $updatedField  = 'updated_at';



}
