<?php

namespace App\Controllers;

use CodeIgniter\Controller;

// Controlador responsable de mostrar las vistas de términos y condiciones

class LoginTerminos extends Controller
{
    //Muestra la vista de términos de uso del sistema.
    public function terminos()
    {
        //Retorna la vista que contiene los términos de uso
        return view('usuario/terminos');
    }

    //Muestra la vista de condiciones del sistema.
    public function condiciones()
    {
        //Retorna la vista que contiene las condiciones de uso
        return view('usuario/condiciones');
    }
}
