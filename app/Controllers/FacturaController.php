<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\EstadoFacturaModel;
use App\Models\PedidoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class FacturaController extends Controller
{
    private $primaryKey;
    private $facturaModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = "id";
        $this->facturaModel = new FacturaModel();
        $this->data = [];
        $this->model = "FacturaModel";
    }

    public function index()
    {
        $this->data['title'] = "Facturas";
        $this->data[$this->model] = $this->facturaModel->orderBy($this->primaryKey, 'ASC')->findAll();

        $estadoFactura = new EstadoFacturaModel();
        $pedido = new PedidoModel();
        
        $this->data['EstadoFactura'] = $estadoFactura->findAll();
        $this->data['Pedido'] = $pedido->findAll();
        
        return view('factura/factura_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->facturaModel->insert($dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al crear la factura';
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

    public function singleFactura($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->facturaModel->where($this->primaryKey, $id)->first()) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al obtener la factura';
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
            if ($this->facturaModel->update($id, $dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al actualizar la factura';
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
            if ($this->facturaModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = 'OK';
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al eliminar la factura';
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
            'fecha' => $this->request->getVar('fecha'),
            'valortl' => $this->request->getVar('valortl'),
            'metodopago' => $this->request->getVar('metodopago'),
            'Estado_facturaId_Estado_factura' => $this->request->getVar('Estado_facturaId_Estado_factura'),
            'Pedidoid' => $this->request->getVar('Pedidoid'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
}
