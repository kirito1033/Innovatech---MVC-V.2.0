<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LoginTerminos extends Controller
{
    public function terminos()
    {
        return view('usuario/terminos');
    }

    public function condiciones()
    {
        return view('usuario/condiciones');
    }
}
