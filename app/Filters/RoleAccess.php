<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAccess implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rolId = session()->get('rol_id');

        // Permitir acceso total al rol de administrador (por ejemplo, rol_id = 1)
       

        $rutaActual = service('request')->getUri()->getPath();

        $db = \Config\Database::connect();
        $builder = $db->table('modelos')
            ->select('modelos.Ruta')
            ->join('modelos_rol', 'modelos.id = modelos_rol.Modelosid')
            ->where('modelos_rol.Rolid', $rolId);

        $resultados = $builder->get()->getResultArray();

        foreach ($resultados as $fila) {
            // Verifica si la ruta actual comienza con una de las rutas autorizadas
            if (strpos($rutaActual, $fila['Ruta']) === 0) {
                return; // Tiene acceso
            }
        }

        // Si no hay coincidencias, redirige a no-autorizado
        return redirect()->to('/no-autorizado');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada
    }
}
