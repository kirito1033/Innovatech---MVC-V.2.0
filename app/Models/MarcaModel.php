<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo MarcaModel
 * 
 * Este modelo gestiona la tabla `marca`, que contiene información sobre las marcas de productos.
 * Permite realizar operaciones de inserción, actualización, y consulta de datos de marcas.
 */
class MarcaModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'marca';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si se usa autoincremento en la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de retorno por defecto para las consultas.
    protected $returnType       = 'array';
    //Desactiva el borrado lógico.
    protected $useSoftDeletes   = false;
    //Protege los campos que no están en `allowedFields` ante inserciones y actualizaciones.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = ['nom', 'updated_at'];

    //Impide inserciones con campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el uso automático de timestamps.
    protected $useTimestamps = true;
    //Campo que almacena la fecha de creación.
    protected $createdField  = 'created_at';
    //Campo que almacena la fecha de actualización.
    protected $updatedField  = 'updated_at';


    // Validaciones

    //Reglas de validación para los datos.
    protected $validationRules      = [];
    //Mensajes personalizados para validación.
    protected $validationMessages   = [];
    //Controla si se omite la validación antes de insertar o actualizar.
    protected $skipValidation       = false;
    //Limpia las reglas de validación antes de aplicar.
    protected $cleanValidationRules = true;

    // Callbacks

    //Habilita el uso de callbacks.
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
