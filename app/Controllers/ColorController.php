<?php

namespace App\Controllers;

use App\Models\ColorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

// Controlador para la gestión de colores.

class ColorController extends Controller
{
    //Clave primaria de la tabla.
    private $primaryKey;
    //Instancia del modelo Color.
    private $ColorModel;
    // Datos para las vistas.
    private $data;
    //Nombre lógico del modelo.
    private $model;

    // Constructor: inicializa modelo y propiedades.
    public function __construct()
    {
        $this->primaryKey = "id_color";
        $this->ColorModel = new ColorModel();
        $this->data = [];
        $this->model = "ColorModel";
    }

    // Vista principal de gestión de colores.
    public function index()
    {
        $this->data["title"] = "COLOR";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->ColorModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("color/color_view", $this->data);
    }

    // Crea un nuevo color (vía AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ColorModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear color";
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

    // Retorna un color por su ID.
    public function singleColor($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ColorModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener color";
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

    // Actualiza un color existente (vía AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->ColorModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar color";
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

    // Elimina un color por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->ColorModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar color";
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

    // Obtiene los datos del formulario (POST).
    public function getDataModel()
    {
        $data = [
            "id_color"   => $this->request->getVar("id_color"),
            "nom"        => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
