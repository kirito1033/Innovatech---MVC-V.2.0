<?php

namespace App\Controllers;
use App\Models\ModelosModel;

class DashboardController extends BaseController
{
    public function index()
    {
        
        $rolId = session()->get('rol_id');
        
        $modelosModel = new ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        return view('nav/navbar', ['modulos' => $modulosPermitidos]);
    }
    public function error()
    {
        
        return view('errors/no_autorizado');
    }
}