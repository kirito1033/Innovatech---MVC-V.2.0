<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla `modelos_rol`.
 * 
 * Esta tabla se encarga de relacionar modelos con roles
 */
class ModelosRolModel extends Model
{ 
    // Nombre de la tabla asociada en la base de datos.
    protected $table            = 'modelos_rol';
    //Llave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Si la clave primaria se incrementa automáticamente.
    protected $useAutoIncrement = true;
    //Tipo de retorno de los resultados (array u objeto).
    protected $returnType       = 'array';
    //Habilita o deshabilita el borrado lógico (soft delete).
    protected $useSoftDeletes   = false;
    //Indica si los campos deben protegerse (solo los permitidos se pueden insertar/actualizar).
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción/actualización.
    protected $allowedFields    = ['Modelosid', 'Rolid', 'grupo', 'updated_at'];

    //Controla si se permiten inserciones con campos vacíos.
    protected bool $allowEmptyInserts = false;


    //Indica si se deben gestionar automáticamente las fechas.
    protected $useTimestamps = true;
    //Campo que se utiliza para guardar la fecha de creación.
    protected $createdField  = 'created_at';
    // Campo que se utiliza para guardar la fecha de última actualización.
    protected $updatedField  = 'updated_at';


}
