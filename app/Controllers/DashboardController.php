<?php

namespace App\Controllers;
use App\Models\ModelosModel;

//Controlador del Dashboard principal del sistema.

class DashboardController extends BaseController
{
    //Carga el menú de navegación con los módulos disponibles según el rol.
    public function index()
    {
        
        $rolId = session()->get('rol_id');

        // Cargar los módulos permitidos según el rol del usuario
        
        $modelosModel = new ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        return view('nav/navbar', ['modulos' => $modulosPermitidos]);
    }

    //Muestra la vista de error de acceso no autorizado.
    public function error()
    {
        
        return view('errors/no_autorizado');
    }
}