<?php

namespace App\Models;

use CodeIgniter\Model;

/**Este modelo se encarga de obtener un token de autenticación desde el servicio externo
 * de Facturación Electrónica Factus, mediante una solicitud HTTP usando las credenciales
 * del cliente (client_id y client_secret).
 *
 * El token es utilizado para autorizar peticiones posteriores a la API de Factus.
 */
class TokenModel extends Model
{
    //Identificador del cliente registrado en la API de Factus.
    private $client_id = '9dec2e75-714c-4902-82d7-dc1fa93474c7';
    //Clave secreta del cliente, usada para autenticación con la API.
    private $client_secret = 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3';

    //Retorna el token de acceso si la solicitud fue exitosa, o null en caso de error.
    public function getToken()
    {
        //Obtiene el servicio de cliente CURL de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            //Realiza la solicitud POST para obtener el token
            $response = $client->post('https://api-sandbox.factus.com.co/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'username'      => 'sandbox@factus.com.co',
                    'password'      => 'sandbox2024%',
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->client_secret,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            //Decodifica el cuerpo de la respuesta
            $body = json_decode($response->getBody(), true);

            //Retorna el token si existe, o null
            return $body['access_token'] ?? null;

        } catch (\Exception $e) {
            //En caso de error, se registra en el log
            log_message('error', 'Error al obtener token: ' . $e->getMessage());
            return null;
        }
    }
}
