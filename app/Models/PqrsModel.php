<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para interactuar con la tabla `pqrs`.
 *
 * Este modelo gestiona el sistema de PQRS (Peticiones, Quejas, Reclamos y Sugerencias)
 * enviado por los usuarios. Cada registro puede estar asociado a un tipo, un estado
 * y un usuario que realiza la solicitud, además de contener una descripción y una respuesta.
 */
class PqrsModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'pqrs';
    //Llave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si la llave primaria se autoincrementa.
    protected $useAutoIncrement = true;
    //ipo de dato de retorno por defecto.
    protected $returnType       = 'array';
    //Define si se usará borrado lógico.
    protected $useSoftDeletes   = false;
    //Define si se protegerán los campos contra asignación masiva.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción/actualización masiva.
    protected $allowedFields    = [
        'descripcion',  // Texto ingresado por el usuario que describe la PQRS
        'comentario_respuesta', // Comentario de respuesta por parte del sistema o administrador
        'tipo_pqrs_id', // ID del tipo de PQRS (clave foránea)
        'usuario_id', // ID del usuario que envía la PQRS (clave foránea)
        'estado_pqrs_id',// ID del estado actual de la PQRS (clave foránea)
        'updated_at'  // Fecha de última modificación manual
    ];

    //Impide la inserción de registros totalmente vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el uso automático de marcas de tiempo.
    protected $useTimestamps = true;
    //Campo de fecha de creación automática.
    protected $createdField  = 'created_at';
    //Campo de fecha de actualización automática.
    protected $updatedField  = 'updated_at';

   
}
