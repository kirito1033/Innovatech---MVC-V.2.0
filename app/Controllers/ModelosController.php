<?php

namespace App\Controllers;

use App\Models\ModelosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//Controlador para gestionar los módulos del sistema.
//Permite operaciones CRUD vía AJAX sobre los registros de la tabla `modelos`.
class ModelosController extends Controller
{
    private $primaryKey; // Clave primaria de la tabla
    private $ModelosModel; // Instancia del modelo ModelosModel
    private $data; // Datos a enviar a la vista
    private $model; // Nombre del modelo (como string)

     // Constructor: inicializa propiedades
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ModelosModel = new ModelosModel();
        $this->data = [];
        $this->model = "ModelosModel";
    }

    //Vista principal: carga los módulos disponibles y permitidos según el rol.
    public function index()
    {
        $this->data["title"] = "MODELOS";

    $rolId = session()->get('rol_id'); // Obtener el rol del usuario actual
    $modelosModel = new ModelosModel();

    // Obtener los módulos permitidos para el rol
    $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

    // Enviar módulos y todos los modelos a la vista
    $this->data['modulos'] = $modulosPermitidos;

    // Obtener todos los modelos
    $this->data[$this->model] = $this->ModelosModel->orderBy($this->primaryKey, "ASC")->findAll();

    // Cargar la vista
    return view("modelos/modelos_view", $this->data);
    }

    // Método para crear un nuevo modelo vía AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ModelosModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash(); // Seguridad CSRF
            } else {
                $data["message"] = "Error creating model";
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

    //Método para obtener un modelo específico (por ID).
    public function singleModelo($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ModelosModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching model";
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

    //Método para actualizar un modelo existente.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "Ruta" => $this->request->getVar("Ruta"),
                "Descripción" => $this->request->getVar("Descripción"),
                "updated_at" => $today
            ];
            if ($this->ModelosModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating model";
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

    //Método para eliminar un modelo por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->ModelosModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting model";
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

    //Método auxiliar para recoger los datos del formulario.
    //Se utiliza tanto en creación como en actualización.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "Ruta" => $this->request->getVar("Ruta"),
            "Descripción" => $this->request->getVar("Descripción")
        ];
        return $data;
    }
}
