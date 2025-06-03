<?php

namespace App\Controllers;

use App\Models\ApiUserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserController extends Controller
{
    private $primaryKey;
    private $ApiUserModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ApiUserModel = new \App\Models\ApiUserModel();
        $this->data = [];
        $this->model = "ApiUserModel";
    }

    // Obtener todos los usuarios API
    public function index()
    {
        $this->data["title"] = "API USERS";
        $this->data[$this->model] = $this->ApiUserModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("apiuser/apiuser_view", $this->data);
    }

    // Crear un nuevo usuario API
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel(true);

            if ($this->ApiUserModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear el usuario";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Petición no válida";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    // Obtener un solo usuario API por ID
    public function singleUser($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ApiUserModel->find($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Usuario no encontrado";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Petición no válida";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    // Actualizar usuario API
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = $this->getDataModel(false); // No hashear password si no es nuevo

            if ($this->ApiUserModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar el usuario";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Petición no válida";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    // Eliminar usuario API
    public function delete($id = null)
    {
        try {
            if ($this->ApiUserModel->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar usuario";
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

    // Obtener datos del modelo desde el request
    public function getDataModel($isNew = true)
    {
        $password = $this->request->getVar("api_password");
        return [
            "api_user" => $this->request->getVar("api_user"),
            "api_password" => $isNew ? password_hash($password, PASSWORD_DEFAULT) : $password,
            "api_role"     => $this->request->getVar("api_role"),
            "api_status"   => $this->request->getVar("api_status"),
        ];
    }
}
