<?php

namespace App\Controllers;

use App\Models\ApiUserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserController extends Controller
{
    private $primaryKey = "id";
    private $ApiUserModel;
    private $data = [];
    private $model = "ApiUserModel";

    public function __construct()
    {
        $this->ApiUserModel = new \App\Models\ApiUserModel();
    }

      public function index()
    {
        $this->data["title"] = "API USERS";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->ApiUserModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("apiuser/apiuser_view", $this->data);
    }

    // Crear usuario con password hasheado (bcrypt)
    public function create()
    {
        if ($this->request->isAJAX()) {
            $password = $this->request->getVar("api_password");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $dataModel = [
                "api_user" => $this->request->getVar("api_user"),
                "api_password" => $hashedPassword,
                "api_role" => $this->request->getVar("api_role"),
                "api_status" => $this->request->getVar("api_status"),
            ];

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

    // Login: verificar contraseña
    public function login()
    {
        if ($this->request->isAJAX()) {
            $api_user = $this->request->getVar("api_user");
            $inputPassword = $this->request->getVar("api_password");

            $user = $this->ApiUserModel->where('api_user', $api_user)->first();

            if ($user && password_verify($inputPassword, $user['api_password'])) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                unset($user['api_password']); // No enviar password
                $data["data"] = $user;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Usuario o contraseña incorrectos";
                $data["response"] = ResponseInterface::HTTP_UNAUTHORIZED;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Petición no válida";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }
}
