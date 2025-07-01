<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para la gestión de facturas temporales.
 * 
 * Este modelo interactúa con la tabla `facturas_temporales`, que almacena de forma temporal
 * información de facturas en formato JSON, probablemente antes de ser procesadas
 * o enviadas a un sistema externo.
 */
class FacturaTemporalModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table = 'facturas_temporales';
    //Clave primaria de la tabla.
    protected $primaryKey = 'id';

    protected $allowedFields = ['reference_code', 'factura_json', 'usuario_id'];

    protected $useTimestamps = true;
    //Campos permitidos para inserción y actualización.
    //Habilita la gestión automática de marcas de tiempo (created_at y updated_at).
     /**
     * Elimina las facturas temporales que fueron creadas hace más de una hora.
     * 
     * Esta función es útil para limpiar la base de datos de registros temporales obsoletos,
     * evitando acumulación de datos no procesados.
     */
    public function eliminarTemporalesViejas()
    {
        // Calcula la fecha y hora límite (una hora atrás desde ahora)
        $horaLimite = date('Y-m-d H:i:s', strtotime('-1 hour'));

        // Elimina todos los registros cuya fecha de creación sea anterior a la hora límite
        return $this->where('created_at <', $horaLimite)->delete();
    }
}
