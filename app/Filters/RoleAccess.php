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

        // Obtener datos del rol y usuario
        $rolId = $session->get('rol_id');
        $rutaActual = service('request')->getUri()->getPath();

        // DEBUG: Descomenta para ver qué está pasando
        // log_message('debug', "Rol ID: {$rolId}, Ruta Actual: {$rutaActual}");

        // ========== OPCIÓN 1: Si el usuario es ADMIN (rol_id = 1) ==========
        // Los admins deben acceder a TODO
        if ((int)$rolId === 1) {
            return; // Admin tiene acceso completo
        }

        // ========== OPCIÓN 2: Para otros roles ==========
        // Verificar permisos en la BD
        $builder = $db->table('modelos')
            ->select('modelos.Ruta')
            ->join('modelos_rol', 'modelos.id = modelos_rol.Modelosid')
            ->where('modelos_rol.Rolid', $rolId);

        $resultados = $builder->get()->getResultArray();

        // Verificar si la ruta actual está en la lista de rutas permitidas
        foreach ($resultados as $fila) {
            $rutaPermitida = trim($fila['Ruta']);
            
            // Comparación más flexible
            if (strpos($rutaActual, $rutaPermitida) === 0 || $rutaActual === $rutaPermitida) {
                return; // Tiene acceso
            }
        }

        // Si llegó aquí, no tiene acceso
        return redirect()->to('/no-autorizado')->with('error', 'No tienes permisos para acceder a esta sección');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada aquí
    }
}
