<?php

namespace App\Controllers;

use App\Models\FacturaModel;

class Facturas extends BaseController
{
    public function index()
    {
        $modelosModel = new \App\Models\ModelosModel();
        $rolId = session()->get('rol_id');

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        $model = new FacturaModel();
        $facturas = $model->getFacturas();

        // Pasar 'facturas' y 'modulos' a la vista
        return view('facturas/index', [
            'facturas' => $facturas,
            'modulos'  => $modulosPermitidos,
            'title'    => 'Listado de Facturas'
        ]);
    }

}
