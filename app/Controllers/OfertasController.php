<?php

namespace App\Controllers;

use App\Models\OfertasModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductosModel;

class OfertasController extends Controller
{

    private $primarykey;
    private $OfertaModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->OfertaModel = new OfertasModel(); 
        $this->data = []; 
        $this->model = "OfertaModel"; 
    } 

  
    public function index() 
    { 
        $this->actualizarEstadosOfertas();

        $this->data['title'] = "OFERTA"; 
        $this->data[$this->model] = $this->OfertaModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

        $productos = new \App\Models\ProductosModel();
        $this->data['productos'] = $productos->findAll();

        return view('oferta/oferta_view', $this->data); 
    }
        
    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();

            // Manejo de imagen
            $img = $this->request->getFile('imagen');
            if ($img && $img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads/', $newName);
                $dataModel["imagen"] = $newName;
            }

            // Intentar insertar la oferta
            if ($this->OfertaModel->insert($dataModel)) {
                // Obtener el ID del producto afectado
                $productoID = $dataModel['productos_id'];
                $descuento = $dataModel['descuento']; // Valor monetario del descuento

                // Cargar modelo de productos
                $productosModel = new ProductosModel();
                $producto = $productosModel->find($productoID);

                        
            if ($producto) {
                // Guardar categoría original si aún no ha sido guardada
                if (empty($producto['categoria_original'])) {
                    $productosModel->update($productoID, [
                        'categoria_original' => $producto['id_categoria'], // suponiendo que 'categoria' es el campo actual
                    ]);
                }

                // Calcular el nuevo precio
                $precioOriginal = $producto['precio'];
                $precioConDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));
                if ($precioConDescuento < 0) {
                    $precioConDescuento = 0; // Evitar precios negativos
                }

                // Actualizar el precio y categoría del producto
                $productosModel->update($productoID, [
                    'precio' => $precioConDescuento,
                    'id_categoria' => 6 // o el ID si usas ID de categoría
                ]);
            }

                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear la oferta";
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

    
    public function singleOferta($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->OfertaModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving oferta'; 
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


    
    public function update() 
{ 
    if ($this->request->isAJAX()) { 
        $today = date("Y-m-d H:i:s"); 
        $id = $this->request->getVar($this->primaryKey); 

        // Obtener datos nuevos de la oferta
        $dataModel = [
            'id' => $this->request->getVar('id'), 
            'descuento' => $this->request->getVar('descuento'), 
            'fechaini' => $this->request->getVar('fechaini'), 
            'fechafin' => $this->request->getVar('fechafin'), 
            'descripcion' => $this->request->getVar('descripcion'), 
            'productos_id' => $this->request->getVar('productos_id'), 
            'updated_at' => $today 
        ]; 

        $productosModel = new ProductosModel();

        // Buscar oferta anterior para saber si el producto ha cambiado
        $ofertaAnterior = $this->OfertaModel->find($id);
        $productoAnteriorID = $ofertaAnterior['productos_id'] ?? null;

        // Restaurar precio y categoría original si cambió el producto de la oferta
        if ($productoAnteriorID && $productoAnteriorID != $dataModel['productos_id']) {
            $productoAnterior = $productosModel->find($productoAnteriorID);
            if ($productoAnterior) {
                $updateData = [];
                if (isset($productoAnterior['precio_original'])) {
                    $updateData['precio'] = $productoAnterior['precio_original'];
                }
                if (isset($productoAnterior['categoria_original'])) {
                    $updateData['id_categoria'] = $productoAnterior['categoria_original'];
                }
                if (!empty($updateData)) {
                    $productosModel->update($productoAnteriorID, $updateData);
                }
            }
        }

        // Aplicar nuevo descuento y categoría "Ofertas" al nuevo producto
        $nuevoProducto = $productosModel->find($dataModel['productos_id']);
        if ($nuevoProducto) {
            $precioOriginal = $nuevoProducto['precio_original'] ?? $nuevoProducto['precio'];

            $nuevoPrecio = $precioOriginal - ($precioOriginal * ($dataModel['descuento'] / 100));
            $nuevoPrecio = max($nuevoPrecio, 0);

            $updateDataNuevo = [
                'precio' => $nuevoPrecio,
                'categoria_original' => $nuevoProducto['id_categoria'] ?? null, // Guardar categoría actual antes de cambiar
                'id_categoria' => 6
            ];

            $productosModel->update($dataModel['productos_id'], $updateDataNuevo);
        }

        // Actualizar la oferta
        if ($this->OfertaModel->update($id, $dataModel)) { 
            $data['message'] = 'success'; 
            $data['response'] = ResponseInterface::HTTP_OK; 
            $data['data'] = $dataModel; 
            $data['csrf'] = csrf_hash(); 
        } else { 
            $data['message'] = 'Error updating oferta'; 
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
        try { 
            // Buscar la oferta antes de eliminarla para conocer el producto afectado
            $oferta = $this->OfertaModel->find($id);

            if ($oferta) {
                $productosModel = new ProductosModel();
                $producto = $productosModel->find($oferta['productos_id']);

                if ($producto) {
                    $updateData = [];

                    // Restaurar el precio original si existe
                    if (isset($producto['precio_original'])) {
                        $updateData['precio'] = $producto['precio_original'];
                    }

                    // Restaurar la categoría original si existe
                    if (isset($producto['categoria_original'])) {
                        $updateData['id_categoria'] = $producto['categoria_original'];
                    }

                    if (!empty($updateData)) {
                        $productosModel->update($oferta['productos_id'], $updateData);
                    }
                }
            }

            // Eliminar la oferta
            if ($this->OfertaModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting oferta'; 
                $data['response'] = ResponseInterface::HTTP_CONFLICT; 
                $data['data'] = 'error'; 
            } 
        } catch (\Exception $e) { 
            $data['message'] = $e->getMessage(); 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = 'Error'; 
        } 

        echo json_encode($data);  
    }
    public function getDataModel() 
    { 
        $data = [ 
            'id' => $this->request->getVar('id'), 
                'descuento' => $this->request->getVar('descuento'), 
                'fechaini' => $this->request->getVar('fechaini'), 
                'fechafin' => $this->request->getVar('fechafin'), 
                'descripcion' => $this->request->getVar('descripcion'), 
                'productos_id' => $this->request->getVar('productos_id'), 
            "updated_at" => $this->request->getVar("update_at")
        ]; 
        return $data; 
    }

    public function updateImage()
{
    if ($this->request->isAJAX()) {
        $id = $this->request->getVar('id');

        $oferta = $this->OfertaModel->find($id);
        if (!$oferta) {
            return $this->response->setJSON([
                'message' => 'Oferta no encontrada',
                'response' => ResponseInterface::HTTP_NOT_FOUND
            ]);
        }

        $img = $this->request->getFile('imagen');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);

            $this->OfertaModel->update($id, ['imagen' => $newName]);

            return $this->response->setJSON([
                'message' => 'success',
                'response' => ResponseInterface::HTTP_OK,
                'csrf' => csrf_hash(),
                'imagen' => $newName
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Error al subir imagen',
                'response' => ResponseInterface::HTTP_NO_CONTENT
            ]);
        }
    }

    return $this->response->setJSON([
        'message' => 'Petición inválida',
        'response' => ResponseInterface::HTTP_BAD_REQUEST
    ]);
}


 private function actualizarEstadosOfertas() {
    $now = time();
    $now -= 5 * 60 * 60; // sumar 4 horas para ajustarse al servidor

    $productosModel = new ProductosModel();
    $ofertas = $this->OfertaModel->findAll();

    foreach ($ofertas as $oferta) {
        $idOferta = $oferta['id'];
        $productoID = $oferta['productos_id'];
        $fechaInicio = strtotime($oferta['fechaini']);
        $fechaFin = strtotime($oferta['fechafin']);

        // Si las fechas no son válidas, ignorar esta oferta
        if ($fechaInicio === false || $fechaFin === false) continue;

        $producto = $productosModel->find($productoID);
        if (!$producto) continue;

        $precioOriginal = $producto['precio_original'] ?? $producto['precio'];
        $categoriaOriginal = $producto['categoria_original'] ?? $producto['id_categoria'];

        if ($now >= $fechaInicio && $now <= $fechaFin) {
            // Oferta activa -> aplicar descuento y categoría 6 (oferta)
            $nuevoPrecio = $precioOriginal - ($precioOriginal * ($oferta['descuento'] / 100));
            $nuevoPrecio = max($nuevoPrecio, 0);

            $updateData = [];
            if (!isset($producto['precio_original'])) {
                $updateData['precio_original'] = $precioOriginal;
            }
            if (!isset($producto['categoria_original'])) {
                $updateData['categoria_original'] = $categoriaOriginal;
            }

            $updateData['precio'] = $nuevoPrecio;
            $updateData['id_categoria'] = 6;

            $productosModel->update($productoID, $updateData);

            $this->OfertaModel->update($idOferta, ['estado' => 1]);

        } else {
            // Oferta inactiva -> restaurar precio y categoria original si es necesario
            $updateData = [];
            if (isset($producto['precio_original']) && $producto['precio'] != $precioOriginal) {
                $updateData['precio'] = $precioOriginal;
            }
            if (isset($producto['categoria_original']) && $producto['id_categoria'] != $categoriaOriginal) {
                $updateData['id_categoria'] = $categoriaOriginal;
            }

            if (!empty($updateData)) {
                $productosModel->update($productoID, $updateData);
            }

            $this->OfertaModel->update($idOferta, ['estado' => 0]);
        }
    }
}



}