<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'estado_pqrs'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los diferentes estados
 * de las solicitudes PQRS. Se utiliza para clasificar o identificar el avance
 * o resolución de dichas solicitudes (por ejemplo: "Recibida", "En proceso", "Resuelta").
 * 
 * Incluye protección de campos, timestamps automáticos y control de inserciones vacías.
 */
class EstadoPqrsModel extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table            = 'estado_pqrs';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Habilita autoincremento para la clave primaria
    protected $useAutoIncrement = true;
    // Define el formato de los resultados devueltos por el modelo
    protected $returnType       = 'array';
    // No se utiliza borrado lógico; las eliminaciones son permanentes
    protected $useSoftDeletes   = false;
    // Activa la protección de campos contra asignación masiva no permitida
    protected $protectFields    = true;
    // Define los campos que se pueden insertar o actualizar
    protected $allowedFields    = ['nom', 'updated_at'];

    // No permite insertar registros completamente vacíos
    protected bool $allowEmptyInserts = false;

    // Activa el manejo automático de campos de tiempo
    protected $useTimestamps = true;
    // Campo usado para registrar la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo usado para registrar la fecha de la última actualización del registro
    protected $updatedField  = 'updated_at';

}
