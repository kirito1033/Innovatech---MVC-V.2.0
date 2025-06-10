<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
    public function noAutorizado()
    {
        return view('errors/no_autorizado');
    }
}
