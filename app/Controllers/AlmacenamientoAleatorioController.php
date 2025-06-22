<?php

//Controlador para gestionar el almacenamiento aleatorio.
//  Proporciona funcionalidades CRUD utilizando AJAX.

namespace App\Controllers;

use App\Models\AlmacenamientoAleatorioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AlmacenamientoAleatorioController extends Controller
{

    //Llave primaria del modelo.
    private $primaryKey;
    //Instancia del modelo de almacenamiento aleatorio.
    private $AlmacenamientoAleatorioModel;
    //Datos compartidos con las vistas.
    private $data;
    //Nombre del modelo usado.
    private $model;

    

    // Constructor del controlador.
    //Inicializa la clave primaria, el modelo y el arreglo de datos.
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->AlmacenamientoAleatorioModel = new AlmacenamientoAleatorioModel();
        $this->data = [];
        $this->model = "AlmacenamientoAleatorioModel";
    }

    //Muestra la vista principal de almacenamiento aleatorio.
    //Carga los módulos permitidos según el rol de usuario.
    public function index()
    {
        $this->data["title"] = "ALMACENAMIENTO";
        $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->AlmacenamientoAleatorioModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("almacenamientoaleatorio/almacenamientoaleatorio_view", $this->data);
    }

    // Crea un nuevo registro de almacenamiento aleatorio vía AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->AlmacenamientoAleatorioModel->insert($dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al crear el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => ""
                ];
            }
        } else {
            $data = [
                "message" => "Error Ajax",
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => ""
            ];
        }
        echo json_encode($data);
    }

        //Obtiene un solo registro de almacenamiento por ID vía AJAX.
    public function singleAlmacenamiento($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->AlmacenamientoAleatorioModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener Almacenamiento";
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

    //Actualiza un registro existente de almacenamiento aleatorio vía AJAX.
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "num" => $this->request->getVar("num"),
                "unidadestandar" => $this->request->getVar("unidadestandar"),
                "updated_at" => date("Y-m-d H:i:s")
            ];

            if ($this->AlmacenamientoAleatorioModel->update($id, $dataModel)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => $dataModel,
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al actualizar el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => ""
                ];
            }
        } else {
            $data = [
                "message" => "Error Ajax",
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => ""
            ];
        }
        echo json_encode($data);
    }

    //Elimina un registro de almacenamiento aleatorio por ID.
    public function delete($id = null)
    {
        try {
            if ($this->AlmacenamientoAleatorioModel->where($this->primaryKey, $id)->delete($id)) {
                $data = [
                    "message" => "success",
                    "response" => ResponseInterface::HTTP_OK,
                    "data" => "OK",
                    "csrf" => csrf_hash()
                ];
            } else {
                $data = [
                    "message" => "Error al eliminar el almacenamiento",
                    "response" => ResponseInterface::HTTP_NO_CONTENT,
                    "data" => "error"
                ];
            }
        } catch (\Exception $e) {
            $data = [
                "message" => $e->getMessage(),
                "response" => ResponseInterface::HTTP_CONFLICT,
                "data" => "Error"
            ];
        }
        echo json_encode($data);
    }

    //Extrae y devuelve los datos del formulario para el modelo.

    private function getDataModel()
    {
        return [
            "num" => $this->request->getVar("num"),
            "unidadestandar" => $this->request->getVar("unidadestandar"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
    }
}
