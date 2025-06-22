<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TokenModel;

class ApiController extends ResourceController
{
    public function token()
    {
        try {
            $model = new TokenModel();
            $token = $model->getToken();

            if ($token) {
                return $this->respond(['token' => $token]);
            } else {
                return $this->failServerError('No se pudo obtener el token.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Error en token(): ' . $e->getMessage());
            return $this->failServerError('Error interno: ' . $e->getMessage());
        }
    }
}
