<?php

namespace App\Controllers;

use App\Models\ProveedorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelosModel;

/**
 * Controlador para gestionar los proveedores.
 */
class ProveedorController extends Controller
{
    private $primaryKey;
    private $ProveedorModel;
    private $data;
    private $model;

    /**
     * Constructor del controlador.
     * Inicializa el modelo de proveedor y propiedades básicas.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ProveedorModel = new ProveedorModel();
        $this->data = [];
        $this->model = "ProveedorModel";
    }

    /**
     * Método principal que carga la vista de proveedores.
     * También obtiene los módulos disponibles según el rol.
     */
    public function index()
    {
        $this->data["title"] = "PROVEEDOR";
        // Obtener el ID del rol actual desde la sesión
        $rolId = session()->get('rol_id');
        $modelosModel = new ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->ProveedorModel->orderBy($this->primaryKey, "ASC")->findAll();
        // Cargar vista
        return view("proveedor/proveedor_view", $this->data);
    }

/**
     * Crea un nuevo proveedor a partir de los datos recibidos por AJAX.
     */
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ProveedorModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    //Retorna la información de un proveedor específico por ID (AJAX).
    public function singleProveedor($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ProveedorModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    /**
     * Actualiza los datos de un proveedor existente.
     */
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nombre" => $this->request->getVar("nombre"),
                "nit" => $this->request->getVar("nit"),
                "direccion" => $this->request->getVar("direccion"),
                "telefono" => $this->request->getVar("telefono"),
                "email" => $this->request->getVar("email"),
                'updated_at' => $today 
            ];
            if ($this->ProveedorModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    //Elimina un proveedor por ID.
    public function delete($id = null)
    {
        try {
            if ($this->ProveedorModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    //Extrae y estructura los datos del formulario o petición AJAX.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nombre" => $this->request->getVar("nombre"),
            "nit" => $this->request->getVar("nit"),
            "direccion" => $this->request->getVar("direccion"),
            "telefono" => $this->request->getVar("telefono"),
            "email" => $this->request->getVar("email"),
            "updated_at" => $this->request->getVar("update_at")
        ];
        return $data;
    }
}