<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para interactuar con la tabla 'sistema_operativo'.
 * Representa los sistemas operativos disponibles en el sistema (por ejemplo: Android, iOS, Windows, etc.).
 */
class SistemaOperativoModel extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table            = 'sistema_operativo';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Habilita el autoincremento para el campo 'id'
    protected $useAutoIncrement = true;
    // Tipo de dato que se retorna al usar el modelo (arreglo asociativo)
    protected $returnType       = 'array';
    // No se utiliza borrado lógico
    protected $useSoftDeletes   = false;
    // Protege los campos para evitar asignaciones masivas no deseadas
    protected $protectFields    = true;
       /**
     * Campos permitidos para inserciones o actualizaciones masivas.
     * - nom: nombre del sistema operativo (ej. Android)
     * - version: versión del sistema operativo (ej. 13.0)
     * - updated_at: fecha de última actualización
     */
    protected $allowedFields    = ['nom', 'version', 'updated_at'];

    // Evita la inserción de registros con valores vacíos
    protected bool $allowEmptyInserts = false;


     /**
     * Configuración de timestamps:
     * - useTimestamps activa el manejo automático de fechas
     * - created_at se establece al momento de creación
     * - updated_at se actualiza automáticamente en modificaciones
     */
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
