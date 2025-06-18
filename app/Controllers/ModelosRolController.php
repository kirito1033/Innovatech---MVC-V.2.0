<?php

namespace App\Controllers;

use App\Models\ModelosModel;
use App\Models\ModelosRolModel;
use App\Models\RolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ModelosRolController extends Controller
{
    private $primaryKey;
    private $ModelosRolModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ModelosRolModel = new ModelosRolModel();
        $this->data = [];
        $this->model = "ModelosRolModel";
    }

    public function index()
    {
        $this->data['title'] = "MODELOS ROL";
        
        $rolId = session()->get('rol_id');
        $modelosModel = new ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $modelos = new ModelosModel();
        $this->data['modelos'] = $modelos->findAll();

        $rol = new RolModel();
        $this->data['roles'] = $rol->findAll();

        $this->data[$this->model] = $this->ModelosRolModel->orderBy($this->primaryKey, 'ASC')->findAll();

        return view('modelosrol/modelosrol_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();

            if ($this->ModelosRolModel->insert($dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error creating record';
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

    public function singleModelosRol($id = null)
    {
        if ($this->request->isAJAX()) {

            $record = $this->ModelosRolModel->where($this->primaryKey, $id)->first();
            if ($record) {
                $data[$this->model] = $record;
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error retrieving Model';
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

        $modelosid = $this->request->getVar('Modelosid');
        $rolid = $this->request->getVar('Rolid');

        if (is_array($modelosid)) {
            $modelosid = $modelosid[0]; 
        }
        if (is_array($rolid)) {
            $rolid = $rolid[0]; 
        }

        $dataModel = [
            'Modelosid' => $modelosid,
            'Rolid' => $rolid,
            'grupo' => $this->request->getVar('grupo'),
            "updated_at" => $today
        ];

        if ($this->ModelosRolModel->update($id, $dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error updating model";
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
public function delete($id = null)
{
    if ($this->request->isAJAX()) {
        if ($this->ModelosRolModel->delete($id)) {
            $data['message'] = 'success';
            $data['response'] = ResponseInterface::HTTP_OK;
        } else {
            $data['message'] = 'Error deleting record';
            $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        }
    } else {
        $data['message'] = 'Error Ajax';
        $data['response'] = ResponseInterface::HTTP_CONFLICT;
    }

    echo json_encode($data);
}

    private function getDataModel()
    {
        return [
            'Modelosid' => $this->request->getVar('Modelosid'),
            'Rolid' => $this->request->getVar('Rolid'),
            'grupo' => $this->request->getVar('grupo'),
            'updated_at' => $this->request->getVar('updated_at') ?? date("Y-m-d H:i:s")
        ];
    }
}
