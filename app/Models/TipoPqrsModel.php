<?php

namespace App\Models;

use CodeIgniter\Model;


/**Este modelo gestiona la interacción con la tabla 'tipo_pqrs', que contiene los diferentes
 * tipos de PQRS (Peticiones, Quejas, Reclamos y Sugerencias) disponibles en el sistema.
 */
class TipoPqrsModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'tipo_pqrs';
    //Campo clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si el campo clave primaria es autoincremental.
    protected $useAutoIncrement = true;
    //Tipo de dato que retorna el modelo (array).
    protected $returnType       = 'array';
    //Indica si se utiliza eliminación lógica (no se usa en este caso).
    protected $useSoftDeletes   = false;
    //Define si los campos están protegidos contra asignación masiva.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = ['nom', 'descripcion','updated_at'];

    //Indica que no se permiten inserciones con todos los campos vacíos.
    protected bool $allowEmptyInserts = false;


    //Activa la gestión automática de campos de tiempo (created_at y updated_at).
    protected $useTimestamps = true;
    // Campo utilizado para almacenar la fecha de creación del registro.
    protected $createdField  = 'created_at';
    // Campo utilizado para almacenar la fecha de la última actualización.
    protected $updatedField  = 'updated_at';


}
