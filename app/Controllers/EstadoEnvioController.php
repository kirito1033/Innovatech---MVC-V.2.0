<?php

namespace App\Controllers;

use App\Models\EstadoEnvioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EstadoEnvioController extends Controller
{
    private $primaryKey;
    private $EstadoEnvioModel;
    private $data;
    private $model;

    // Constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EstadoEnvioModel = new EstadoEnvioModel();
        $this->data = [];
        $this->model = "EstadoEnvioModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "ESTADO DE ENVÍO";
        $this->data[$this->model] = $this->EstadoEnvioModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("estadoenvio/estadoenvio_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->EstadoEnvioModel->insert($dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al crear el estado de envío",
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

    // Obtener un solo estado de envío
    public function singleEstadoEnvio($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->EstadoEnvioModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data = [
                    "message" => "Error al obtener estado de envío",
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

    // Método update
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => date("Y-m-d H:i:s")
            ];
            if ($this->EstadoEnvioModel->update($id, $dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al actualizar estado de envío",
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

    // Método delete
    public function delete($id = null)
    {
        try {
            if ($this->EstadoEnvioModel->where($this->primaryKey, $id)->delete($id)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => "OK",
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al eliminar estado de envío",
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

    // Obtener datos del modelo
    private function getDataModel()
    {
        return [
            "nom" => $this->request->getVar("nom"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
    }
}
