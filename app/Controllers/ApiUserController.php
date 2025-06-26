<?php

//Controlador encargado de la gestión de usuarios de la API.
//Permite crear usuarios y verificar credenciales mediante AJAX.
namespace App\Controllers;

use App\Models\ApiUserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserController extends Controller
{
    //Clave primaria utilizada en el modelo.
    private $primaryKey = "id";
    //Instancia del modelo de usuarios de la API.
    private $ApiUserModel;
    //Datos a enviar a la vista.
    private $data = [];
    //Nombre del modelo usado como clave para el array de datos.
    private $model = "ApiUserModel";

    //Constructor del controlador.
    //Inicializa el modelo ApiUserModel.

    public function __construct()
    {
        $this->ApiUserModel = new \App\Models\ApiUserModel();
    }

    //Muestra la vista principal con los usuarios de la API.
    //Filtra los módulos visibles de acuerdo al rol del usuario en sesión.
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

     public function singleUserApi($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ApiUserModel->where($this->primaryKey, $id)->first()) {
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

    //Actualiza una categoría existente con datos enviados mediante AJAX.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                 "api_user" => $this->request->getVar("api_user"),
                "api_password" => $hashedPassword,
                "api_role" => $this->request->getVar("api_role"),
                "api_status" => $this->request->getVar("api_status"),
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

    //Crea un nuevo usuario de API con contraseña hasheada. (bcrypt)
    //Solo acepta solicitudes AJAX.
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

    // Verifica las credenciales de acceso del usuario de la API.
    //La contraseña es validada con password_verify().
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
}
