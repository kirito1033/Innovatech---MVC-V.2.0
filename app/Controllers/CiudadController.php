<?php

namespace App\Controllers;

use App\Models\CiudadModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//Controlador para la gestión de ciudades.
//Incluye funciones para CRUD vía AJAX.

class CiudadController extends Controller
{

    //Clave primaria del modelo.
    private $primarykey;
    //Instancia del modelo Ciudad.
    private $CiudadModel;
    //Datos pasados a las vistas.
    private $data;
    //Nombre del modelo como clave.
    private $model;
    

    //Constructor: inicializa modelo y variables.
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->CiudadModel = new CiudadModel(); 
        $this->data = []; 
        $this->model = "CiudadModel"; 
    } 

    //Muestra la vista principal con listado de ciudades.
    public function index() 
    { 
    $this->data['title'] = "CIUDAD"; 
     $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->CiudadModel->orderBy($this->primaryKey, 'ASC')->findAll(); 


        return view('ciudad/ciudad_view', $this->data); 
    }
    
    

        // Crea una nueva ciudad vía AJAX.
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->CiudadModel->insert($dataModel)) { 
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

    //Obtiene una ciudad por ID.
     public function singleCiudad($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->CiudadModel->where($this->primaryKey, $id)->first()) {
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


    //Actualiza una ciudad existente.
    public function update() 
    { 
        
        if ($this->request->isAJAX()) { 
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            
            $dataModel = [
                'id' => $this->request->getVar('id'), 
                'code' => $this->request->getVar('code'), 
                'name' => $this->request->getVar('name'), 
                'department' => $this->request->getVar('department'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->CiudadModel->update($id, $dataModel)) { 
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
        
        echo json_encode($dataModel); 
    }

       //Elimina una ciudad por ID.
    public function delete($id = null) 
    { 
        try { 

            if ($this->CiudadModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting Ciudad'; 
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

    //Obtiene los datos del formulario para insertar o actualizar.
    public function getDataModel() 
    { 
        $data = [ 
            'id' => $this->request->getVar('id'), 
            'code' => $this->request->getVar('code'), 
            'name' => $this->request->getVar('name'), 
            'department' => $this->request->getVar('department'), 
            "updated_at" => $this->request->getVar("update_at")
        ]; 
        return $data; 
    }

    

 
}