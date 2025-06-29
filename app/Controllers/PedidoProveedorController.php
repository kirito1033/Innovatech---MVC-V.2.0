<?php

namespace App\Controllers;

use App\Models\PedidoProveedorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\Email\Email;


 //Controlador para gestionar pedidos respecto a proveedores.
class PedidoProveedorController extends Controller
{
    private $primarykey;
    private $PedidoProveedorModel;
    private $data;
    private $model;

    /**
     * Constructor: inicializa propiedades del controlador.
     */
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->PedidoProveedorModel = new PedidoProveedorModel(); 
        $this->data = []; 
        $this->model = "PedidoProveedorModel"; 
    } 

    /**
     * Muestra la vista principal de pedidos a proveedores.
     */
    public function index() 
    { 
        $this->data['title'] = "Pedido Proveedor"; 
        // Obtener módulos disponibles para el rol actual
        $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);
        $this->data['modulos'] = $modulosPermitidos;
        // Obtener todos los pedidos
        $this->data[$this->model] = $this->PedidoProveedorModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

        // Obtener productos y proveedores
        $productos = new \App\Models\ProductosModel();
        $this->data['producto'] = $productos->findAll();

        $proveedor = new \App\Models\ProveedorModel();
        $this->data['proveedor'] = $proveedor->findAll();

        return view('pedidoproveedor/pedidoproveedor_view', $this->data); 
    }

    /**
     * Crea un nuevo pedido a proveedor.
     */
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
            $dataModel = $this->getDataModel(); 
            if ($this->PedidoProveedorModel->insert($dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error creating user'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 
        echo json_encode($dataModel); 
    }

    /**
     * Obtiene un pedido por ID vía AJAX.
     */
    public function singlePedidoProveedor($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->PedidoProveedorModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener categoría";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    /**
     * Actualiza un pedido existente.
     */
    public function update() 
    { 
        if ($this->request->isAJAX()) { 
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            $dataModel = [
                'id' => $this->request->getVar('id'), 
                'numero_factura' => $this->request->getVar('numero_factura'), 
                'id_proveedor' => $this->request->getVar('id_proveedor'), 
                'producto_id' => $this->request->getVar('producto_id'), 
                'cantidad' => $this->request->getVar('cantidad'), 
                'updated_at' => $today 
            ]; 
            if ($this->PedidoProveedorModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 
        echo json_encode($dataModel); 
    }

    /**
     * Elimina un pedido por ID.
     */
    public function delete($id = null) 
    { 
        try { 
            if ($this->PedidoProveedorModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting'; 
                $data['response'] = ResponseInterface::HTTP_CONFLICT; 
                $data['data'] = 'error'; 
            } 
        } catch (\Exception $e) { 
            $data['message'] = $e; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = 'Error'; 
        } 
        echo json_encode($data);  
    }

    /**
     * Recolecta datos del formulario.
     */
    public function getDataModel() 
    { 
        $numero_factura = $this->request->getVar('numero_factura');
        if (empty($numero_factura)) {
            $db = \Config\Database::connect();
            $builder = $db->table('pedido_proveedor');
            $ultimo = $builder->selectMax('numero_factura')->get()->getRow();
            $numero_factura = ($ultimo && is_numeric($ultimo->numero_factura)) ? ((int)$ultimo->numero_factura) : 1;
        }
        $data = [ 
            'id' => $this->request->getVar('id'), 
            'numero_factura' => $numero_factura, 
            'id_proveedor' => $this->request->getVar('id_proveedor'), 
            'producto_id' => $this->request->getVar('producto_id'), 
            'cantidad' => $this->request->getVar('cantidad'), 
            'updated_at' => $this->request->getVar('update_at')
        ]; 
        return $data; 
    }

    /**
     * Lista todos los números de factura agrupados.
     */
    public function listarFacturas()
    {
        if ($this->request->isAJAX()) {
            $facturas = $this->PedidoProveedorModel
                ->select('numero_factura')
                ->groupBy('numero_factura')
                ->orderBy('numero_factura', 'DESC')
                ->findAll();
            return $this->response->setJSON($facturas);
        }
    }

    /**
     * Genera un PDF con la información de una factura.
     */
   public function generarFacturaPDF($numero_factura)
{
    $db = \Config\Database::connect();

    // Obtener los productos asociados a la factura
        $query = $db->table('pedido_proveedor pp')
            ->select('pp.cantidad, p.nom AS nombre_producto, pr.nombre AS nombre_proveedor, pr.nit, pr.direccion, pr.telefono, pr.email')
            ->join('productos p', 'p.id = pp.producto_id')
            ->join('proveedores pr', 'pr.id = pp.id_proveedor')
            ->where('pp.numero_factura', $numero_factura)
            ->get();

    $resultados = $query->getResultArray();

    if (empty($resultados)) {
        return $this->response->setStatusCode(404)->setBody("Factura no encontrada");
    }

    // Suponiendo que todos los productos tienen el mismo proveedor
   $proveedor = [
    'nombre'    => $resultados[0]['nombre_proveedor'],
    'nit'       => $resultados[0]['nit'] ?? '',
    'direccion' => $resultados[0]['direccion'] ?? '',
    'telefono'  => $resultados[0]['telefono'] ?? '',
    'email'    => $resultados[0]['email'] ?? '',
    ];

    // Estructura de datos para la vista
    $data = [
        'numero_factura' => $numero_factura,
        'proveedor' => $proveedor,
        'productos' => $resultados
    ];

    // Renderizar la vista HTML
    $html = view('factura_pdf', $data);

    // Opciones de DomPDF
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Descargar el PDF
    $dompdf->stream("factura_{$numero_factura}.pdf", ["Attachment" => false]);
    return;
}

/**
     * Envía la factura por correo al proveedor correspondiente.
     */
public function enviarFacturaCorreo($numero_factura)
{
    $db = \Config\Database::connect();

    $query = $db->table('pedido_proveedor pp')
        ->select('pr.email, pr.nombre')
        ->join('proveedores pr', 'pr.id = pp.id_proveedor')
        ->where('pp.numero_factura', $numero_factura)
        ->limit(1)
        ->get();

    $proveedor = $query->getRowArray();

    if (!$proveedor || empty($proveedor['email'])) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Correo no encontrado']);
    }

    $email = \Config\Services::email();

    // ✅ Línea obligatoria para definir el remitente
    $email->setFrom('so1959373@gmail.com', 'Innovatech');

    // Destinatario (el proveedor)
    $email->setTo($proveedor['email']);
    $email->setSubject('Factura de pedido #' . $numero_factura);

    $enlaceFactura = base_url("pedido/factura/{$numero_factura}");
    $mensaje = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Orden de compra</title>
        </head>
        <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
            <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;">
                <h2 style="color: #0a6069;">Orden de compra</h2>
                <p>Hola <strong>' . htmlspecialchars($proveedor['nombre']) . '</strong>,</p>
                <p>Adjuntamos el enlace para ver o descargar la Orden de compra <strong>#' . htmlspecialchars($numero_factura) . '</strong>:</p>
                <p style="text-align: center; margin: 30px 0;">
                    <a href="' . $enlaceFactura . '" target="_blank" style="display: inline-block; padding: 12px 25px; background-color: #048d94; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        Ver factura
                    </a>
                </p>
                <p>Gracias por trabajar con nosotros.</p>
                <hr style="border: none; border-top: 1px solid #ddd; margin-top: 40px;">
                <p style="font-size: 12px; color: #aaa;">Innovatech - Todos los derechos reservados</p>
            </div>
        </body>
        </html>
        ';

    $email->setMessage($mensaje);
    $email->setMailType('html');

    if ($email->send()) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => $email->printDebugger(['headers'])
        ]);
    }
}


}
