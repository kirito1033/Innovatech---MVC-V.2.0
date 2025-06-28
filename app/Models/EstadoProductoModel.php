<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'estado_producto'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los estados asignables a productos.
 * Los estados ayudan a clasificar la disponibilidad, condición o visibilidad de un producto
 * en el sistema.
 * 
 * Incluye protección de campos, manejo automático de timestamps y evita inserciones vacías.
 */
class EstadoProductoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'estado_producto';
    // Nombre del campo que actúa como clave primaria
    protected $primaryKey       = 'id';
    // Habilita el autoincremento para la clave primaria
    protected $useAutoIncrement = true;
    // Tipo de retorno de los resultados: arreglo asociativo
    protected $returnType       = 'array';
    // No se habilita soft delete; las eliminaciones son definitivas
    protected $useSoftDeletes   = false;
    // Protección de los campos contra asignaciones masivas
    protected $protectFields    = true;
    // Campos permitidos para inserción y actualización
    protected $allowedFields    = ['nom', 'updated_at'];

    // Impide la inserción de registros vacíos
    protected bool $allowEmptyInserts = false;


    // Habilita el manejo automático de fechas
    protected $useTimestamps = true;
    // Campo para registrar la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo para registrar la fecha de última actualización del registro
    protected $updatedField  = 'updated_at';


   
}
