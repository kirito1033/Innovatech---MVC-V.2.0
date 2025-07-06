<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificacionModel extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['usuario_id', 'mensaje', 'leida', 'fecha'];
    protected $useTimestamps = true;
    protected $createdField = 'fecha';
    protected $updatedField = '';
}
