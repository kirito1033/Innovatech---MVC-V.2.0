<?php

namespace App\Controllers;

use App\Models\DepartamentoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelosModel;

// Controlador para la gestión de departamentos.
// Incluye funcionalidades como mostrar, crear, editar, eliminar y consultar departamentos vía AJAX.

class DepartamentoController extends Controller
{
    private $primaryKey;
    private $DepartamentoModel;
    private $data;
    private $model;

    //Constructor
    // Inicializa el modelo principal, la clave primaria y otras propiedades compartidas.
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->DepartamentoModel = new DepartamentoModel();
        $this->data = [];
        $this->model = "DepartamentoModel";
    }

    //Muestra la vista principal con la lista de departamentos.
    public function index()
    {
        $this->data["title"] = "DEPARTAMENTO";

        // Obtener el rol del usuario actual
        $rolId = session()->get('rol_id');
        $modelosModel = new ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->DepartamentoModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("departamento/departamento_view", $this->data);
    }

    //Crea un nuevo departamento (vía AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->DepartamentoModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    //Obtiene un único departamento por ID (vía AJAX).
    public function singleDepartamento($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->DepartamentoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    //Actualiza un departamento existente (vía AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->DepartamentoModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    // Elimina un departamento por ID.
    public function delete($id = null)
    {
        try {
            if ($this->DepartamentoModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    // Obtiene los datos del formulario para insertar/actualizar.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("update_at")
        ];
        return $data;
    }
}