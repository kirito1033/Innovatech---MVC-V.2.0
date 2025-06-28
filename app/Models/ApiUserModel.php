<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar los usuarios que consumen la API.
 * 
 * Este modelo representa la tabla 'api_users', encargada de almacenar las credenciales,
 * roles y estados de los usuarios con acceso a la API. 
 * Incluye validaciones para asegurar la integridad de los datos.
 */
class ApiUserModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'api_users';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';

    // Campos permitidos para inserción y actualización
    protected $allowedFields    = [
        'api_user',
        'api_password',
        'api_role',
        'api_status'
    ];

    // Manejo automático de fechas de creación y actualización
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // Tipo de retorno: los resultados se devolverán como arrays asociativos
    protected $returnType       = 'array';

    // Reglas de validación para los campos
    protected $validationRules = [
        'api_user' => 'required|max_length[60]',// El usuario es obligatorio y debe tener máximo 60 caracteres
        'api_password' => 'required|max_length[255]', // La contraseña es obligatoria y debe tener máximo 255 caracteres
        'api_role'     => 'required|in_list[Admin,Read-only]', // El rol debe ser uno de los valores permitidos
        'api_status'   => 'required|in_list[Active,Inactive]', // El estado debe ser uno de los valores permitidos
    ]; 

    // Mensajes personalizados para errores de validación
    protected $validationMessages = [
        'api_role' => [
            'in_list' => 'El rol debe ser Admin o Read-only.'
        ],
        'api_status' => [
            'in_list' => 'El estado debe ser Active o Inactive.'
        ]
    ];
    
}
