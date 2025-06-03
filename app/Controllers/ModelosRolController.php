<?php

namespace App\Controllers;

use App\Models\ModelosRolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ModelosRolController extends Controller
{
    private $primaryKey;
    private $ModelosRolModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = ['Modelosid', 'Rolid'];
        $this->ModelosRolModel = new ModelosRolModel();
        $this->data = [];
        $this->model = "ModelosRolModel";
    }

    public function index()
    {
        $this->data['title'] = "MODELOS_ROL";
        $this->data[$this->model] = $this->ModelosRolModel->findAll();
        return view('modelosrol/modelosrol_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();

            if ($this->ModelosRolModel->insert($dataModel)) {
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

    public function singleModelosRol($modelosid = null, $rolid = null)
    {
        if ($this->request->isAJAX()) {
            $data[$this->model] = $this->ModelosRolModel->where(['Modelosid' => $modelosid, 'Rolid' => $rolid])->first();
            
            if ($data[$this->model]) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error retrieving record';
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
            $dataModel = $this->getDataModel();

            if ($this->ModelosRolModel->update(['Modelosid' => $dataModel['Modelosid'], 'Rolid' => $dataModel['Rolid']], $dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error updating record';
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

    public function delete($modelosid = null, $rolid = null)
    {
        try {
            if ($this->ModelosRolModel->where(['Modelosid' => $modelosid, 'Rolid' => $rolid])->delete()) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = 'OK';
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error deleting record';
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

    private function getDataModel()
    {
        return [
            'Modelosid' => $this->request->getVar('Modelosid'),
            'Rolid' => $this->request->getVar('Rolid')
        ];
    }
}
