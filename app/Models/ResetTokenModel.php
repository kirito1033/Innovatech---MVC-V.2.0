<?php
// app/Models/ResetTokenModel.php
namespace App\Models;

use CodeIgniter\Model;

class ResetTokenModel extends Model
{
    protected $table      = 'reset_tokens';
    protected $allowedFields = ['correo', 'token', 'created_at'];
    public $timestamps = false;
}
