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
    $this->data['title'] = "OFERTA"; 
    $this->data[$this->model] = $this->OfertaModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

    // Cargar modelos de roles y estados
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
    
            if ($this->OfertaModel->insert($dataModel)) {
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
            
            $dataModel = [
                'id' => $this->request->getVar('id'), 
                'descuento' => $this->request->getVar('descuento'), 
                'fechaini' => $this->request->getVar('fechaini'), 
                'fechafin' => $this->request->getVar('fechafin'), 
                'estado' => $this->request->getVar('estado'), 
                'descripcion' => $this->request->getVar('descripcion'), 
                'productos_id' => $this->request->getVar('productos_id'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->OfertaModel->update($id, $dataModel)) { 
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
        try { 

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
            $data['message'] = $e; 
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
                'estado' => $this->request->getVar('estado'), 
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


 
}