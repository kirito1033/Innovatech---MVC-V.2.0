<?php

namespace App\Controllers;

use App\Models\TipoDocumentoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para la gestión de Tipos de Documento.
 * Realiza operaciones CRUD sobre la entidad TipoDocumento.
 */
class TipoDocumentoController extends Controller
{
    private $primaryKey;
    private $TipoDocumentoModel;
    private $data;
    private $model;

    /**
     * Constructor del controlador.
     * Inicializa variables importantes y la instancia del modelo.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->TipoDocumentoModel = new TipoDocumentoModel();
        $this->data = [];
        $this->model = "TipoDocumentoModel";
    }

    /**
     * Método principal que muestra la vista de tipo de documento.
     * Carga los módulos permitidos y todos los tipos de documento disponibles.
     */
    public function index()
    {
        $this->data["title"] = "TIPO DE DOCUMENTO";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Cargar los módulos permitidos según el rol del usuario
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        // Obtener todos los registros ordenados por ID
        $this->data[$this->model] = $this->TipoDocumentoModel->orderBy($this->primaryKey, "ASC")->findAll();
       // Cargar la vista correspondiente
        return view("tipodocumento/tipodocumento_view", $this->data);
    }

    /**
     * Crea un nuevo tipo de documento (vía AJAX).
     * Devuelve la respuesta en formato JSON.
     */
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->TipoDocumentoModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create tipo documento";
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

    //Obtiene un tipo de documento específico por su ID (vía AJAX).
    public function singleTipoDocumento($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->TipoDocumentoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetch tipo documento";
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

    //Actualiza un tipo de documento existente (vía AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "updated_at" => $today
            ];
            if ($this->TipoDocumentoModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error update tipo documento";
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

    //Elimina un tipo de documento por su ID.
    public function delete($id = null)
    {
        try {
            if ($this->TipoDocumentoModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error delete tipo documento";
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

    //Método auxiliar para obtener los datos enviados por POST o AJAX.
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