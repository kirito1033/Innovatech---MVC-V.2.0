<?php

namespace App\Controllers;

use App\Models\ResolucionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ResolucionController extends Controller
{
    private $primaryKey;
    private $ResolucionModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ResolucionModel = new ResolucionModel();
        $this->data = [];
        $this->model = "ResolucionModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "RESOLUCIÓN";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->ResolucionModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("resolucion/resolucion_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ResolucionModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating resolution";
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

    public function singleResolucion($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ResolucionModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching resolution";
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
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->ResolucionModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating role";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($dataModel);
    }

    public function delete($id = null)
    {
        try {
            if ($this->ResolucionModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting resolution";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            $data["message"] = $e;
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        return [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "created_at" => date("Y-m-d H:i:s")
        ];
    }
}