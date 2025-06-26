<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProductosModel;
use App\Models\OfertasModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        // Instanciación de modelos
        $categoriaModel = new CategoriaModel();
        $productoModel = new ProductosModel();
        $ofertasModel = new OfertasModel();
        //Datos para la vista
        $data['usuario'] = $session->get('usuario'); // Información del usuario logueado
        $data['categorias'] = $categoriaModel->findAll();
        $data['productos'] = $productoModel->findAll();
        $data['ofertas'] = $ofertasModel
            ->where('estado', 1) //Solo ofertas activas
            ->findAll();
    
        return view('home/home', $data);
    }
}
