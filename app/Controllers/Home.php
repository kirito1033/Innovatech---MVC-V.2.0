<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProductosModel;
use App\Models\OfertasModel;

/**
 * Controlador Home
 *
 * Este controlador gestiona la página principal del sistema (inicio),
 * mostrando al usuario las categorías, productos y ofertas disponibles.
 */
class Home extends BaseController
{
    //Muestra la vista principal del sitio para el usuario logueado.
    public function index()
    {
        $session = session(); // Obtener la sesión activa

        // Instanciación de modelos
        $categoriaModel = new CategoriaModel();
        $productoModel = new ProductosModel();
        $ofertasModel = new OfertasModel();
        //Datos para la vista
        $data['usuario'] = $session->get('usuario'); // Información del usuario logueado
        $data['categorias'] = $categoriaModel->findAll(); // Todas las categorías disponibles
        $data['productos'] = $productoModel->findAll(); // Todos los productos registrados
        $data['ofertas'] = $ofertasModel
            ->where('estado', 1) //Solo ofertas activas
            ->findAll();
    
        // Renderizar la vista 'home/home' con los datos
        return view('home/home', $data);
    }
}
