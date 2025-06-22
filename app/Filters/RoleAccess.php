<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAccess implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Si no está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/usuario/login')->with('error', 'Debes iniciar sesión para acceder');
        }

        // Verifica si su estado cambió a inactivo
        $db = \Config\Database::connect();
        $userId = $session->get('id_usuario');

        $user = $db->table('usuario')->where('id_usuario', $userId)->get()->getRow();

        if (!$user || (int)$user->estado_usuario_id !== 1) {
            $session->destroy();
            return redirect()->to('/logout')->with('error', 'Tu cuenta fue desactivada. Inicia sesión nuevamente o contacta al administrador.');
        }

        // Verificación de rutas por rol
        $rolId = $session->get('rol_id');
        $rutaActual = service('request')->getUri()->getPath();

        $builder = $db->table('modelos')
            ->select('modelos.Ruta')
            ->join('modelos_rol', 'modelos.id = modelos_rol.Modelosid')
            ->where('modelos_rol.Rolid', $rolId);

        $resultados = $builder->get()->getResultArray();

        foreach ($resultados as $fila) {
            if (strpos($rutaActual, $fila['Ruta']) === 0) {
                return; // Tiene acceso
            }
        }

        return redirect()->to('/no-autorizado');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada aquí
    }
}
