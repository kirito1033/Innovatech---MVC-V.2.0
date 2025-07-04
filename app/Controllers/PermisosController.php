<?php

namespace App\Controllers;

use App\Models\PermisosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para gestionar permisos del sistema.
 */
class PermisosController extends Controller
{
    private $primaryKey;
    private $PermisosModel;
    private $data;
    private $model;

    /**
     * Constructor: Inicializa las propiedades del controlador.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->PermisosModel = new PermisosModel();
        $this->data = [];
        $this->model = "PermisosModel";
    }

    // Muestra la vista principal con todos los permisos.
    public function index()
    {
        $this->data["title"] = "PERMISOS";
        // Obtener ID del rol desde sesión
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->PermisosModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("permisos/permisos_view", $this->data);
    }

    // Crea un nuevo permiso vía AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->PermisosModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating permission";
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

    //Devuelve un permiso específico por su ID.
    public function singlePermiso($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->PermisosModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching permission";
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

    // Actualiza un permiso existente vía AJAX.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nombre" => $this->request->getVar("nombre"),
                "descripción" => $this->request->getVar("descripción"),
                "updated_at" => $today
            ];
            if ($this->PermisosModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating permission";
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

    //Elimina un permiso por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->PermisosModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting permission";
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

    //Extrae los datos del formulario de permisos.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nombre" => $this->request->getVar("nombre"),
            "descripción" => $this->request->getVar("descripción")
        ];
        return $data;
    }
}
