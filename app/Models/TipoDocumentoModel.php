<?php

namespace App\Models;

use CodeIgniter\Model;

/*** Este modelo interactúa con la tabla 'tipo_documento', la cual almacena los distintos tipos
 * de documento de identidad utilizados en el sistema (por ejemplo, cédula, pasaporte, etc.).
 */
class TipoDocumentoModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'tipo_documento';
    //Nombre del campo clave primaria.
    protected $primaryKey       = 'id';
    //Indica si la clave primaria se autoincrementa.
    protected $useAutoIncrement = true;
    //Tipo de datos retornado (array, objeto, etc.).
    protected $returnType       = 'array';
    //Indica si se usa eliminación lógica (no se usa en este caso).
    protected $useSoftDeletes   = false;
    //Indica si se protegen los campos contra asignación masiva.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción/actualización.
    protected $allowedFields    = ['nom', 'updated_at'];

    //No se permiten inserciones con todos los campos vacíos.
    protected bool $allowEmptyInserts = false;

    // Indica si se deben usar automáticamente los campos de tiempo (created_at, updated_at).
    protected $useTimestamps = true;
    // Nombre del campo utilizado para registrar la fecha de actualización.
    protected $updatedField  = 'updated_at';
    //Nombre del campo utilizado para eliminación lógica (no se usa, pero está definido).
    protected $deletedField  = 'deleted_at';


}
