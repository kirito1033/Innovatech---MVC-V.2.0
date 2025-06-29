<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

/**
 * Modelo LoginModel
 * 
 * Este modelo interactúa con la tabla `usuario`, enfocándose en los campos necesarios
 * para la autenticación de usuarios (correo y contraseña).
 * 
 * Es utilizado principalmente en los procesos de inicio de sesión.
 */
class LoginModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'usuario';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id_usuario';
    //Habilita el autoincremento de la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de dato que devuelve el modelo (arreglo asociativo).
    protected $returnType       = 'array';
    //Desactiva el borrado lógico (se eliminarán físicamente los registros si se usa delete()).
    protected $useSoftDeletes   = false;
    //Protege los campos para evitar inserción/actualización no deseada.
    protected $protectFields    = true;
    //Campos permitidos para inserción y actualización, orientados al login.
    protected $allowedFields    = ['correo','password'];

    //Impide insertar registros con campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Campo que almacena la fecha de última modificación del registro.
    protected $updatedField  = 'updated_at';
    //Campo que almacena la fecha de creación del registro.
    protected $createdField  = 'create_at';

}
