<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaTemporalModel extends Model
{
    protected $table = 'facturas_temporales';
    protected $primaryKey = 'id';

    protected $allowedFields = ['reference_code', 'factura_json', 'usuario_id'];

    protected $useTimestamps = true;

    public function eliminarTemporalesViejas()
    {
        $horaLimite = date('Y-m-d H:i:s', strtotime('-1 hour'));
        return $this->where('created_at <', $horaLimite)->delete();
    }
}
