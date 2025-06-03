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
        $categoriaModel = new CategoriaModel();
        $productoModel = new ProductosModel();
        $ofertasModel = new OfertasModel();
        $data['usuario'] = $session->get('usuario'); // O $data['session'] = $session->get();
        $data['categorias'] = $categoriaModel->findAll();
        $data['productos'] = $productoModel->findAll();
        $data['ofertas'] = $ofertasModel
            ->where('estado', 1)
            ->findAll();
    
        return view('home/home', $data);
    }
}
