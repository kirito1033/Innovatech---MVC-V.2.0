<?php

namespace App\Controllers;

use App\Models\EnvioModel;
use App\Models\EstadoEnvioModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador para la gestión de envíos en el sistema.
 * Permite operaciones CRUD y se comunica mediante peticiones AJAX para inserción, consulta y actualización.
 */
class EnvioController extends Controller
{
    private $primaryKey;
    private $EnvioModel;
    private $data;
    private $model;

    //Constructor
    // Inicializa el modelo de envío, clave primaria y propiedades de contexto.

    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EnvioModel = new EnvioModel();
        $this->data = [];
        $this->model = "EnvioModel";
    }

    //Muestra la vista principal con todos los envíos y datos relacionados.

    public function index()
    {
        $this->data['title'] = "Envíos";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->EnvioModel->orderBy($this->primaryKey, 'ASC')->findAll();

        // Cargar relaciones
        $EstadoEnvio = new EstadoEnvioModel();
        $Usuario = new UsuarioModel();
        
        $this->data['EstadoEnvio'] = $EstadoEnvio->findAll();
        $this->data['Usuario'] = $Usuario->where('rol_id', 5)->findAll();
        
        return view('envio/envio_view', $this->data);
    }

    //Inserta un nuevo envío (petición AJAX).

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->EnvioModel->insert($dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al crear el envío';
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

    //Consulta un envío individual por ID (AJAX).

    public function singleEnvio($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->EnvioModel->where($this->primaryKey, $id)->first()) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al obtener el envío';
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

    /**
     * Actualiza un envío existente.
     * Detecta si hubo cambio de estado y reinicia el envío de correo si aplica.
     * Llama al método `verificarEstados()` para gestionar lógicas adicionales.
     */
   public function update()
    {
        if ($this->request->isAJAX()) {
            $envioModel = new \App\Models\EnvioModel();
            $id = $this->request->getVar($this->primaryKey);

            // Detectar si hay cambio de estado
            $envioActual = $envioModel->find($id);
            $nuevoEstado = $this->request->getVar('estado_envio_id');

            $cambioEstado = ($envioActual && $envioActual['estado_envio_id'] != $nuevoEstado);

            $dataModel = [
                'numero'           => $this->request->getVar('numero'),
                'direccion'        => $this->request->getVar('direccion'),
                'fecha'            => $this->request->getVar('fecha'),
                'estado_envio_id'  => $nuevoEstado,
                'usuario_id'       => $this->request->getVar('usuario_id'),
                'correo'           => $this->request->getVar('correo'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ];
           
            // Reinicia el estado de envío de correo si cambió el estado
            if ($cambioEstado) {
                $dataModel['correo_estado_enviado'] = 0;
            }

            if ($envioModel->update($id, $dataModel)) {
                // ✅ Llamar al método del modelo
                $envioModel->verificarEstados(); // Verificación lógica adicional del modelo
 
                $data = [
                    'message'  => 'success',
                    'response' => ResponseInterface::HTTP_OK,
                    'data'     => $dataModel,
                    'csrf'     => csrf_hash()
                ];
            } else {
                $data = [
                    'message'  => 'Error al actualizar estado de envío',
                    'response' => ResponseInterface::HTTP_NO_CONTENT,
                    'data'     => ''
                ];
            }
        } else {
            $data = [
                'message'  => 'Error Ajax',
                'response' => ResponseInterface::HTTP_CONFLICT,
                'data'     => ''
            ];
        }

        echo json_encode($data);
    }



    //Elimina un envío por ID.

    public function delete($id = null)
    {
        try {
            if ($this->EnvioModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = 'OK';
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al eliminar el envío';
                $data['response'] = ResponseInterface::HTTP_CONFLICT;
                $data['data'] = 'error';
            }
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = 'Error';
        }
        echo json_encode($data);
    }

    //Recoge datos desde el formulario de creación/actualización.

    public function getDataModel()
    {
        return [
            'numero' => $this->request->getVar('numero'),
            'direccion' => $this->request->getVar('direccion'),
            'fecha' => $this->request->getVar('fecha'),
            'estado_envio_id' => $this->request->getVar('estado_envio_id'),
            'usuario_id' => $this->request->getVar('usuario_id'),
            'correo'       => $this->request->getVar('correo'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
    

}
