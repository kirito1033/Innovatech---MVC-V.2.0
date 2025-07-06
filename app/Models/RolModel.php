<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo RolModel
 *
 * Representa la tabla 'rol', utilizada para gestionar los roles o perfiles
 * de usuario dentro del sistema (por ejemplo: administrador, cliente, etc.).
 */
class RolModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'rol';
    //Campo que actúa como clave primaria.
    protected $primaryKey       = 'id';
    //Habilita el autoincremento en la clave primaria.
    protected $useAutoIncrement = true;
    //Define que los resultados devueltos serán arreglos asociativos.
    protected $returnType       = 'array';
    //Indica que no se usa borrado lógico (soft delete).
    protected $useSoftDeletes   = false;
    //Activa la protección de campos contra asignaciones masivas.
    protected $protectFields    = true;
     /**
     * Lista de campos permitidos para inserción y actualización:
     * - nom: nombre del rol (ej. "Administrador").
     * - descripcion: descripción del rol.
     * - updated_at: fecha de última modificación (también gestionada automáticamente).
     */
    protected $allowedFields    = ['nom', 'descripcion' ,'updated_at'];

    //Evita que se puedan insertar registros vacíos.
    protected bool $allowEmptyInserts = false;

    //Activa el manejo automático de campos de tiempo.
    protected $useTimestamps = true;
    //Campo que almacena la fecha de creación del registro.
    protected $createdField  = 'created_at';
    //Campo que almacena la fecha de última modificación del registro.
    protected $updatedField  = 'updated_at';


}
