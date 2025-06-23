<?php

namespace App\Controllers;

use App\Models\MarcaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//Controlador para gestionar las operaciones CRUD de la entidad Marca.
class MarcaController extends Controller
{
    private $primaryKey; //Clave primaria de la tabla
    private $MarcaModel; //Instancia del modelo MarcaModel
    private $data; // Array de datos para enviar a la vista
    private $model; // Nombre del modelo como string

    // Constructor: inicializa propiedades básicas del controlador. 
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->MarcaModel = new MarcaModel();
        $this->data = [];
        $this->model = "MarcaModel";
    }

    // Método principal para cargar la vista de marcas.
    // Obtiene los módulos permitidos para el usuario actual y las marcas registradas.
    public function index()
    {
        $this->data["title"] = "MARCA";

         $rolId = session()->get('rol_id'); // Obtener ID del rol del usuario actual
        $modelosModel = new \App\Models\ModelosModel();

        // Consultar los módulos accesibles según el rol
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

       // Enviar datos a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->MarcaModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("marca/marca_view", $this->data);
    }

    // Crea una nueva marca a través de una solicitud AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->MarcaModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash(); // Nuevo token CSRF
            } else {
                $data["message"] = "Error al crear marca";
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

    //Obtiene una marca específica por ID vía AJAX.
    public function singleMarca($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->MarcaModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener marca";
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

    //Actualiza los datos de una marca existente vía AJAX.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->MarcaModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar marca";
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

    //Elimina una marca por ID.
    public function delete($id = null)
    {
        try {
            if ($this->MarcaModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar marca";
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

    //Extrae los datos desde la solicitud para usarlos en inserción o actualización.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}