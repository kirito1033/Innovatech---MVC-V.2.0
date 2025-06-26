<?php

namespace App\Controllers;

use App\Models\ProductosIngresoProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductosModel;
use App\Models\IngresoProductoModel;

/**
 * Controlador para gestionar el ingreso del producto.
 */
class ProductosIngresoProductoController extends Controller
{

    private $primarykey;
    private $CiudadModel;
    private $data;
    private $model;
    
    /**
     * Constructor: inicializa propiedades necesarias y carga el modelo.
     */
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->ProductosIngresoProducto = new ProductosIngresoProductoModel(); 
        $this->data = []; 
        $this->model = "ProductosIngresoProducto"; 
    } 

  /**
     * Muestra el listado de productos ingresados con sus relaciones.
     */
   public function index() 
    { 
        $this->data['title'] = "Productos Ingreso Producto"; 
       // Cargar módulos permitidos según el rol del usuario
        $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);
        $this->data['modulos'] = $modulosPermitidos;

        // Obtener todos los registros de ingresos de productos
        $this->data['productosIngresoProducto'] = $this->ProductosIngresoProducto->orderBy($this->primaryKey, 'ASC')->findAll();
       
        // Obtener lista de productos y facturas
        $producto = new ProductosModel();
        $this->data['producto'] = $producto->findAll();

        $IngresoProductoModel = new IngresoProductoModel();
        $this->data['facturas'] = $IngresoProductoModel->findAll(); // Se usará para obtener el nombre de la factura

        return view('ProductosIngresoProducto/ProductosIngresoProducto_view', $this->data); 
    }

   /**
     * Crea un nuevo registro de producto ingresado.
     * También actualiza el stock del producto.
     */     
   public function create() 
{ 
    if ($this->request->isAJAX()) { 
        $dataModel = $this->getDataModel(); 

        if ($this->ProductosIngresoProducto->insert($dataModel)) { 
            // Actualizar existencias del producto
            $productoModel = new ProductosModel();
            $producto = $productoModel->find($dataModel['producto_id']);

            if ($producto) {
                $nuevoStock = $producto['existencias'] + $dataModel['cantidad'];
                $productoModel->update($dataModel['producto_id'], ['existencias' => $nuevoStock]);
            }

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
    echo json_encode($data); 
}
    //Devuelve los datos de un solo registro de ingreso de producto.
     public function singleProductosIngresoProducto($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ProductosIngresoProducto->where($this->primaryKey, $id)->first()) {
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
     * Actualiza un registro de ingreso de producto.
     * Ajusta el stock del producto según la nueva cantidad.
     */
    public function update() 
    { 
        if ($this->request->isAJAX()) { 
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            
            // Obtener la cantidad anterior para ajustar el stock correctamente
            $productoIngresoAnterior = $this->ProductosIngresoProducto->find($id);
            $cantidadAnterior = $productoIngresoAnterior['cantidad'] ?? 0;

            $dataModel = [
                'id' => $this->request->getVar('id'), 
                'producto_id' => $this->request->getVar('producto_id'), 
                'ingreso_producto_id' => $this->request->getVar('ingreso_producto_id'), 
                'cantidad' => $this->request->getVar('cantidad'), 
                'updated_at' => $today 
            ]; 

            if ($this->ProductosIngresoProducto->update($id, $dataModel)) { 
                // Recalcular stock del producto
                $productoModel = new ProductosModel();
                $producto = $productoModel->find($dataModel['producto_id']);

                if ($producto) {
                    $diferencia = $dataModel['cantidad'] - $cantidadAnterior;
                    $nuevoStock = $producto['existencias'] + $diferencia;
                    $productoModel->update($dataModel['producto_id'], ['existencias' => $nuevoStock]);
                }

                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating ciudad'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 

        echo json_encode($data); 
    }

    /**
     * Elimina un registro de ingreso de producto.
     * Resta la cantidad al stock del producto correspondiente.
     */  
   public function delete($id = null) 
    { 
        if ($this->request->isAJAX()) { 
            $registro = $this->ProductosIngresoProducto->find($id); 

            if ($registro) { 
                // Ajustar stock del producto
                $productoModel = new ProductosModel(); 
                $producto = $productoModel->find($registro['producto_id']); 

                if ($producto) {
                    // Restar cantidad al stock
                    $nuevoStock = $producto['existencias'] - $registro['cantidad'];
                    if ($nuevoStock < 0) $nuevoStock = 0; // evita stock negativo
                    $productoModel->update($registro['producto_id'], ['existencias' => $nuevoStock]);
                }

                if ($this->ProductosIngresoProducto->delete($id)) { 
                    $data['message'] = 'success'; 
                    $data['response'] = ResponseInterface::HTTP_OK; 
                    $data['data'] = $registro; 
                    $data['csrf'] = csrf_hash(); 
                } else { 
                    $data['message'] = 'Error deleting record'; 
                    $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                    $data['data'] = ''; 
                } 
            } else { 
                $data['message'] = 'Record not found'; 
                $data['response'] = ResponseInterface::HTTP_NOT_FOUND; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 
        echo json_encode($data); 
    }

    // Recoge los datos enviados por formulario o AJAX y los estructura para su uso.
    public function getDataModel() 
    { 
        $data = [ 
            'id' => $this->request->getVar('id'), 
            'producto_id' => $this->request->getVar('producto_id'), 
            'ingreso_producto_id' => $this->request->getVar('ingreso_producto_id'), 
            'cantidad' => $this->request->getVar('cantidad'), 
            "updated_at" => $this->request->getVar("update_at")
        ]; 
        return $data; 
    }

    

 
}