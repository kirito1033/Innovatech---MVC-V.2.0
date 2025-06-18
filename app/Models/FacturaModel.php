<?php

namespace App\Models;

class FacturaModel
{
    private $client_id = '9dec2e75-714c-4902-82d7-dc1fa93474c7';
    private $client_secret = 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3';

    private function getToken()
    {
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('https://api-sandbox.factus.com.co/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'username'      => 'sandbox@factus.com.co',
                    'password'      => 'sandbox2024%',
                    'client_id'     => '9dec2e75-714c-4902-82d7-dc1fa93474c7',
                    'client_secret' => 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3',
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


    public function getFacturas()
    {
        $token = $this->getToken();

        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get('https://api-sandbox.factus.com.co/v1/bills', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => 'Error al consumir el API: ' . $e->getMessage()];
        }
    }
    public function registrarFactura($dataFactura)
    {
        $token = $this->getToken();

        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('https://api-sandbox.factus.com.co/v1/bills/validate', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'body' => json_encode($dataFactura),
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => 'Error al registrar la factura: ' . $e->getMessage()];
        }
    }

        

}
