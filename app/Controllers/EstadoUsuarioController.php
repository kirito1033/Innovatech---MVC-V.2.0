<?php

namespace App\Controllers;

use App\Models\EstadoUsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EstadoUsuarioController extends Controller
{
    private $primaryKey;
    private $EstadoUsuarioModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EstadoUsuarioModel = new EstadoUsuarioModel();
        $this->data = [];
        $this->model = "EstadoUsuarioModel";
    }

    // Vista principal del módulo de estado usuario.
    public function index()
    {
        $this->data["title"] = "ESTADO USUARIO";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->EstadoUsuarioModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("estadousuario/estadousuario_view", $this->data);
    }

    //Crea un nuevo estado de usuario (AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->EstadoUsuarioModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear estado de usuario";
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

    //Obtiene un estado de usuario por ID (AJAX).
    public function singleEstadoUsuario($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->EstadoUsuarioModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener estado de usuario";
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

    //Actualiza un estado de usuario (AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "Nombre" => $this->request->getVar("Nombre"),
                "Descripción" => $this->request->getVar("Descripción"),
                "updated_at" => $today
            ];
            if ($this->EstadoUsuarioModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar estado de usuario";
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

    //Elimina un estado de usuario (AJAX).
    public function delete($id = null)
    {
        try {
            if ($this->EstadoUsuarioModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar estado de usuario";
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

    //Extrae datos del formulario para inserción/actualización.
    public function getDataModel()
    {
        return [
            "id" => $this->request->getVar("id"),
            "Nombre" => $this->request->getVar("Nombre"),
            "Descripción" => $this->request->getVar("Descripción"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
    }
}
