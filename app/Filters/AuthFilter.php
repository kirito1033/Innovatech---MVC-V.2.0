<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $uri = service('uri')->getPath(); // ejemplo: login, home, usuario

        // Ignorar login y rutas públicas
        $rutasExentas = ['login', 'auth/login', '/'];

        foreach ($rutasExentas as $ruta) {
            if (stripos($uri, $ruta) === 0) {
                return; // No hace nada, deja pasar
            }
        }

        if (! $session->get('token')) {
            return redirect()->to('usuario/login')->with('error', 'Debes iniciar sesión.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
