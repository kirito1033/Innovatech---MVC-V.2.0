<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\CarritoModel;
use CodeIgniter\HTTP\CURLRequest;
use App\Models\EstadoEnvioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Facturas extends BaseController
{
    
   public function index()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $idUsuario = session()->get('id_usuario');
        $usuario = $usuarioModel->find($idUsuario);

        $productosModel = new \App\Models\ProductosModel();
        $productos = $productosModel->findAll();

        $modelosModel = new \App\Models\ModelosModel();
        $rolId = session()->get('rol_id');
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        $model = new \App\Models\FacturaModel();
        $facturas = $model->getFacturas();

        $detalleFactura = [];

        // ✅ Accede correctamente a la primera factura
        if (!empty($facturas['data']['data'])) {
            $numeroFactura = $facturas['data']['data'][0]['number'];
            $detalleFactura = $model->getFacturaCompleta($numeroFactura);
        }

        return view('facturas/index', [
            'facturas'        => $facturas,
            'detalleFactura'  => $detalleFactura,
            'modulos'         => $modulosPermitidos,
            'title'           => 'Listado de Facturas',
            'usuario'         => $usuario,
            'productos'       => $productos
        ]);
    }


    // En tu controlador FacturaController
    public function registrarFactura()
    {
        helper(['form', 'url']);

        // Aquí podrías recoger info del POST si quieres personalizar campos:
        $reference_code = $this->request->getPost('reference_code') ?? 'I410';

        $usuario = [ /* datos del cliente */ ];
        $productos = [ /* tus productos como antes */ ];

        $data = $this->request->getPost(); 

        $model = new \App\Models\FacturaModel();
        $resultado = $model->registrarFactura($data);

        // Redireccionar con mensaje
        if (isset($resultado['error'])) {
            return redirect()->back()->with('error', $resultado['error']);
        }

        return redirect()->back()->with('success', 'Factura registrada correctamente.');
    }

       public function verQR($numero)
        {
            $numero = trim($numero);
            $model = new \App\Models\FacturaModel();
            $factura = $model->getFacturaCompleta($numero);

            if (!empty($factura['data']['bill']['qr'])) {
                return redirect()->to($factura['data']['bill']['qr']);
            } else {
                return redirect()->back()->with('error', 'No se encontró el QR de la DIAN para esta factura.');
            }
        }

       public function pdf($numero)
        {
            $model = new \App\Models\FacturaModel();
            $token = $model->getToken();

            if (!$token) {
                return $this->response->setStatusCode(500)->setBody('Token no disponible');
            }

            $client = \Config\Services::curlrequest();

            try {
                $response = $client->get("https://api-sandbox.factus.com.co/v1/bills/download-pdf/" . urlencode($numero), [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept'        => 'application/json',
                    ],
                ]);

                $body = json_decode($response->getBody(), true);

                if (!isset($body['data']['pdf_base_64_encoded'])) {
                    return $this->response->setStatusCode(404)->setBody('PDF no disponible');
                }

                $pdfBase64 = $body['data']['pdf_base_64_encoded'];
                $pdfContent = base64_decode($pdfBase64);

                return $this->response
                    ->setHeader('Content-Type', 'application/pdf')
                    ->setHeader('Content-Disposition', 'inline; filename="factura.pdf"') // <-- inline para abrir en nueva pestaña
                    ->setBody($pdfContent);

            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setBody('Error: ' . $e->getMessage());
            }
        }

// Confirmación de transacción
    public function confirmacion()
    {
        log_message('debug', '🚀 Se ejecutó confirmacion() con estado: ' . $this->request->getPost('state_pol'));
        $estado = $this->request->getPost('state_pol');
        $referencia = $this->request->getPost('reference_sale');

        log_message('info', '📥 Confirmación de PayU recibida. Estado: ' . $estado . ', Ref: ' . $referencia);

        if ($estado == 4) {
            $temporalModel = new \App\Models\FacturaTemporalModel();
            $row = $temporalModel->where('reference_code', $referencia)->first();

            if (!$row) {
                log_message('error', '❌ No se encontró factura temporal con referencia: ' . $referencia);
                return $this->response->setStatusCode(200)->setBody('OK');
            }

            $factura = json_decode($row['factura_json'], true);
            $factura['reference_code'] = $referencia;

            $facturaModel = new \App\Models\FacturaModel();
            $token = $facturaModel->getToken();

            if (!$token) {
                log_message('error', '❌ Token no obtenido, no se puede enviar a la API');
                return $this->response->setStatusCode(500)->setBody('Token no obtenido');
            }

            try {
                $client = \Config\Services::curlrequest();
                $response = $client->post('https://api-sandbox.factus.com.co/v1/bills/validate', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token,
                    ],
                    'body' => json_encode($factura)
                ]);

                $responseBody = $response->getBody();
                log_message('info', '✅ Factura enviada a API. Respuesta: ' . $responseBody);
            } catch (\Exception $e) {
                log_message('error', '❌ Error al enviar a API Factus: ' . $e->getMessage());
            }

            // ✅ Vaciar carrito con el usuario_id obtenido desde la factura temporal
            $usuarioId = $row['usuario_id']; // <--- CAMBIO CLAVE
            if ($usuarioId) {
                log_message('debug', '🛒 Iniciando intento de vaciar carrito para usuario ID (desde DB): ' . $usuarioId);
                $carritoModel = new \App\Models\CarritoModel();
                $carritoModel->where('usuario_id', $usuarioId)->delete();
                log_message('info', '🧹 Carrito eliminado para usuario ID: ' . $usuarioId);
            } else {
                log_message('warning', '⚠️ No se encontró usuario_id en la factura temporal.');
            }
        }

        return $this->response->setStatusCode(200)->setBody('OK');
    }



    // Redirección dependiendo el rol
    public function respuesta()
    {
        log_message('debug', '✅ Se ejecutó el método respuesta() de Facturas');
        $rol = session('rol');

        $compra_exitosa = true;

        return view('facturas/pago_exitoso', [
            'rol' => $rol,
            'compra_exitosa' => $compra_exitosa
        ]);
    }


    public function pagar($monto = 0)
    {
        $monto = floatval($monto); 
        return view('facturas/formulario_pago', ['monto' => $monto]);
    }

    public function guardarFacturaTemporal()
    {
        $data       = $this->request->getPost();
        $ref        = $data['reference_code'];
        $usuarioId  = session('id_usuario'); // ✅ Recuperamos el usuario de la sesión

        $model = new \App\Models\FacturaTemporalModel();

        $model->insert([
            'reference_code' => $ref,
            'factura_json'   => json_encode($data),
            'usuario_id'     => $usuarioId // ✅ Guardamos el ID del usuario para referencia futura
        ]);

        return $this->response->setJSON(['status' => 'ok']);
    }


    public function notasCredito()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $idUsuario = session()->get('id_usuario');
        $usuario = $usuarioModel->find($idUsuario);
        $productosModel = new \App\Models\ProductosModel();
        $productos = $productosModel->findAll();

        $modelosModel = new \App\Models\ModelosModel();
        $rolId = session()->get('rol_id');
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        $model = new \App\Models\FacturaModel();
        $token = $model->getToken();

        $notasCredito = [];
        $detalleFactura = [];

        if ($token) {
            try {
                $client = \Config\Services::curlrequest();
                $response = $client->get('https://api-sandbox.factus.com.co/v1/credit-notes', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ]
                ]);
                $notasCredito = json_decode($response->getBody(), true);

                // Puedes obtener detalle de la primera nota si es necesario
                if (!empty($notasCredito['data']['data'])) {
                    $numero = $notasCredito['data']['data'][0]['number'];
                    $detalleFactura = $model->getFacturaCompleta($numero); // si aplica
                }

            } catch (\Exception $e) {
                log_message('error', 'Error al obtener notas crédito: ' . $e->getMessage());
            }
        }

        return view('facturas/notas_credito_view', [
            'notas'           => $notasCredito,
            'detalleFactura'  => $detalleFactura,
            'modulos'         => $modulosPermitidos,
            'title'           => 'Notas Crédito',
            'usuario'         => $usuario,
            'productos'       => $productos,
        ]);
    }

    public function registrar()
    {
        helper(['form']);
        $request = \Config\Services::request();
        $post = $request->getPost();
        $notaCreditoModel = new \App\Models\FacturaModel();

        // Formar el arreglo final con estructuras anidadas correctamente
        $dataNota = [
            'numbering_range_id'        => $post['numbering_range_id'] ?? null,
            'correction_concept_code'   => $post['correction_concept_code'] ?? null,
            'customization_id'          => $post['customization_id'] ?? null,
            'bill_id'                   => $post['bill_id'] ?? null,
            'reference_code'            => $post['reference_code'] ?? null,
            'observation'               => $post['observation'] ?? null,
            'payment_method_code'       => $post['payment_method_code'] ?? null,
            'billing_period'            => $post['billing_period'] ?? [],
            'customer'                  => $post['customer'] ?? [],
            'items'                     => $post['items'] ?? []    // ya es array de arrays
        ];
        
        $resultado = $notaCreditoModel->registrarNotaCredito($dataNota);

        if (isset($resultado['data'])) {
            return redirect()->to(base_url('facturas/notas-credito'))->with('success', 'Nota crédito registrada correctamente');
        } else {
            return redirect()->back()->with('error', $resultado['error'] ?? 'Error desconocido al registrar la nota crédito');
        }
    }


    public function ajaxData()
    {
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $draw = $this->request->getPost('draw');
        $searchValue = $this->request->getPost('search')['value'] ?? '';
        $page = ceil(($start + 1) / $length); // Calculamos la página actual

        $model = new \App\Models\FacturaModel();
        $response = $model->getFacturasPaginadas($length, $page, $searchValue);

        if (isset($response['data']['data'])) {
            $data = [];
            foreach ($response['data']['data'] as $factura) {
                $data[] = [
                    'number' => esc($factura['number'] ?? 'N/D'),
                    'names' => esc($factura['names'] ?? '---'),
                    'identification' => esc($factura['identification'] ?? '---'),
                    'total' => $factura['total'] ?? 0,
                    'status' => $factura['status'] ?? '0',
                    'document_name' => esc($factura['document']['name'] ?? '---'),
                    'payment_form_name' => esc($factura['payment_form']['name'] ?? '---'),
                    'acciones' => view('facturas/acciones', ['factura' => $factura]) // una vista parcial con los botones
                ];
            }

            return $this->response->setJSON([
                'draw' => intval($draw),
                'recordsTotal' => $response['data']['pagination']['total'] ?? 0,
                'recordsFiltered' => $response['data']['pagination']['total'] ?? 0,
                'data' => $data,
            ]);
        }

        return $this->response->setJSON([
            'draw' => intval($draw),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
        ]);
    }



}