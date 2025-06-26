<?php

namespace App\Controllers;

use App\Models\TipoPqrsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador encargado de gestionar los Tipos de PQRS.
 * Permite realizar operaciones CRUD a través de peticiones AJAX.
 */
class TipoPqrsController extends Controller
{
    private $primaryKey;
    private $TipoPqrsModel;
    private $data;
    private $model;

    /**
     * Constructor del controlador.
     * Inicializa las propiedades del modelo, clave primaria y nombre lógico.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->TipoPqrsModel = new TipoPqrsModel();
        $this->data = [];
        $this->model = "TipoPqrsModel";
    }

    /**
     * Carga la vista principal con la lista de tipos de PQRS disponibles.
     * También carga los módulos permitidos según el rol del usuario.
     */
    public function index()
    {
        $this->data["title"] = "TIPO PQRS";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->TipoPqrsModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("tipopqrs/tipopqrs_view", $this->data);
    }

    /**
     * Crea un nuevo registro de Tipo PQRS.
     * Solo se permite mediante peticiones AJAX.
     */
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->TipoPqrsModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating Tipo PQRS";
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
     * Obtiene un Tipo PQRS específico por su ID.
     * Solo responde a solicitudes AJAX.
     */
    public function singleTipoPqrs($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->TipoPqrsModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error retrieving Tipo PQRS";
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
     * Actualiza un Tipo PQRS existente.
     * La solicitud debe ser AJAX.
     */
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "descripcion" => $this->request->getVar("descripcion"),
                "updated_at" => $today
            ];
            if ($this->TipoPqrsModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating Tipo PQRS";
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
     * Elimina un registro de Tipo PQRS por ID.
     * Maneja excepciones y responde en formato JSON.
     */
    public function delete($id = null)
    {
        try {
            if ($this->TipoPqrsModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting Tipo PQRS";
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

    //Método auxiliar para extraer los datos del formulario o solicitud AJAX.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "descripcion" => $this->request->getVar("descripcion"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
