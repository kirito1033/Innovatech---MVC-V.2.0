<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para interactuar con la tabla `permisos`.
 *
 * Este modelo permite gestionar los distintos permisos que pueden ser
 * asignados a roles o usuarios dentro del sistema.
 * 
 * Cada permiso contiene un nombre identificador, una descripción
 * y se registra su fecha de creación y actualización.
 */
class PermisosModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'permisos';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Indica si la clave primaria se incrementa automáticamente.
    protected $useAutoIncrement = true;
    //Tipo de datos devueltos por las consultas (array u objeto).
    protected $returnType       = 'array';
    //Habilita o deshabilita el borrado lógico (soft delete).
    protected $useSoftDeletes   = false;
    //Protege los campos contra asignaciones masivas no autorizadas.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = [
        'nombre', // Nombre del permiso (ej. "ver_usuarios", "editar_productos")
        'descripción', // Descripción textual del permiso
        'updated_at']; // Fecha de actualización manual si aplica

    //Impide insertar registros completamente vacíos.
    protected bool $allowEmptyInserts = false;

    // Habilita el manejo automático de timestamps (`created_at`, `updated_at`).
    protected $useTimestamps = true;
    //Campo que almacena la fecha de creación.
    protected $createdField  = 'created_at';
    //Campo que almacena la fecha de última actualización.
    protected $updatedField  = 'updated_at';
 

}
