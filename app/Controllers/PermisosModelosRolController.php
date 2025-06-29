<?php

namespace App\Controllers;

use App\Models\PermisosModel;
use App\Models\ModelosRolModel;
use App\Models\ModelosModel;
use App\Models\RolModel;
use App\Models\PermisosModelosRolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para la gestión de asignación de permisos a los modelos por rol.
 */
class PermisosModelosRolController extends Controller
{
    private $primaryKey;
    private $ModelosRolPermisosModel;
    private $data;
    private $model;

    /**
     * Constructor. Inicializa el modelo y otras variables del controlador.
     */
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->ModelosRolPermisosModel = new PermisosModelosRolModel();
        $this->data = [];
        $this->model = "ModelosRolPermisosModel";
    }

     /**
     * Vista principal de modelos-rol-permisos.
     * Carga datos necesarios para mostrar el listado y combos de modelos, roles y permisos.
     */
    public function index()
    {
    $this->data['title'] = "MODELOS ROL PERMISOS";

    $rolId = session()->get('rol_id');

    // Obtener módulos permitidos para el rol actual
    $modelosModel = new \App\Models\ModelosModel();
    $modulosPermitidos = $modelosModel->getModelosByRol($rolId);
    $this->data['modulos'] = $modulosPermitidos;

    // Permisos del usuario para la ruta actual
    $permisoRolModel = new \App\Models\PermisosModelosRolModel();

    // Ruta actual
    $rutaActual = "/modelorolpermisos"; // Asegúrate de que esta ruta coincida con la real

    $permisos_usuario = $permisoRolModel->getPermisosPorRol($rolId, $rutaActual);

    $this->data['permisos_usuario'] = $permisos_usuario;

    $modelos = new \App\Models\ModelosModel();
     // Cargar combos y registros
    $this->data['modelos'] = $modelos->findAll();

    $rol = new \App\Models\RolModel();
    $this->data['roles'] = $rol->findAll();
    $this->data['permisos'] = (new \App\Models\PermisosModel())->findAll();
    $this->data['modelosrol'] = $permisoRolModel->obtenerModelosRolConNombres();
    // Obtener todos los registros existentes
    $this->data[$this->model] = $this->ModelosRolPermisosModel->orderBy($this->primaryKey, 'ASC')->findAll();

    return view('modelosrolpermisos/modelosrolpermisos_view', $this->data); 
    }

    //Inserta un nuevo registro de permiso para modelo-rol vía AJAX.
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();

            if ($this->ModelosRolPermisosModel->insert($dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error creating record';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    //Obtiene un registro individual de permisos modelo-rol por ID.
    public function singleModelosRolPermisos($id = null)
    {
        if ($this->request->isAJAX()) {

            $record = $this->ModelosRolPermisosModel->where($this->primaryKey, $id)->first();
            if ($record) {
                $data[$this->model] = $record;
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error retrieving Model';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }

        echo json_encode($data);
    }

    // Actualiza un registro de permisos modelo-rol por ID.
    public function update()
{
    
    if ($this->request->isAJAX()) {
        $today = date("Y-m-d H:i:s");
        $id = $this->request->getVar($this->primaryKey);

        $modelosid = $this->request->getVar('Permisosid');
        $rolid = $this->request->getVar('ModelosRolId');

        // Asegurar que los valores no sean arrays
        if (is_array($modelosid)) {
            $modelosid = $modelosid[0]; 
        }
        if (is_array($rolid)) {
            $rolid = $rolid[0]; 
        }

        $dataModel = [
            'Permisosid' => $modelosid,
            'ModelosRolId' => $rolid,
            "updated_at" => $today
        ];

        if ($this->ModelosRolPermisosModel->update($id, $dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error updating model";
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

//Elimina un registro de la tabla permisos_modelos_rol por su ID.
public function delete($id = null)
{
    if ($this->request->isAJAX()) {
        if ($this->ModelosRolPermisosModel->delete($id)) {
            $data['message'] = 'success';
            $data['response'] = ResponseInterface::HTTP_OK;
        } else {
            $data['message'] = 'Error deleting record';
            $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        }
    } else {
        $data['message'] = 'Error Ajax';
        $data['response'] = ResponseInterface::HTTP_CONFLICT;
    }

    echo json_encode($data);
}

//Obtiene los datos enviados desde el formulario para insert/update.
    private function getDataModel()
    {
        return [
            'Permisosid' => $this->request->getVar('Permisosid'),
            'ModelosRolId' => $this->request->getVar('ModelosRolId'),
            'updated_at' => $this->request->getVar('updated_at') ?? date("Y-m-d H:i:s")
        ];
    }
   


}
