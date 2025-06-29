<?php

//Controlador encargado de gestionar las categorías del sistema.
//Permite crear, consultar, actualizar y eliminar categorías a través de peticiones AJAX.

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class CategoriaController extends Controller
{
    //Nombre de la clave primaria de la tabla.
    private $primaryKey;
    //Instancia del modelo de categorías.
    private $CategoriaModel;
    //Datos compartidos con la vista.
    private $data;
    //Nombre del modelo como clave para los datos enviados a la vista.
    private $model;

    // Constructor del controlador. Inicializa propiedades y modelo de categoría.
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->CategoriaModel = new CategoriaModel();
        $this->data = [];
        $this->model = "CategoriaModel";
    }

    // Carga la vista principal con el listado de categorías.
    //También incluye los módulos visibles según el rol del usuario en sesión.
    public function index()
    {
        $this->data["title"] = "CATEGORIA";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->CategoriaModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("categoria/categoria_view", $this->data);
    }

    // Crea una nueva categoría desde una petición AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->CategoriaModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al crear categoría";
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

    // Obtiene los datos de una sola categoría por ID, mediante AJAX.
    public function singleCategoria($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->CategoriaModel->where($this->primaryKey, $id)->first()) {
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
                "nom" => $this->request->getVar("nom"),
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

    // Elimina una categoría específica por su ID.
    //Soporta manejo de excepciones y responde en formato JSON.
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

    // Obtiene y estructura los datos del formulario para insertar o actualizar una categoría.
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
