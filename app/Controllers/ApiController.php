<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TokenModel;

/**
 * Controlador API para gestionar operaciones relacionadas con tokens.
 * Hereda de ResourceController para seguir el estilo RESTful de CodeIgniter.
 */
class ApiController extends ResourceController
{

  /**
     * Genera y devuelve un token desde el modelo TokenModel.
     *
     * Este método es accesible como endpoint RESTful.
     * Realiza la llamada al modelo para obtener un token.
     * Si se obtiene correctamente, retorna una respuesta con el token.
     * Si ocurre un error, se registra en el log y se devuelve un error de servidor.
     *
     */
    public function token()
    {
        try {
            // Instancia del modelo encargado de generar o recuperar el token.
            $model = new TokenModel();
            // Obtener token desde el modelo.
            $token = $model->getToken();
             // Si el token es válido, responder con éxito.
            if ($token) {
                return $this->respond(['token' => $token]);
            } else {
            // Error si el token no pudo generarse u obtenerse.
                return $this->failServerError('No se pudo obtener el token.');
            }
        } catch (\Throwable $e) {
            // Registrar error en el log de CodeIgniter.
            log_message('error', 'Error en token(): ' . $e->getMessage());
            // Retornar error genérico al cliente.
            return $this->failServerError('Error interno: ' . $e->getMessage());
        }
    }
}
