<?php

namespace App\Controllers;

use App\Models\EstadoPqrsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador que gestiona las operaciones CRUD para los estados de PQRS.
 */
class EstadoPqrsController extends Controller
{
    private $primaryKey;
    private $EstadoPqrsModel;
    private $data;
    private $model;

    //Constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EstadoPqrsModel = new EstadoPqrsModel();
        $this->data = [];
        $this->model = "EstadoPqrsModel";
    }

    //Carga la vista con el listado de estados PQRS.
    public function index()
    {
        $this->data["title"] = "ESTADO PQRS";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->EstadoPqrsModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("estadopqrs/estadopqrs_view", $this->data);
    }

    //Crea un nuevo registro.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->EstadoPqrsModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create estado PQRS";
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

    //Retorna un solo estado por ID.
    public function singleEstadoPqrs($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->EstadoPqrsModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetch estado PQRS";
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

    //Actualiza un estado PQRS.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->EstadoPqrsModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error update estado PQRS";
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

    //Elimina un estado PQRS.
    public function delete($id = null)
    {
        try {
            if ($this->EstadoPqrsModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error delete estado PQRS";
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

    //Extrae datos del request para el modelo.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
