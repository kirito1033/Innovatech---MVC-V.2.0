<?php
namespace App\Controllers;
use App\Models\PqrsModel;
use App\Models\UsuarioModel;
use App\Models\TipoPqrsModel;
use App\Models\EstadoPqrsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoriaModel;

/**
 * Controlador para gestionar el módulo de PQRS (Peticiones, Quejas, Reclamos y Sugerencias).
 */
class PqrsController extends Controller
{
    private $primaryKey;
    private $PqrsModel;
    private $data;
    private $model;

    /**
     * Constructor que inicializa propiedades y el modelo principal.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->PqrsModel = new PqrsModel();
        $this->data = [];
        $this->model = "PqrsModel";
    }

    /**
     * Vista principal de administración de PQRS.
     * Carga todos los registros de PQRS y datos relacionados para la vista de administración.
     */
    public function index()
    {
        $EstadoPqrs = new EstadoPqrsModel();
        $TipoPqrs  = new TipoPqrsModel();
        $Usuario = new UsuarioModel();
        
        // Datos de apoyo
        $this->data['EstadoPqrs'] = $EstadoPqrs->findAll();
        $this->data['TipoPqrs'] = $TipoPqrs->findAll();
        $this->data['Usuario'] = $Usuario->findAll();

        // Título y módulos según el rol
        $this->data["title"] = "PQRS";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        // Listado completo de PQRS
        $this->data[$this->model] = $this->PqrsModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("pqrs/pqrs_view", $this->data);
    }

    // Crea un nuevo registro de PQRS (solo por AJAX).
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();

            // Obtener el ID del usuario logueado
            $session = session();
            $idUsuario = $session->get('id_usuario');

            // Asegurar que comentario_respuesta sea opcional
            if (empty($dataModel['comentario_respuesta'])) {
                $dataModel['comentario_respuesta'] = null;
            }

            // Asignar el ID del usuario logueado
            $dataModel['usuario_id'] = $idUsuario;

            if ($this->PqrsModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating PQRS";
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

    //Obtiene una PQRS por ID (solo por AJAX).
    public function singlePqrs($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->PqrsModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching PQRS";
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

    //Actualiza una PQRS existente por ID (solo por AJAX).
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "descripcion" => $this->request->getVar("descripcion"),
                "comentario_respuesta" => $this->request->getVar("comentario_respuesta"),
                "tipo_pqrs_id" => $this->request->getVar("tipo_pqrs_id"),
                "usuario_id" => $this->request->getVar("usuario_id"),
                "estado_pqrs_id" => $this->request->getVar("estado_pqrs_id"),
                "updated_at" => $today
            ];
            if ($this->PqrsModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating PQRS";
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

    //Elimina un registro PQRS por ID.
    public function delete($id = null)
    {
        try {
            if ($this->PqrsModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting PQRS";
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

    //Recupera los datos del formulario o solicitud.
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "descripcion" => $this->request->getVar("descripcion"),
            "comentario_respuesta" => $this->request->getVar("comentario_respuesta"),
            "tipo_pqrs_id" => $this->request->getVar("tipo_pqrs_id"),
            "usuario_id" => $this->request->getVar("usuario_id"),
            "estado_pqrs_id" => $this->request->getVar("estado_pqrs_id"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
    //Vista para que un cliente vea sus propias PQRS.
    public function PqrsCliente()
    {
    $session = session();
    $idUsuario = $session->get('id_usuario'); // Asegúrate que esta clave existe en tu sesión

    $EstadoPqrs = new EstadoPqrsModel();
    $TipoPqrs  = new TipoPqrsModel();
    $Usuario = new UsuarioModel();
    $categoriaModel = new CategoriaModel();

    $this->data['categorias'] = $categoriaModel->findAll();
    $this->data['EstadoPqrs'] = $EstadoPqrs->findAll();
    $this->data['TipoPqrs'] = $TipoPqrs->findAll();
    $this->data['Usuario'] = $Usuario->findAll();
    $this->data["title"] = "PQRS";

    // 🔍 Filtramos solo las PQRS del usuario actual
    $this->data[$this->model] = $this->PqrsModel
        ->where('usuario_id', $idUsuario)
        ->orderBy($this->primaryKey, 'ASC')
        ->findAll();

    return view("pqrs/pqrs_form_view", $this->data);
    }

   


}
