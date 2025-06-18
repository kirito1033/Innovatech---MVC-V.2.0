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
    // En tu controlador FacturaController
    public function registrarFactura()
{
    helper(['form', 'url']);

    // Aquí podrías recoger info del POST si quieres personalizar campos:
    $reference_code = $this->request->getPost('reference_code') ?? 'I410';

    $usuario = [ /* datos del cliente */ ];
    $productos = [ /* tus productos como antes */ ];

    $data = $this->request->getPost(); 

    $model = new \App\Models\FacturaModel();
    $resultado = $model->registrarFactura($data);

    // Redireccionar con mensaje
    if (isset($resultado['error'])) {
        return redirect()->back()->with('error', $resultado['error']);
    }

    return redirect()->back()->with('success', 'Factura registrada correctamente.');
}



}
