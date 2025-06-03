<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiUserModel extends Model
{
    protected $table            = 'api_users';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [
        'api_user',
        'api_password',
        'api_role',
        'api_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType       = 'array';

    protected $validationRules = [
        'api_user' => 'required|max_length[60]',
        'api_password' => 'required|max_length[255]',
        'api_role'     => 'required|in_list[Admin,Read-only]',
        'api_status'   => 'required|in_list[Active,Inactive]',
    ];

    protected $validationMessages = [
        'api_role' => [
            'in_list' => 'El rol debe ser Admin o Read-only.'
        ],
        'api_status' => [
            'in_list' => 'El estado debe ser Active o Inactive.'
        ]
    ];
    
}
