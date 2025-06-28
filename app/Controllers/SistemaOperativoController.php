<?php

namespace App\Controllers;

use App\Models\SistemaOperativoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para gestionar operaciones CRUD sobre los Sistemas Operativos.
 */
class SistemaOperativoController extends Controller
{
    private $primaryKey;
    private $SistemaOperativoModel;
    private $data;
    private $model;

    /**
     * Constructor del controlador.
     * Inicializa propiedades necesarias para el funcionamiento del controlador.
     */
    public function __construct()
    {
        $this->primaryKey = "id";// Clave primaria del modelo
        $this->SistemaOperativoModel = new SistemaOperativoModel();// Instancia del modelo
        $this->data = [];// Arreglo para almacenar datos a enviar a la vista
        $this->model = "SistemaOperativoModel";// Nombre de referencia del modelo
    }

    /**
     * Método principal que carga la vista de sistemas operativos.
     * Muestra todos los registros y los módulos permitidos según el rol actual.
     */
    public function index()
    {
        $this->data["title"] = "SISTEMA OPERATIVO";
        // Obtener el ID del rol desde la sesión
        $rolId = session()->get('rol_id');
        // Instanciar el modelo de módulos
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->SistemaOperativoModel->orderBy($this->primaryKey, "ASC")->findAll();
        // Retornar la vista con los datos
        return view("sistemaoperativo/sistemaoperativo_view", $this->data);
    }

     /**
     * Crea un nuevo sistema operativo mediante una solicitud AJAX.
     */
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();// Obtener datos del formulari
            if ($this->SistemaOperativoModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating system";
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

    //Devuelve la información de un sistema operativo específico.
    public function singleSistemaOperativo($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->SistemaOperativoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching system";
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

    //Actualiza un sistema operativo existente mediante una solicitud AJAX.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");// Fecha y hora actual
            $id = $this->request->getVar($this->primaryKey); // ID del registro a actualizar
            // Datos actualizados del sistema operativo
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "version" => $this->request->getVar("version"),
                "updated_at" => $today
            ];
            if ($this->SistemaOperativoModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating system";
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

    //Elimina un sistema operativo por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->SistemaOperativoModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting system";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            // Error general (por ejemplo, clave foránea en uso)
            $data["message"] = $e;
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    //Obtiene los datos del formulario para insertar o actualizar un sistema operativo.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "version" => $this->request->getVar("version"),
            "updated_at" => $this->request->getVar("update_at")// Puede ser null o mal escrito
        ];
        return $data;
    }
}