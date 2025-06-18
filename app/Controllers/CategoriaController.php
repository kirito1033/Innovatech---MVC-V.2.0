<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class CategoriaController extends Controller
{
    private $primaryKey;
    private $CategoriaModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->CategoriaModel = new CategoriaModel();
        $this->data = [];
        $this->model = "CategoriaModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "CATEGORIA";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->CategoriaModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("categoria/categoria_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->CategoriaModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear categoría";
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

    // Método para obtener una sola categoría
    public function singleCategoria($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->CategoriaModel->where($this->primaryKey, $id)->first()) {
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

    // Método update
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->CategoriaModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar categoría";
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

    // Método delete
    public function delete($id = null)
    {
        try {
            if ($this->CategoriaModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar categoría";
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

    // Método para obtener los datos enviados en el formulario
    public function getDataModel()
    {
        $data = [
            "id"         => $this->request->getVar("id"),
            "nom"        => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
