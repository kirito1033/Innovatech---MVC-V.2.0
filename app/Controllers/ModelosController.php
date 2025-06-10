<?php

namespace App\Controllers;

use App\Models\ModelosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;


class ModelosController extends Controller
{
    private $primaryKey;
    private $ModelosModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ModelosModel = new ModelosModel();
        $this->data = [];
        $this->model = "ModelosModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "MODELOS";

    $rolId = session()->get('rol_id');
    $modelosModel = new ModelosModel();

    // Obtener los módulos permitidos para el rol actual
    $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

    // Agregar los módulos a los datos enviados a la vista
    $this->data['modulos'] = $modulosPermitidos;

    // Obtener todos los modelos
    $this->data[$this->model] = $this->ModelosModel->orderBy($this->primaryKey, "ASC")->findAll();

    // Cargar la vista
    return view("modelos/modelos_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ModelosModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating model";
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

    public function singleModelo($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ModelosModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching model";
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
                "Ruta" => $this->request->getVar("Ruta"),
                "Descripción" => $this->request->getVar("Descripción"),
                "updated_at" => $today
            ];
            if ($this->ModelosModel->update($id, $dataModel)) {
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
        echo json_encode($dataModel);
    }

    public function delete($id = null)
    {
        try {
            if ($this->ModelosModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting model";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            $data["message"] = $e->getMessage();
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "Ruta" => $this->request->getVar("Ruta"),
            "Descripción" => $this->request->getVar("Descripción")
        ];
        return $data;
    }
}
