<?php

namespace App\Controllers;

use App\Models\EstadoProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador que gestiona las operaciones CRUD para el estado de los productos.
 * Permite crear, consultar, actualizar y eliminar estados de producto, principalmente vía AJAX.
 */
class EstadoProductoController extends Controller
{
    private $primaryKey;
    private $EstadoProductoModel;
    private $data;
    private $model;

    // Constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EstadoProductoModel = new EstadoProductoModel();
        $this->data = [];
        $this->model = "EstadoProductoModel";
    }

    //  Vista principal del módulo de estado de productos.
    public function index()
    {
        $this->data["title"] = "ESTADO PRODUCTO";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->EstadoProductoModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("estadoproducto/estadoproducto_view", $this->data);
    }

    //Crea un nuevo estado de producto (AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->EstadoProductoModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear estado producto";
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

    // Obtiene un estado de producto por su ID (AJAX).
    public function singleEstadoProducto($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->EstadoProductoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener estado producto";
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

    //Actualiza un estado de producto (AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->EstadoProductoModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar estado producto";
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

    //Elimina un estado de producto (AJAX).
    public function delete($id = null)
    {
        try {
            if ($this->EstadoProductoModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar estado producto";
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

    // Extrae los datos del request para usarlos en operaciones de inserción/actualización.
    public function getDataModel()
    {
        $data = [
            "id"         => $this->request->getVar("id"),
            "nom"        => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
