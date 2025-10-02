<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\CategoriaModel;
use App\Models\ProductosModel;
use CodeIgniter\Controller;

class CarritoController extends Controller
{
    // Vista web del carrito
    public function carrito()
    {
        $session = session();
        $usuario_id = $session->get('id_usuario');

        if (!$usuario_id) {
            return redirect()->to('/logout');
        }

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find($usuario_id);

        $productosModel = new ProductosModel();
        $productos = $productosModel->findAll();

        $carritoModel = new CarritoModel();
        $carrito = $carritoModel
            ->select('carrito.*, productos.nom, productos.descripcion, productos.precio, productos.imagen')
            ->join('productos', 'productos.id = carrito.producto_id')
            ->where('carrito.usuario_id', $usuario_id)
            ->findAll();

        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        return view('producto/carrito', [
            'productoscarrito' => $carrito,
            'categorias'       => $categorias,
            'usuario'          => $usuario,
            'productos'        => $productos
        ]);
    }

    // API: Obtener carrito
    public function obtenerCarrito()
    {
        $usuario_id = session('id_usuario');

        if (!$usuario_id) {
            return $this->response->setJSON(['error' => 'Usuario no autenticado'])->setStatusCode(401);
        }

        $carritoModel = new CarritoModel();
        $carrito = $carritoModel
            ->select('carrito.carrito_id, carrito.cantidad, productos.nom as nombre, productos.descripcion, productos.precio, productos.imagen')
            ->join('productos', 'productos.id = carrito.producto_id')
            ->where('carrito.usuario_id', $usuario_id)
            ->findAll();

        return $this->response->setJSON($carrito);
    }

    // API: Agregar producto al carrito
    public function agregarApi()
    {
        $usuario_id = session('id_usuario');
        if (!$usuario_id) {
            return $this->response->setJSON(['error' => 'Usuario no autenticado'])->setStatusCode(401);
        }

        $producto_id = $this->request->getPost('producto_id');
        $cantidad    = (int) $this->request->getPost('cantidad');

        $carritoModel = new CarritoModel();

        $existente = $carritoModel
            ->where('usuario_id', $usuario_id)
            ->where('producto_id', $producto_id)
            ->first();

        if ($existente) {
            $carritoModel->update($existente['carrito_id'], [
                'cantidad' => $existente['cantidad'] + $cantidad
            ]);
        } else {
            $carritoModel->insert([
                'usuario_id'  => $usuario_id,
                'producto_id' => $producto_id,
                'cantidad'    => $cantidad
            ]);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Producto agregado']);
    }

    // API: Eliminar un producto
    public function eliminarApi($carrito_id)
    {
        $carritoModel = new CarritoModel();
        try {
            $carritoModel->delete($carrito_id);
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }

    // API: Vaciar carrito
    public function vaciarApi()
    {
        $usuario_id = session('id_usuario');
        if (!$usuario_id) {
            return $this->response->setJSON(['error' => 'Usuario no autenticado'])->setStatusCode(401);
        }

        $carritoModel = new CarritoModel();
        $carritoModel->where('usuario_id', $usuario_id)->delete();

        return $this->response->setJSON(['success' => true]);
    }
}
