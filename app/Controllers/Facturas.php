<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use CodeIgniter\HTTP\CURLRequest;

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

    public function confirmacion()
    {
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

            // ✅ Obtener el token desde el modelo
            $facturaModel = new \App\Models\FacturaModel();
            $token = $facturaModel->getToken();

            if (!$token) {
                log_message('error', '❌ Token no obtenido, no se puede enviar a la API');
                return $this->response->setStatusCode(500)->setBody('Token no obtenido');
            }

            // ✅ Enviar a la API con el token
            $client = \Config\Services::curlrequest();
            try {
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
        }


        return $this->response->setStatusCode(200)->setBody('OK');
    }





    public function respuesta()
    {
        return view('facturas/pago_exitoso'); 
    }
  public function pagar($monto = 0)
    {
        $monto = floatval($monto); 
        return view('facturas/formulario_pago', ['monto' => $monto]);
    }

   public function guardarFacturaTemporal()
    {
        $data = $this->request->getPost();
        $ref = $data['reference_code'];

        $model = new \App\Models\FacturaTemporalModel();
        $model->insert([
            'reference_code' => $ref,
            'factura_json' => json_encode($data),
        ]);

        return $this->response->setJSON(['status' => 'ok']);
    }


}
