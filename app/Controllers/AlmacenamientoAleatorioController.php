<?php

namespace App\Controllers;

use App\Models\AlmacenamientoAleatorioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AlmacenamientoAleatorioController extends Controller
{
    private $primaryKey;
    private $AlmacenamientoAleatorioModel;
    private $data;
    private $model;

    // Constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->AlmacenamientoAleatorioModel = new AlmacenamientoAleatorioModel();
        $this->data = [];
        $this->model = "AlmacenamientoAleatorioModel";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "ALMACENAMIENTO";
        $this->data[$this->model] = $this->AlmacenamientoAleatorioModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("almacenamientoaleatorio/almacenamientoaleatorio_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->AlmacenamientoAleatorioModel->insert($dataModel)) {
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
            if ($data[$this->model] = $this->AlmacenamientoAleatorioModel->where($this->primaryKey, $id)->first()) {
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

            if ($this->AlmacenamientoAleatorioModel->update($id, $dataModel)) {
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
            if ($this->AlmacenamientoAleatorioModel->where($this->primaryKey, $id)->delete($id)) {
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
