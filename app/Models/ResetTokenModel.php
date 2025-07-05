<?php
// app/Models/ResetTokenModel.php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ResetTokenModel
 *
 * Este modelo representa la tabla 'reset_tokens', utilizada para almacenar
 * tokens temporales de recuperación de contraseña asociados a un correo electrónico.
 */
class ResetTokenModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table      = 'reset_tokens';
      /**
     * Campos permitidos para inserción o actualización.
     * - correo: dirección de correo electrónico del usuario.
     * - token: código generado para restablecer la contraseña.
     * - created_at: marca de tiempo de cuando se generó el token.
     */
    protected $allowedFields = [
        'correo', 
        'token', 
        'created_at'];
        /**
     * Indica que no se gestionan automáticamente los campos de tiempo
     * (created_at y updated_at) por parte del framework.
     */
    public $timestamps = false;
}
