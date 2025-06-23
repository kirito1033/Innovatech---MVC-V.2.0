<?php

namespace App\Controllers;

class ErrorController extends BaseController
{

    //Muestra la vista cuando el usuario no tiene permisos.
    public function noAutorizado()
    {
        return view('errors/no_autorizado');
    }
}
