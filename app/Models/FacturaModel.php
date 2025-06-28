<?php

namespace App\Models;

/**
 * FacturaModel
 * 
 * Cliente para consumir la API de Factus (entorno sandbox).
 * Permite gestionar facturas electrónicas, notas crédito y documentos PDF asociados.
 * 
 * Este modelo maneja autenticación con OAuth2, consultas, registros, descargas de PDF 
 * y paginación de facturas de manera centralizada.
 */
class FacturaModel
{
    //ID del cliente OAuth2 proporcionado por Factus.
    private $client_id = '9dec2e75-714c-4902-82d7-dc1fa93474c7';
    //Secreto del cliente OAuth2 proporcionado por Factus.
    private $client_secret = 'aehxmjZ0XavzxrHsAkeJkn9xJua1VZiLJDkvgjI3';

    //Obtiene un token de acceso OAuth2 para autenticar las solicitudes.
    public  function getToken()
    {
        // Obtiene el servicio de cliente HTTP cURL de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
             // Realiza la solicitud POST al endpoint de autenticación de Factus
            $response = $client->post('https://api-sandbox.factus.com.co/oauth/token', [
                'form_params' => [ // Parámetros requeridos para autenticación por contraseña
                    'grant_type'    => 'password', // Tipo de autenticación OAuth2
                    'username'      => 'sandbox@factus.com.co',// Usuario de prueba
                    'password'      => 'sandbox2024%', // Contraseña de prueba
                    'client_id'     => $this->client_id, // ID del cliente OAuth (propiedad privada)
                    'client_secret' => $this->client_secret, // Secreto del cliente OAuth (propiedad privada)
                ],
                'headers' => [
                    'Accept' => 'application/json', // Se espera respuesta en formato JSON
                ],
            ]);

            // Decodifica la respuesta JSON
            $body = json_decode($response->getBody(), true);
            
            // Retorna el token si está presente en la respuesta
            return $body['access_token'] ?? null;

        } catch (\Exception $e) {
            // En caso de error, se registra en el log y se retorna null
            log_message('error', 'Error al obtener token: ' . $e->getMessage());
            return null;
        }
    }

    //Obtiene todas las facturas disponibles.
    public function getFacturas()
    {
        // Obtiene el token de autenticación necesario para consumir el API
        $token = $this->getToken();

        // Verifica que el token esté disponible
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        // Inicializa el cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            // Realiza la solicitud GET al endpoint de facturas
            $response = $client->get('https://api-sandbox.factus.com.co/v1/bills', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, // Encabezado con el token de acceso
                    'Accept'        => 'application/json', // Solicita respuesta en formato JSON
                ],
            ]);

            // Decodifica la respuesta del API en un arreglo asociativo
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            // En caso de error, registra el mensaje en los logs
            log_message('error', 'Error al consumir el API de facturas: ' . $e->getMessage());
            
            // Devuelve una estructura de error amigable
            return ['error' => 'Error al consumir el API: ' . $e->getMessage()];
        }
    }

   /**
     * Obtiene los detalles completos de una factura por número.
     * @param string $number Número de factura
     * @return array Datos completos de la factura o error.
     */  
    public function getFacturaCompleta($number)
    {
        // Obtiene el token de autenticación para acceder al API
        $token = $this->getToken();

        // Si no se obtiene un token válido, retorna error
        if (!$token) return ['error' => 'Token no disponible'];

        // Inicializa el cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            // Construye la URL del endpoint para consultar una factura específica
            $url = "https://api-sandbox.factus.com.co/v1/bills/show/" . urlencode(trim($number));
            
            // Registra en el log la URL consultada (útil para depuración)
            log_message('debug', 'URL que se consulta: ' . $url);
            
            // Realiza la solicitud GET al endpoint
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, // Token de autorización
                    'Accept'        => 'application/json', // Se espera respuesta en JSON
                ],
            ]);

            // Decodifica y retorna el cuerpo de la respuesta como arreglo
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            // Registra el error en los logs para seguimiento
            log_message('error', 'Error al obtener la factura completa: ' . $e->getMessage());
            // Retorna el error como arreglo legible
            return ['error' => 'Error al obtener la factura completa: ' . $e->getMessage()];
        }
    }

    /**
     * Registra una nueva factura en el sistema de Factus.
     * @param array $dataFactura Datos en formato JSON para la factura.
     * @return array Respuesta de validación del API o error.
     */
    public function registrarFactura($dataFactura)
    {
        // Obtiene el token de autenticación para el API
        $token = $this->getToken();

        // Si no hay token disponible, devuelve error
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        // Inicializa el cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            // Realiza la solicitud POST al endpoint de validación de facturas
            $response = $client->post('https://api-sandbox.factus.com.co/v1/bills/validate', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, // Token de autorización
                    'Accept'        => 'application/json', // Formato de respuesta esperado
                    'Content-Type'  => 'application/json', // Tipo de contenido enviado
                ],
                'body' => json_encode($dataFactura), // Convierte los datos de la factura a JSON
            ]);

            // Decodifica la respuesta JSON y la retorna
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            // En caso de excepción, devuelve un mensaje de error detallado
            return ['error' => 'Error al registrar la factura: ' . $e->getMessage()];
        }
    }

    /**
     * Descarga el PDF (base64) de una factura por su número.
     * @param string $numero Número de factura
     * @return array Contenido del PDF en base64 o error.
     */
    public function obtenerFacturaPDF($numero)
    {
        // Obtiene el token de acceso
        $token = $this->getToken();

        // Si no hay token disponible, devuelve error
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        // Inicializa el cliente HTTP
        $client = \Config\Services::curlrequest();

        try {
            // Construye la URL para descargar el PDF de la factura
            $url = "https://api-sandbox.factus.com.co/v1/bills/download-pdf/" . urlencode($numero);

            // Realiza la solicitud GET al API
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, // Token de autorización
                    'Accept'        => 'application/json', // Solicita JSON como formato de respuesta
                ],
            ]);

            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);

            // Verifica que el PDF en base64 esté presente en la respuesta
            if (isset($data['data']['pdf_base_64_encoded'])) {
                return $data; // Retorna toda la respuesta con el PDF
            } else {
                return ['error' => 'No se encontró el PDF en la respuesta'];
            }
        } catch (\Exception $e) {
            // En caso de error, devuelve un mensaje claro
            return ['error' => 'Error al obtener el PDF: ' . $e->getMessage()];
        }
    }

    /**
     * Consulta todas las notas crédito registradas.
     * @return array Notas crédito o mensaje de error.
     */
    public function getNotasCredito()
    {
        // Obtiene el token de acceso desde la función getToken()
        $token = $this->getToken();

        // Si no hay token válido disponible, retorna un mensaje de error
        if (!$token) {
            return ['error' => 'Token no disponible'];
        }

        // Inicializa el cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            // Realiza una solicitud GET al endpoint de notas crédito
            $response = $client->get('https://api-sandbox.factus.com.co/v1/credit-notes', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, // Token OAuth2
                    'Accept'        => 'application/json', // Solicita formato JSON
                ],
            ]);

            // Decodifica y retorna la respuesta como arreglo
            return json_decode($response->getBody(), true);
        
        } catch (\Exception $e) {
            // En caso de error, registra el mensaje en los logs
            log_message('error', 'Error al consultar notas crédito: ' . $e->getMessage());
            // Devuelve el mensaje de error como parte de la respuesta
            return ['error' => 'Error al consultar las notas crédito: ' . $e->getMessage()];
        }
    }

    /**
     * Registra una nueva nota crédito.
     * @param array $dataNota Datos en formato JSON de la nota.
     * @return array Respuesta de validación del API o error.
     */
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

    /**
     * Consulta facturas paginadas, con opción de búsqueda por número, nombre o identificación.
     * @param int $perPage Número de resultados por página
     * @param int $page Número de página
     * @param string $search Parámetro de búsqueda opcional
     * @return array Lista de facturas o mensaje de error.
     */
    public function getFacturasPaginadas($perPage = 10, $page = 1, $search = '')
    {
        // Obtiene el token de autenticación
        $token = $this->getToken();
        if (!$token) return ['error' => 'Token no disponible'];

        // Cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        // Construcción básica de la URL con parámetros de paginación
        $url = "https://api-sandbox.factus.com.co/v1/bills?per_page={$perPage}&page={$page}";

        // Agrega filtros de búsqueda si se proporciona un texto
        if (!empty($search)) {
            // Detecta si es solo números → identificación
            if (is_numeric($search)) {
                $url .= '&filter[identification]=' . urlencode($search);
            }
            // Detecta si empieza con letras como SETP, FACT → number
            elseif (preg_match('/^[A-Z]{2,}/', $search)) {
                $url .= '&filter[number]=' . urlencode($search);
            }
            // Si es texto genérico → nombres
            else {
                $url .= '&filter[names]=' . urlencode($search);
            }
        }

        try {
            // Solicita la lista paginada de facturas desde la API
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            // Devuelve los resultados como arreglo asociativo
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            // Loguea el error en el sistema
            log_message('error', 'Error al consumir el API de facturas: ' . $e->getMessage());
            // Devuelve un mensaje de error entendible
            return ['error' => $e->getMessage()];
        }
    }




}
