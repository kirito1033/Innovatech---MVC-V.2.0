<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'estado_factura'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los diferentes estados 
 * que puede tener una factura, como por ejemplo "Pagada", "Pendiente" o "Anulada".
 * 
 * Incluye protección de campos, manejo automático de timestamps y previene inserciones vacías.
 */
class EstadoFacturaModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'estado_factura';
    // Nombre del campo clave primaria
    protected $primaryKey       = 'id';
    // Indica que la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Tipo de retorno de los resultados: arreglo asociativo
    protected $returnType       = 'array';
    // No se utiliza soft delete; las eliminaciones son permanentes
    protected $useSoftDeletes   = false;
    // Protección contra asignaciones masivas no autorizadas
    protected $protectFields    = true;
    // Campos permitidos para inserción y actualización
    protected $allowedFields    = ['nom', 'updated_at'];

    // No se permite insertar registros completamente vacíos
    protected bool $allowEmptyInserts = false;

    // Activación del manejo automático de timestamps
    protected $useTimestamps = true;
    // Campo que registra la fecha de creación del registro
    protected $createdField  = 'created_at';
    // Campo que registra la fecha de la última modificación
    protected $updatedField  = 'updated_at';
}
