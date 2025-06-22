<?php

namespace App\Models;

class FacturaModel
{
    private $client_id = '9dec2e75-714c-4902-82d7-dc1fa93474c7';
    private $client_secret = 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3';

    public  function getToken()
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
            log_message('error', 'Error al consumir el API de facturas: ' . $e->getMessage());
            return ['error' => 'Error al consumir el API: ' . $e->getMessage()];
        }
    }


   
    public function getFacturaCompleta($number)
    {
        $token = $this->getToken();
        if (!$token) return ['error' => 'Token no disponible'];

        $client = \Config\Services::curlrequest();

        try {
            $url = "https://api-sandbox.factus.com.co/v1/bills/show/" . urlencode(trim($number));
            log_message('debug', 'URL que se consulta: ' . $url);
            
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            log_message('error', 'Error al obtener la factura completa: ' . $e->getMessage());
            return ['error' => 'Error al obtener la factura completa: ' . $e->getMessage()];
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
    public function obtenerFacturaPDF($numero)
    {
        $token = $this->getToken();
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        $client = \Config\Services::curlrequest();

        try {
            $url = "https://api-sandbox.factus.com.co/v1/bills/download-pdf/" . urlencode($numero);

            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['data']['pdf_base_64_encoded'])) {
                return $data;
            } else {
                return ['error' => 'No se encontró el PDF en la respuesta'];
            }
        } catch (\Exception $e) {
            return ['error' => 'Error al obtener el PDF: ' . $e->getMessage()];
        }
    }
    public function getNotasCredito()
    {
        $token = $this->getToken();
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get('https://api-sandbox.factus.com.co/v1/credit-notes', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            log_message('error', 'Error al consultar notas crédito: ' . $e->getMessage());
            return ['error' => 'Error al consultar las notas crédito: ' . $e->getMessage()];
        }
    }

     public function registrarNotaCredito($dataNota)
    {
        // Obtener token
        $token = $this->getToken();

        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        // Cliente HTTP
        $client = \Config\Services::curlrequest();

        try {
            // Enviar la nota crédito para validación
            $response = $client->post('https://api-sandbox.factus.com.co/v1/credit-notes/validate', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'body' => json_encode($dataNota),
            ]);

            // Retornar la respuesta como arreglo
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => 'Error al registrar la nota crédito: ' . $e->getMessage()];
        }
    }



}
