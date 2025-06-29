<?php

namespace App\Controllers;

use App\Models\GarantiaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class GarantiaController extends Controller
{
    private $primaryKey;
    private $GarantiaModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->GarantiaModel = new GarantiaModel();
        $this->data = [];
        $this->model = "GarantiaModel";
    }

    // Listado principal
    public function index()
    {
        $this->data["title"] = "GARANTÍA";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->GarantiaModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("garantia/garantia_view", $this->data);
    }

    // Crear registro
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->GarantiaModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear la garantía";
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

    // Obtener un solo registro
    public function singleGarantia($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->GarantiaModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener garantía";
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

    //  Actualizar
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "numero_mes_año" => $this->request->getVar("numero_mes_año"),
                "mes_año"        => $this->request->getVar("mes_año"),
                "updated_at"     => $today
            ];
            if ($this->GarantiaModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar la garantía";
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

    // Eliminar
    public function delete($id = null)
    {
        try {
            if ($this->GarantiaModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar la garantía";
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

    // Obtener los datos del formulario
    public function getDataModel()
    {
        $data = [
            "id"             => $this->request->getVar("id"),
            "numero_mes_año" => $this->request->getVar("numero_mes_año"),
            "mes_año"        => $this->request->getVar("mes_año"),
            "updated_at"     => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
