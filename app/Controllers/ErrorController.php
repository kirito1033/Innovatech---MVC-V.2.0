<?php

namespace App\Controllers;

/**
 * Controlador encargado de manejar errores personalizados dentro de la aplicación,
 * como el acceso no autorizado.
 */
class ErrorController extends BaseController
{

    //Muestra la vista cuando el usuario no tiene permisos.
    public function noAutorizado()
    {
        return view('errors/no_autorizado');
    }
}
