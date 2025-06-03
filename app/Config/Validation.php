<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $imageUpload = [
    'imagen' => [
        'uploaded[imagen]', // Asegura que se subió un archivo
        'max_size[imagen,2048]', // Máximo 2MB
        'is_image[imagen]', // Verifica que sea una imagen
        'mime_in[imagen,image/jpg,image/jpeg,image/png,image/gif]', // Tipos permitidos
    ]
];

public array $imageUpload_errors = [
    'imagen' => [
        'uploaded' => 'Debe seleccionar una imagen.',
        'max_size' => 'La imagen no debe superar los 2MB.',
        'is_image' => 'El archivo debe ser una imagen válida.',
        'mime_in' => 'Solo se permiten imágenes en formato JPG, JPEG, PNG o GIF.',
    ]
];

}
