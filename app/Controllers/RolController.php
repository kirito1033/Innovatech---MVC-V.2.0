<?php

namespace App\Controllers;

use App\Models\RolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para gestionar los roles del sistema (crear, leer, actualizar, eliminar).
 */
class RolController extends Controller
{
    private $primaryKey;
    private $RolModel;
    private $data;
    private $model;

    /**
     * Constructor de la clase.
     * Inicializa propiedades, incluyendo el modelo de rol.
     */
    public function __construct()
    {
        $this->primaryKey = "id"; // Clave primaria utilizada en el modelo
        $this->RolModel = new RolModel(); // Instancia del modelo
        $this->data = []; // Arreglo para pasar datos a las vistas
        $this->model = "RolModel";// Nombre del modelo, usado como clave
    }

    /**
     * Muestra la vista principal con la lista de roles y módulos permitidos para el rol actual.
     */
    public function index()
    {
        $this->data["title"] = "ROLES";
        // Obtener ID del rol actual desde la sesión
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        // Obtener todos los roles desde la base de datos
        $this->data[$this->model] = $this->RolModel->orderBy($this->primaryKey, "ASC")->findAll();
        // Mostrar la vista con los datos
        return view("rol/rol_view", $this->data);
    }

    /**
     * Crea un nuevo rol desde una petición AJAX.
     */
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();// Obtener datos del formulario
            if ($this->RolModel->insert($dataModel)) {
                 // Respuesta exitosa
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                // Error al insertar
                $data["message"] = "Error creating role";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            // Petición no válida
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    // Obtiene un rol específico por su ID (AJAX).
    public function singleRol($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->RolModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error retrieving role";
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

    //Actualiza un rol existente (AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s"); // Fecha actual
            $id = $this->request->getVar($this->primaryKey); // ID del rol a actualizar
            // Datos actualizados del rol
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "descripcion" => $this->request->getVar("descripcion"),
                "updated_at" => $today
            ];
            if ($this->RolModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating role";
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

    // Elimina un rol por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->RolModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting role";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            // Error general al eliminar (por ejemplo, restricciones de integridad)
            $data["message"] = $e;
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    //Obtiene los datos enviados desde el formulario para crear o actualizar un rol.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "descripcion" => $this->request->getVar("descripcion"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}