<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verifica si hay sesión activa
        if (!$session->get('usuario')) {
            return redirect()->to('/usuario/login');
        }

        // Verifica si la ruta contiene 'usuario' y el rol no es 1 (admin)
        $uri = service('uri')->getPath();

        if (str_starts_with($uri, 'usuario') && $session->get('rol') != 1) {
            return redirect()->to('/home')->with('error', 'Acceso denegado');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no usamos nada después
    }
}
