<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\CategoriaModel;
use App\Models\ProductosModel;
use App\Models\AlmacenamientoAleatorioModel;
use App\Models\AlmacenamientoModel;
use App\Models\ColorModel;
use App\Models\EstadoProductoModel;
use App\Models\GarantiaModel;
use App\Models\MarcaModel;
use App\Models\SistemaOperativoModel;
use App\Models\ResolucionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class CarritoController extends Controller
{
    // Mostrar vista del carrito
    public function carrito()
    {
        $session = session();
        $usuario_id = $session->get('id_usuario');
        $usuarioModel = new \App\Models\UsuarioModel();
        $idUsuario = session()->get('id_usuario');
        $usuario = $usuarioModel->find($idUsuario);

        $productosModel = new \App\Models\ProductosModel();
        $productos = $productosModel->findAll();

        $modelosModel = new \App\Models\ModelosModel();
        $rolId = session()->get('rol_id');
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        $model = new \App\Models\FacturaModel();
        $facturas = $model->getFacturas();

        $detalleFactura = [];

        // ✅ Accede correctamente a la primera factura
        if (!empty($facturas['data']['data'])) {
            $numeroFactura = $facturas['data']['data'][0]['number'];
            $detalleFactura = $model->getFacturaCompleta($numeroFactura);
        }

        // Validación de sesión si deseas forzar login
        if (!$usuario_id) {
            return redirect()->to('/logout');
        }

        $carritoModel = new CarritoModel();
        $categoriaModel = new CategoriaModel();

        // Obtener productos en el carrito del usuario actual con detalles del producto
        $carrito = $carritoModel
            ->select('carrito.*, productos.nom, productos.descripcion, productos.precio, productos.imagen')
            ->join('productos', 'productos.id = carrito.producto_id')
            ->where('carrito.usuario_id', $usuario_id)
            ->findAll();

        $categorias = $categoriaModel->findAll();

        return view('producto/carrito', [
            'productoscarrito' => $carrito,
            'categorias' => $categorias,
            'facturas'        => $facturas,
            'detalleFactura'  => $detalleFactura,
            'modulos'         => $modulosPermitidos,
            'title'           => 'Listado de Facturas',
            'usuario'         => $usuario,
            'productos'       => $productos
        ]);
    }

    // Agregar producto al carrito
    public function agregarAlCarrito()
    {
        $session = session();
        $usuario_id = $session->get('id_usuario');

        $producto_id = $this->request->getPost('producto_id');
        $cantidad = (int) $this->request->getPost('cantidad');

        $carritoModel = new CarritoModel();

        // Validación de sesión si deseas forzar login
        if (!$usuario_id) {
            return redirect()->to('/logout');
        }
        
        // Verifica si ya existe ese producto en el carrito
        $existente = $carritoModel
            ->where('usuario_id', $usuario_id)
            ->where('producto_id', $producto_id)
            ->first();

        if ($existente) {
            // Actualiza la cantidad
            $carritoModel->update($existente['carrito_id'], [
                'cantidad' => $existente['cantidad'] + $cantidad
            ]);
        } else {
            // Inserta nuevo producto al carrito
            $carritoModel->insert([
                'usuario_id' => $usuario_id,
                'producto_id' => $producto_id,
                'cantidad' => $cantidad
            ]);
        }

        return redirect()->to('/carrito');
    }

    // Eliminar producto del carrito
    public function eliminarDelCarrito($carrito_id)
    {
        $carritoModel = new CarritoModel();

        try {
            $carritoModel->delete($carrito_id);

            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(200)->setJSON(['success' => true]);
            }

            return redirect()->to('/carrito');
        } catch (\Exception $e) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON(['error' => 'Error al eliminar.']);
            }

            return redirect()->back()->with('error', 'Error al eliminar el producto.');
        }
    }

    // Vaciar carrito de compras
    public function vaciar()
    {
        $usuarioId = session('id_usuario');

        if (!$usuarioId) {
            return $this->response->setJSON(['error' => 'Usuario no autenticado'])->setStatusCode(401);
        }

        $carritoModel = new \App\Models\CarritoModel();

        try {
            $carritoModel->where('usuario_id', $usuarioId)->delete();
            log_message('info', '✅ Carrito vaciado desde CarritoController para usuario ID: ' . $usuarioId);
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            log_message('error', '❌ Error al vaciar carrito: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Error al vaciar carrito'])->setStatusCode(500);
        }
    }
    /**
     * Muestra la vista para la entrega de productos.
     * Carga las categorías disponibles.
     */
    public function entrega()
    {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();
        return view('pago/entrega', [
            'categorias' => $categorias
        ]);
    }

}