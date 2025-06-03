<?php 

namespace App\Controllers;

use App\Models\IngresoProductoModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class IngresoProductoController extends Controller
{
    private $primaryKey;
    private $IngresoProductoModel;
    private $data;
    private $model;

    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->IngresoProductoModel = new IngresoProductoModel(); 
        $this->data = []; 
        $this->model = "IngresoProductoModel"; 
    }

    public function index() 
    { 
        $Usuario = new UsuarioModel();
        $this->data['usuario'] = $Usuario->findAll();
        $this->data['title'] = "Ingreso de Producto"; 
        $this->data[$this->model] = $this->IngresoProductoModel->orderBy($this->primaryKey, 'ASC')->findAll();

        return view('ingresoproducto/ingresoproducto_view', $this->data); 
    }

    public function create() 
    { 
        if ($this->request->isAJAX()) { 
            $dataModel = $this->getDataModel(); 

            if ($this->IngresoProductoModel->insert($dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error al crear ingreso de producto'; 
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

    public function singleIngresoProducto($id = null) 
    { 
        if ($this->request->isAJAX()) { 
            if ($data[$this->model] = $this->IngresoProductoModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error al obtener el ingreso de producto'; 
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
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            
            $dataModel = [
                'id' => $this->request->getVar('id'), 
                'factura' => $this->request->getVar('factura'), 
                'UsuarioId_usuario2' => $this->request->getVar('UsuarioId_usuario2'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->IngresoProductoModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error al actualizar ingreso de producto'; 
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
            if ($this->IngresoProductoModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error al eliminar ingreso de producto'; 
                $data['response'] = ResponseInterface::HTTP_CONFLICT; 
                $data['data'] = 'error'; 
            } 
        } catch (\Exception $e) { 
            $data['message'] = $e; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = 'Error'; 
        } 
        echo json_encode($data);  
    }

    public function getDataModel() 
    { 
        $data = [ 
            'factura' => $this->request->getVar('factura'), 
            'UsuarioId_usuario2' => $this->request->getVar('UsuarioId_usuario2'), 
            'updated_at' => $this->request->getVar('updated_at')
        ]; 
        return $data; 
    }
}
