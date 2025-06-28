<?php

namespace App\Controllers;

use App\Models\ResolucionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para gestionar las resoluciones.
 */
class ResolucionController extends Controller
{
    private $primaryKey;
    private $ResolucionModel;
    private $data;
    private $model;

   /**
     * Constructor del controlador.
     * Inicializa propiedades y carga el modelo de resoluciones.
     */
    public function __construct()
    {
        $this->primaryKey = "id"; // Clave primaria usada en las consultas
        $this->ResolucionModel = new ResolucionModel();// Instancia del modelo
        $this->data = [];// Datos compartidos con la vista
        $this->model = "ResolucionModel"; // Nombre del modelo para referencia
    }

    /**
     * Carga la vista principal de resoluciones.
     * También incluye los módulos disponibles según el rol del usuario.
     */
    public function index()
    {
        $this->data["title"] = "RESOLUCIÓN";
        // Obtener el ID del rol de usuario actual desde la sesión
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->ResolucionModel->orderBy($this->primaryKey, "ASC")->findAll();
        // Cargar vista
        return view("resolucion/resolucion_view", $this->data);
    }

    // Crea una nueva resolución (vía AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();// Obtener datos del formulario
            if ($this->ResolucionModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating resolution";
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

    //Obtiene una resolución específica por su ID (AJAX).
    public function singleResolucion($id = null)
    {
        if ($this->request->isAJAX()) {
            // Buscar la resolución por ID
            if ($data[$this->model] = $this->ResolucionModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching resolution";
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

    //Actualiza una resolución existente (AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");// Fecha de modificación
            $id = $this->request->getVar($this->primaryKey);// ID recibido
           // Preparar datos actualizados
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->ResolucionModel->update($id, $dataModel)) {
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

    //Elimina una resolución por ID.
    public function delete($id = null)
    {
        try {
            if ($this->ResolucionModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting resolution";
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

    //Extrae los datos enviados por formulario para crear/actualizar una resolución.
    public function getDataModel()
    {
        return [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "created_at" => date("Y-m-d H:i:s")
        ];
    }
}