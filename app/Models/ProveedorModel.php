<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ProveedorModel
 *
 * Este modelo representa la tabla 'proveedores' y permite interactuar con
 * los datos de los proveedores registrados en el sistema.
 */
class ProveedorModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'proveedores';
    //Nombre del campo que actúa como clave primaria.
    protected $primaryKey       = 'id';
    //Activa el autoincremento para la clave primaria.
    protected $useAutoIncrement = true;
    //Define que los resultados se devolverán como arreglos asociativos.
    protected $returnType       = 'array';
    //No se utiliza borrado lógico (soft deletes).
    protected $useSoftDeletes   = false;
    //Protege los campos para evitar asignaciones no deseadas.
    protected $protectFields    = true;
    //Lista de campos que pueden ser insertados o actualizados.
    protected $allowedFields    = ['nombre', 'nit','direccion','telefono','email','updated_at'];

    //No se permiten inserciones sin datos válidos.
    protected bool $allowEmptyInserts = false;

    //Habilita el uso automático de marcas de tiempo (timestamps).
    protected $useTimestamps = true;
    //Campo que registra la fecha y hora de creación del registro.
    protected $createdField  = 'created_at';
    //Campo que registra la fecha y hora de la última actualización
    protected $updatedField  = 'updated_at';


}
