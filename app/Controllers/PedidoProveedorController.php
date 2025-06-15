<?php

namespace App\Controllers;

use App\Models\PedidoProveedorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
class PedidoProveedorController extends Controller
{
    private $primarykey;
    private $PedidoProveedorModel;
    private $data;
    private $model;

    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->PedidoProveedorModel = new PedidoProveedorModel(); 
        $this->data = []; 
        $this->model = "PedidoProveedorModel"; 
    } 

    public function index() 
    { 
        $this->data['title'] = "Pedido Proveedor"; 
        $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->PedidoProveedorModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

        $productos = new \App\Models\ProductosModel();
        $this->data['producto'] = $productos->findAll();

        $proveedor = new \App\Models\ProveedorModel();
        $this->data['proveedor'] = $proveedor->findAll();

        return view('pedidoproveedor/pedidoproveedor_view', $this->data); 
    }

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
}
