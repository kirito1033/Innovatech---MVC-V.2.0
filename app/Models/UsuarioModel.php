<?php

namespace App\Models;

use CodeIgniter\Model;

/**Este modelo gestiona la tabla 'usuario' que almacena la información de los usuarios del sistema.
 * Incluye datos personales, credenciales de acceso, relaciones con otras entidades (tipo de documento, ciudad, rol, estado),
 * así como funcionalidad para recuperación de contraseña y seguimiento de timestamps. */
class UsuarioModel extends Model
{
    // Nombre de la tabla en la base de datos.
    protected $table            = 'usuario';
    //Campo clave primaria de la tabla.
    protected $primaryKey       = 'id_usuario';
    //Indica si la clave primaria se autoincrementa automáticamente.
    protected $useAutoIncrement = true;
    //Define el tipo de retorno (array u objeto). En este caso, array.
    protected $returnType       = 'array';
    //Indica si se utiliza eliminación lógica. Está desactivada.
    protected $useSoftDeletes   = false;
    //Define si se protegen los campos permitidos para asignación masiva.
    protected $protectFields    = true;
    //Campos permitidos para inserción y actualización masiva.
    protected $allowedFields    = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 
        'documento', 'correo', 'telefono1', 'telefono2', 'direccion', 
        'usuario', 'password', 'tipo_documento_id', 'ciudad_id', 'rol_id', 'estado_usuario_id', 'reset_token', 'reset_token_expiration', 'foto_perfil', 'updated_at'
    ];

    //Indica que no se permiten inserciones con todos los campos vacíos.
    protected bool $allowEmptyInserts = false;


    // Activa el uso automático de timestamps (created_at, updated_at).
    protected $useTimestamps = true;
    //Campo para almacenar la fecha de creación del registro.
    protected $createdField  = 'created_at';
    //Campo para almacenar la fecha de última actualización.
    protected $updatedField  = 'updated_at';

}
