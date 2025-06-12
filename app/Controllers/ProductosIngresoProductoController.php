<?php

namespace App\Controllers;

use App\Models\ProductosIngresoProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductosModel;
use App\Models\IngresoProductoModel;



class ProductosIngresoProductoController extends Controller
{

    private $primarykey;
    private $CiudadModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->ProductosIngresoProducto = new ProductosIngresoProductoModel(); 
        $this->data = []; 
        $this->model = "ProductosIngresoProducto"; 
    } 

  
   public function index() 
    { 
        $this->data['title'] = "Productos Ingreso Producto"; 
        $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);
        $this->data['modulos'] = $modulosPermitidos;

        // Datos principales
        $this->data['productosIngresoProducto'] = $this->ProductosIngresoProducto->orderBy($this->primaryKey, 'ASC')->findAll();

        $producto = new ProductosModel();
        $this->data['producto'] = $producto->findAll();

        $IngresoProductoModel = new IngresoProductoModel();
        $this->data['facturas'] = $IngresoProductoModel->findAll(); // Se usará para obtener el nombre de la factura

        return view('ProductosIngresoProducto/ProductosIngresoProducto_view', $this->data); 
    }

    

        
   public function create() 
{ 
    if ($this->request->isAJAX()) { 
        $dataModel = $this->getDataModel(); 

        if ($this->ProductosIngresoProducto->insert($dataModel)) { 
            // Actualizar stock
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


    
    public function update() 
    { 
        if ($this->request->isAJAX()) { 
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            
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
                // Ajustar stock del producto
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

       
   public function delete($id = null) 
    { 
        if ($this->request->isAJAX()) { 
            $registro = $this->ProductosIngresoProducto->find($id); 

            if ($registro) { 
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