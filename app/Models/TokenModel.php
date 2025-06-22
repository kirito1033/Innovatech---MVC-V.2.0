<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    private $client_id = '9dec2e75-714c-4902-82d7-dc1fa93474c7';
    private $client_secret = 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3';

    public function getToken()
    {
        $client = \Config\Services::curlrequest();

        try {
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

            $body = json_decode($response->getBody(), true);
            return $body['access_token'] ?? null;
        } catch (\Exception $e) {
            log_message('error', 'Error al obtener token: ' . $e->getMessage());
            return null;
        }
    }
}
