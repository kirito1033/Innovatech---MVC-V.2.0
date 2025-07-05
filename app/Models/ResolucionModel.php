<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ResolucionModel
 *
 * Representa la tabla 'resolucion', utilizada para almacenar datos
 * relacionados con resoluciones (por ejemplo, resoluciones legales,
 * fiscales o de configuración).
 */
class ResolucionModel extends Model
{
    // Nombre de la tabla en la base de datos.
    protected $table            = 'resolucion';
    //Nombre del campo clave primaria.
    protected $primaryKey       = 'id';
    //Habilita el autoincremento en la clave primaria.
    protected $useAutoIncrement = true;
    //Define que los resultados del modelo se devuelven como arreglos asociativos.
    protected $returnType       = 'array';
    //No se usa borrado lógico (soft delete) para esta tabla.
    protected $useSoftDeletes   = false;
    //Habilita la protección contra asignación masiva de campos no permitidos.
    protected $protectFields    = true;
    /**
     * Campos permitidos para inserción o actualización.
     * - nom: nombre o descripción de la resolución.
     * - created_at: marca de tiempo de creación (también gestionada automáticamente).
     */
    protected $allowedFields    = ['nom','created_at' ];

    // No se permiten inserciones vacías. Se requiere información válida.
    protected bool $allowEmptyInserts = false;


    // Habilita el uso automático de timestamps (created_at y updated_at).
    protected $useTimestamps = true;
    //Campo que se llena automáticamente con la fecha de creación.
    protected $createdField  = 'created_at';
    //Campo que se actualiza automáticamente con la fecha de modificación.
    protected $updatedField  = 'updated_at';


}
