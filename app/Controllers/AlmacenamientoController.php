<?php

namespace App\Controllers;

use App\Models\AlmacenamientoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AlmacenamientoController extends Controller
{
    private $primaryKey;
    private $AlmacenamientoModel;
    private $data;
    private $model;

    // Constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->AlmacenamientoModel = new AlmacenamientoModel();
        $this->data = [];
        $this->model = "AlmacenamientoModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "ALMACENAMIENTO";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->AlmacenamientoModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("almacenamiento/almacenamiento_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->AlmacenamientoModel->insert($dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al crear el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => ""
                ];
            }
        } else {
            $data = [
                "message" => "Error Ajax",
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => ""
            ];
        }
        echo json_encode($data);
    }

    public function singleAlmacenamiento($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->AlmacenamientoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener Almacenamiento";
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
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "num" => $this->request->getVar("num"),
                "unidadestandar" => $this->request->getVar("unidadestandar"),
                "updated_at" => date("Y-m-d H:i:s")
            ];

            if ($this->AlmacenamientoModel->update($id, $dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al actualizar el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => ""
                ];
            }
        } else {
            $data = [
                "message" => "Error Ajax",
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => ""
            ];
        }
        echo json_encode($data);
    }

    public function delete($id = null)
    {
        try {
            if ($this->AlmacenamientoModel->where($this->primaryKey, $id)->delete($id)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => "OK",
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al eliminar el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => "error"
                ];
            }
        } catch (\Exception $e) {
            $data = [
                "message" => $e->getMessage(),
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => "Error"
            ];
        }
        echo json_encode($data);
    }

    private function getDataModel()
    {
        return [
            "num" => $this->request->getVar("num"),
            "unidadestandar" => $this->request->getVar("unidadestandar"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
    }
}
