<?php

namespace App\Controllers;

use App\Models\EnvioModel;
use App\Models\EstadoEnvioModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EnvioController extends Controller
{
    private $primaryKey;
    private $EnvioModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = "id";
        $this->EnvioModel = new EnvioModel();
        $this->data = [];
        $this->model = "EnvioModel";
    }

    public function index()
    {
        $this->data['title'] = "Envíos";
        $this->data[$this->model] = $this->EnvioModel->orderBy($this->primaryKey, 'ASC')->findAll();

        $EstadoEnvio = new EstadoEnvioModel();
        $Usuario = new UsuarioModel();
        
        $this->data['EstadoEnvio'] = $EstadoEnvio->findAll();
        $this->data['Usuario'] = $Usuario->findAll();
        
        return view('envio/envio_view', $this->data);
    }

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

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = $this->getDataModel();
            if ($this->EnvioModel->update($id, $dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al actualizar el envío';
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

    public function getDataModel()
    {
        return [
            'direccion' => $this->request->getVar('direccion'),
            'fecha' => $this->request->getVar('fecha'),
            'estado_envio_id' => $this->request->getVar('estado_envio_id'),
            'usuario_id' => $this->request->getVar('usuario_id'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
}
