<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\AlmacenamientoAleatorioModel;
use App\Models\AlmacenamientoModel;
use App\Models\CategoriaModel;
use App\Models\ColorModel;
use App\Models\EstadoProductoModel;
use App\Models\GarantiaModel;
use App\Models\MarcaModel;
use App\Models\SistemaOperativoModel;
use App\Models\ResolucionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PedidoProveedorModel;

class ProductoController extends Controller
{
    private $primaryKey;
    private $productosModel;
    private $almacenamientoAleatorioModel;
    private $almacenamientoModel;
    private $categoriaModel;
    private $colorModel;
    private $estadoProductoModel;
    private $garantiaModel;
    private $marcaModel;
    private $sistemaOperativoModel;
    private $resolucionModel;
    private $data;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->productosModel = new ProductosModel();
        $this->almacenamientoAleatorioModel = new AlmacenamientoAleatorioModel();
        $this->almacenamientoModel = new AlmacenamientoModel();
        $this->categoriaModel = new CategoriaModel();
        $this->colorModel = new ColorModel();
        $this->estadoProductoModel = new EstadoProductoModel();
        $this->garantiaModel = new GarantiaModel();
        $this->marcaModel = new MarcaModel();
        $this->sistemaOperativoModel = new SistemaOperativoModel();
        $this->resolucionModel = new ResolucionModel();
        $this->data = [];
        $this->model = "productos";
    }

    // Método index
   public function index()
{
    $this->data["title"] = "PRODUCTOS";

    $productos = $this->productosModel->orderBy($this->primaryKey, "ASC")->findAll();
    $pedidoProveedorModel = new PedidoProveedorModel(); // Instancia para insertar pedido

    foreach ($productos as &$producto) {
        $id = $producto['id'];
        $existencias = (int)$producto['existencias'];
        $estadoActual = (int)$producto['id_estado'];

        // Si el estado no es reservado (4) ni devuelto (7), actualizar a En stock (1) o Agotado (2)
        if ($estadoActual !== 4 && $estadoActual !== 7) {
            $nuevoEstado = ($existencias === 0) ? 2 : 1;

            if ($estadoActual !== $nuevoEstado) {
                $this->productosModel->update($id, ['id_estado' => $nuevoEstado]);
                $producto['id_estado'] = $nuevoEstado;
            }

            // Si está agotado, insertar pedido automático
            if ($existencias === 0) {
                // Verificar si ya existe un pedido pendiente para este producto
                $pedidoExistente = $pedidoProveedorModel
                    ->where('producto_id', $id)
                    ->where('cantidad', 10)
                    ->where('id_proveedor', 1)
                    ->first();

                    $db = \Config\Database::connect();
                    $builder = $db->table('pedido_proveedor');
                    $ultimo = $builder->selectMax('numero_factura')->get()->getRow();
                    $numero_factura = ($ultimo && is_numeric($ultimo->numero_factura))
                        ? ((int)$ultimo->numero_factura)
                        : 1;

                    $pedidoProveedorModel->insert([
                        'numero_factura' => $numero_factura,
                        'id_proveedor' => 1,
                        'producto_id' => $id,
                        'cantidad' => 10,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                
            }
        }
    }

    // Resto igual
    $this->data["productos"] = $productos;
    $this->data["almacenamiento_aleatorio"] = $this->almacenamientoAleatorioModel->findAll();
    $this->data["almacenamiento"] = $this->almacenamientoModel->findAll();
    $this->data["categorias"] = $this->categoriaModel->findAll();
    $this->data["colores"] = $this->colorModel->findAll();
    $this->data["estado_productos"] = $this->estadoProductoModel->findAll();
    $this->data["garantias"] = $this->garantiaModel->findAll();
    $this->data["marcas"] = $this->marcaModel->findAll();
    $this->data["sistemas_operativos"] = $this->sistemaOperativoModel->findAll();
    $this->data["resoluciones"] = $this->resolucionModel->findAll();

    $rolId = session()->get('rol_id');
    $modelosModel = new \App\Models\ModelosModel();
    $this->data['modulos'] = $modelosModel->getModelosByRol($rolId);

    return view("producto/producto_view", $this->data);
}


    // Método create
    public function create()
    {
    if ($this->request->isAJAX()) {
        $dataModel = $this->getDataModel();
        
        // Manejo de imagen
        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);
            $dataModel["imagen"] = $newName;
        }

        if ($this->productosModel->insert($dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error al crear producto";
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

    // Método para obtener un solo producto
    public function singleProducto($id = null)
    {
        
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->productosModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener producto";
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

    // Método update
    public function update()
{
    if ($this->request->isAJAX()) {
        $today = date("Y-m-d H:i:s");
        $id = $this->request->getVar($this->primaryKey);

        // Obtener el producto actual de la base de datos
        $productoActual = $this->productosModel->find($id);

        if (!$productoActual) {
            $data["message"] = "Producto no encontrado";
            $data["response"] = ResponseInterface::HTTP_NOT_FOUND;
            $data["data"] = "";
            echo json_encode($data);
            return;
        }

        $nuevoPrecio = floatval($this->request->getVar("precio"));
        $precioOriginalActual = floatval($productoActual['precio_original']);

        // Evaluar si se actualiza el precio original
        if ($nuevoPrecio > $precioOriginalActual) {
            $precioOriginalActual = $nuevoPrecio;
        }
        $existencias = intval($this->request->getVar("existencias"));
        $estadoActual = intval($this->request->getVar("id_estado"));

        if ($estadoActual === 4 || $estadoActual === 7) {
            $idEstado = $estadoActual;
        } else {
            $idEstado = ($existencias == 0) ? 2 : 1; // 2 = Agotado, 1 = En stock
        }
        
       $dataModel = [
        "id" => $this->request->getVar("id"),
        "nom" => $this->request->getVar("nom"),
        "descripcion" => $this->request->getVar("descripcion"),
        "existencias" => $existencias,
        "precio" => $nuevoPrecio,
        "precio_original" => $precioOriginalActual,
        "id_estado" => $idEstado,
        "caracteristicas" => $this->request->getVar("caracteristicas"),
        "tam" => $this->request->getVar("tam"),
        "tampantalla" => $this->request->getVar("tampantalla"),
        "id_marca" => $this->request->getVar("id_marca"),
        "id_color" => $this->request->getVar("id_color"),
        "id_categoria" => $this->request->getVar("id_categoria"),
        "id_garantia" => $this->request->getVar("id_garantia"),
        "id_almacenamiento" => $this->request->getVar("id_almacenamiento"),
        "id_ram" => $this->request->getVar("id_ram"),
        "id_sistema_operativo" => $this->request->getVar("id_sistema_operativo"),
        "id_resolucion" => $this->request->getVar("id_resolucion"),
        "updated_at" => $today
    ];

        if ($this->productosModel->update($id, $dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error al actualizar producto";
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



    // Método delete
    public function delete($id = null)
    {

        try {
            if ($this->productosModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar producto";
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

    // Método para obtener los datos enviados en el formulario
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "descripcion" => $this->request->getVar("descripcion"),
            "existencias" => $this->request->getVar("existencias"),
            "precio" => $this->request->getVar("precio"),
            "caracteristicas" => $this->request->getVar("caracteristicas"),
            "tam" => $this->request->getVar("tam"),
            "tampantalla" => $this->request->getVar("tampantalla"),
            "id_marca" => $this->request->getVar("id_marca"),
            "id_estado" => $this->request->getVar("id_estado"),
            "id_color" => $this->request->getVar("id_color"),
            "id_categoria" => $this->request->getVar("id_categoria"),
            "id_garantia" => $this->request->getVar("id_garantia"),
            "id_almacenamiento" => $this->request->getVar("id_almacenamiento"),
            "id_ram" => $this->request->getVar("id_ram"),
            "id_sistema_operativo" => $this->request->getVar("id_sistema_operativo"),
            "id_resolucion" => $this->request->getVar("id_resolucion"),
            "precio_original" => $this->request->getVar("precio"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
        return $data;
    }
    
   public function updateImage()
{
    if ($this->request->isAJAX()) {

        $id = $this->request->getVar('id');

        // Verificar si el producto existe
        $producto = $this->productosModel->find($id);
        if (!$producto) {
            return $this->response->setJSON([
                'message' => 'Producto no encontrado',
                'response' => ResponseInterface::HTTP_NOT_FOUND
            ]);
        }

        // Obtener imagen
        $img = $this->request->getFile('imagen');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();

            // Ruta carpeta donde están las imágenes
            $uploadPath = ROOTPATH . 'public/uploads/';

            // Borrar imagen anterior si existe
            if (!empty($producto['imagen'])) {
                $oldImagePath = $uploadPath . $producto['imagen'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Mover nueva imagen
            $img->move($uploadPath, $newName);

            // Actualizar en la base de datos
            $this->productosModel->update($id, ['imagen' => $newName]);

            return $this->response->setJSON([
                'message' => 'success',
                'response' => ResponseInterface::HTTP_OK,
                'csrf' => csrf_hash(),
                'imagen' => $newName
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Error al subir imagen',
                'response' => ResponseInterface::HTTP_NO_CONTENT
            ]);
        }
    }

    return $this->response->setJSON([
        'message' => 'Petición inválida',
        'response' => ResponseInterface::HTTP_BAD_REQUEST
    ]);
}


public function ver($id = null)
{
    $productoModel = new ProductosModel();
    $categoriaModel = new CategoriaModel();
    $session = session();
    
    $data['usuario'] = $session->get('usuario'); // O $data['session'] = $session->get();
    $data['categorias'] = $categoriaModel->findAll();
    $data['producto'] = $productoModel->getProductoConRelaciones($id);

    if (!$data['producto']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto con ID $id no encontrado");
    }

 
    return view('producto/ver', $data);
}
public function preguntar($id)
{
    $pregunta = $this->request->getPost('pregunta');
    return redirect()->to("/producto/ver/$id")->with('message', 'Pregunta enviada');
}
public function carrito(){

    $productoModel = new ProductosModel();
    $categoriaModel = new CategoriaModel();
    $marcaModel = new MarcaModel();
    $colorModel = new ColorModel();
    $ramModel = new AlmacenamientoAleatorioModel();
    $almacenamientoModel = new AlmacenamientoModel();
    $estadoModel = new EstadoProductoModel();
    $garantiaModel = new GarantiaModel();
    $sistemaOperativoModel = new SistemaOperativoModel();
    $resolucionModel = new ResolucionModel();
    $data['productos'] = $productoModel->findAll();
    $data['categorias'] = $categoriaModel->findAll();
    $data['marcas'] = $categoriaModel->findAll();
    $data['colores'] = $categoriaModel->findAll();
    return view('producto/carrito', $data);

}
public function listarProductos($id = null)
{
    $productoModel = new ProductosModel();
    $categoriaModel = new CategoriaModel();
    $marcaModel = new MarcaModel();
    $colorModel = new ColorModel();
    $ramModel = new AlmacenamientoAleatorioModel();
    $almacenamientoModel = new AlmacenamientoModel();
    $estadoModel = new EstadoProductoModel();
    $garantiaModel = new GarantiaModel();
    $sistemaOperativoModel = new SistemaOperativoModel();
    $resolucionModel = new ResolucionModel();

    $session = session();

    $data['categorias'] = $categoriaModel->findAll();
    $data['usuario'] = $session->get('usuario');

    if ($id !== null) {
        $categoria = $categoriaModel->find($id);
        if (!$categoria) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Categoría con ID $id no encontrada");
        }
        $data['categoriaSeleccionada'] = $categoria;

        // Filtro por categoría
        $productoModel->where('id_categoria', $id);
    }

    // Obtener filtros desde GET
    $filtros = [
        'nom' => $this->request->getGet('nom'),
        'precio_min' => $this->request->getGet('precio_min'),
        'precio_max' => $this->request->getGet('precio_max'),
        'id_marca' => $this->request->getGet('id_marca'),
        'id_color' => $this->request->getGet('id_color'),
        'id_ram' => $this->request->getGet('id_ram'),
        'id_almacenamiento' => $this->request->getGet('id_almacenamiento'),
        'tam' => $this->request->getGet('tam'),
        'tampantalla' => $this->request->getGet('tampantalla'),
        'id_estado' => $this->request->getGet('id_estado'),
        'id_garantia' => $this->request->getGet('id_garantia'),
        'id_sistema_operativo' => $this->request->getGet('id_sistema_operativo'),
        'id_resolucion' => $this->request->getGet('id_resolucion'),
    ];

    // Búsqueda por nombre y marcas relacionadas
   if (!empty($filtros['nom'])) {
    // Buscar marcas que coincidan con el término
    $marcasCoincidentes = $marcaModel->like('nom', $filtros['nom'])->findAll();
    $marcasIdsCoincidentes = array_column($marcasCoincidentes, 'id');

    // Buscar categorías que coincidan con el término
    $categoriasCoincidentes = $categoriaModel->like('nom', $filtros['nom'])->findAll();
    $categoriasIdsCoincidentes = array_column($categoriasCoincidentes, 'id');

    // Agrupar condiciones para el producto
    $productoModel->groupStart()
                  ->like('nom', $filtros['nom']); // nombre producto
                  
    // Si hay marcas coincidentes, agregarlas a la búsqueda con OR
    if (!empty($marcasIdsCoincidentes)) {
        $productoModel->orWhereIn('id_marca', $marcasIdsCoincidentes);
    }

    // Si hay categorías coincidentes, agregarlas también con OR
    if (!empty($categoriasIdsCoincidentes)) {
        $productoModel->orWhereIn('id_categoria', $categoriasIdsCoincidentes);
    }

    $productoModel->groupEnd();
}


    // Aplicar los demás filtros
    if (!empty($filtros['precio_min'])) {
        $productoModel->where('precio >=', $filtros['precio_min']);
    }
    if (!empty($filtros['precio_max'])) {
        $productoModel->where('precio <=', $filtros['precio_max']);
    }
    if (!empty($filtros['id_marca'])) {
        $productoModel->where('id_marca', $filtros['id_marca']);
    }
    if (!empty($filtros['id_color'])) {
        $productoModel->where('id_color', $filtros['id_color']);
    }
    if (!empty($filtros['id_ram'])) {
        $productoModel->where('id_ram', $filtros['id_ram']);
    }
    if (!empty($filtros['id_almacenamiento'])) {
        $productoModel->where('id_almacenamiento', $filtros['id_almacenamiento']);
    }
    if (!empty($filtros['tam'])) {
        $productoModel->where('tam', $filtros['tam']);
    }
    if (!empty($filtros['tampantalla'])) {
        $productoModel->where('tampantalla', $filtros['tampantalla']);
    }
    if (!empty($filtros['id_estado'])) {
        $productoModel->where('id_estado', $filtros['id_estado']);
    }
    if (!empty($filtros['id_garantia'])) {
        $productoModel->where('id_garantia', $filtros['id_garantia']);
    }
    if (!empty($filtros['id_sistema_operativo'])) {
        $productoModel->where('id_sistema_operativo', $filtros['id_sistema_operativo']);
    }
    if (!empty($filtros['id_resolucion'])) {
        $productoModel->where('id_resolucion', $filtros['id_resolucion']);
    }

    $data['productos'] = $productoModel->findAll();

    // Solo generar los filtros dinámicos si hay categoría
    if ($id !== null) {
        $productosCategoria = new ProductosModel();

        $productosCategoria->select('id_marca, id_color, id_ram, id_almacenamiento, id_estado, id_garantia, id_sistema_operativo, id_resolucion')
                           ->where('id_categoria', $id)
                           ->groupBy('id_marca, id_color, id_ram, id_almacenamiento, id_estado, id_garantia, id_sistema_operativo, id_resolucion');

        $resultados = $productosCategoria->findAll();

        $marcasIds = $coloresIds = $ramsIds = $almacenamientosIds = $estadosIds = $garantiasIds = $soIds = $resolucionesIds = [];

        foreach ($resultados as $item) {
            if (!empty($item['id_marca'])) $marcasIds[] = $item['id_marca'];
            if (!empty($item['id_color'])) $coloresIds[] = $item['id_color'];
            if (!empty($item['id_ram'])) $ramsIds[] = $item['id_ram'];
            if (!empty($item['id_almacenamiento'])) $almacenamientosIds[] = $item['id_almacenamiento'];
            if (!empty($item['id_estado'])) $estadosIds[] = $item['id_estado'];
            if (!empty($item['id_garantia'])) $garantiasIds[] = $item['id_garantia'];
            if (!empty($item['id_sistema_operativo'])) $soIds[] = $item['id_sistema_operativo'];
            if (!empty($item['id_resolucion'])) $resolucionesIds[] = $item['id_resolucion'];
        }

        $data['marcas'] = !empty($marcasIds) ? $marcaModel->whereIn('id', $marcasIds)->findAll() : [];
        $data['colores'] = !empty($coloresIds) ? $colorModel->whereIn('id_color', $coloresIds)->findAll() : [];
        $data['rams'] = !empty($ramsIds) ? $ramModel->whereIn('id', $ramsIds)->findAll() : [];
        $data['almacenamientos'] = !empty($almacenamientosIds) ? $almacenamientoModel->whereIn('id', $almacenamientosIds)->findAll() : [];
        $data['estados'] = !empty($estadosIds) ? $estadoModel->whereIn('id', $estadosIds)->findAll() : [];
        $data['garantias'] = !empty($garantiasIds) ? $garantiaModel->whereIn('id', $garantiasIds)->findAll() : [];
        $data['sistemas_operativos'] = !empty($soIds) ? $sistemaOperativoModel->whereIn('id', $soIds)->findAll() : [];
        $data['resoluciones'] = !empty($resolucionesIds) ? $resolucionModel->whereIn('id', $resolucionesIds)->findAll() : [];
    } else {
        // Si no hay categoría, puedes cargar todas las opciones posibles o dejarlas vacías
        $data['marcas'] = $marcaModel->findAll();
        $data['colores'] = $colorModel->findAll();
        $data['rams'] = $ramModel->findAll();
        $data['almacenamientos'] = $almacenamientoModel->findAll();
        $data['estados'] = $estadoModel->findAll();
        $data['garantias'] = $garantiaModel->findAll();
        $data['sistemas_operativos'] = $sistemaOperativoModel->findAll();
        $data['resoluciones'] = $resolucionModel->findAll();
    }

    return view('producto/listarproducto', $data);
}


public function listarOfertas($id = 6)
{
    $productoModel = new ProductosModel();
    $categoriaModel = new CategoriaModel();
    $marcaModel = new MarcaModel();
    $colorModel = new ColorModel();
    $ramModel = new AlmacenamientoAleatorioModel();
    $almacenamientoModel = new AlmacenamientoModel();
    $estadoModel = new EstadoProductoModel();
    $garantiaModel = new GarantiaModel();
    $sistemaOperativoModel = new SistemaOperativoModel();
    $resolucionModel = new ResolucionModel();
   
    // NO se usa TamPantallaModel porque tampantalla es atributo normal

    $session = session();

    $data['categorias'] = $categoriaModel->findAll();
    $data['usuario'] = $session->get('usuario');

    // Verificar categoría
    $categoria = $categoriaModel->find($id);
    if (!$categoria) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Categoría con ID $id no encontrada");
    }
    $data['categoriaSeleccionada'] = $categoria;

    // Aplicar filtro base de categoría
    $productoModel->where('id_categoria', $id);

    // Obtener filtros desde GET
    $filtros = [
        'nom' => $this->request->getGet('nom'),
        'precio_min' => $this->request->getGet('precio_min'),
        'precio_max' => $this->request->getGet('precio_max'),
        'id_marca' => $this->request->getGet('id_marca'),
        'id_color' => $this->request->getGet('id_color'),
        'id_ram' => $this->request->getGet('id_ram'),
        'id_almacenamiento' => $this->request->getGet('id_almacenamiento'),
        'tam' => $this->request->getGet('tam'),
        'tampantalla' => $this->request->getGet('tampantalla'),
        'id_estado' => $this->request->getGet('id_estado'),
        'id_garantia' => $this->request->getGet('id_garantia'),
        'id_sistema_operativo' => $this->request->getGet('id_sistema_operativo'),
        'id_resolucion' => $this->request->getGet('id_resolucion'),
    ];

    // Filtro por nombre o marcas que coincidan con el nombre
    if (!empty($filtros['nom'])) {
        $marcasCoincidentes = $marcaModel->like('nom', $filtros['nom'])->findAll();
        $marcasIdsCoincidentes = array_column($marcasCoincidentes, 'id');

        $productoModel->groupStart()
                      ->like('nom', $filtros['nom']);
        if (!empty($marcasIdsCoincidentes)) {
            $productoModel->orWhereIn('id_marca', $marcasIdsCoincidentes);
        }
        $productoModel->groupEnd();
    }

    // Aplicar filtros restantes
    if (!empty($filtros['precio_min'])) {
        $productoModel->where('precio >=', $filtros['precio_min']);
    }
    if (!empty($filtros['precio_max'])) {
        $productoModel->where('precio <=', $filtros['precio_max']);
    }
    if (!empty($filtros['id_marca'])) {
        $productoModel->where('id_marca', $filtros['id_marca']);
    }
    if (!empty($filtros['id_color'])) {
        $productoModel->where('id_color', $filtros['id_color']);
    }
    if (!empty($filtros['id_ram'])) {
        $productoModel->where('id_ram', $filtros['id_ram']);
    }
    if (!empty($filtros['id_almacenamiento'])) {
        $productoModel->where('id_almacenamiento', $filtros['id_almacenamiento']);
    }
    if (!empty($filtros['tam'])) {
        $productoModel->where('tam', $filtros['tam']);
    }
    if (!empty($filtros['tampantalla'])) {
        $productoModel->where('tampantalla', $filtros['tampantalla']);
    }
    if (!empty($filtros['id_estado'])) {
        $productoModel->where('id_estado', $filtros['id_estado']);
    }
    if (!empty($filtros['id_garantia'])) {
        $productoModel->where('id_garantia', $filtros['id_garantia']);
    }
    if (!empty($filtros['id_sistema_operativo'])) {
        $productoModel->where('id_sistema_operativo', $filtros['id_sistema_operativo']);
    }
    if (!empty($filtros['id_resolucion'])) {
        $productoModel->where('id_resolucion', $filtros['id_resolucion']);
    }

    // Obtener productos filtrados
    $data['productos'] = $productoModel->findAll();

    // Para cargar filtros dinámicos, obtenemos los valores únicos desde la tabla productos para esta categoría
    // NOTA: aquí sacamos arrays únicos para poder cargar filtros

    $productosCategoria = new ProductosModel();

    // Sacar valores únicos para filtros con llave foránea
    $productosCategoria->select('id_marca, id_color, id_ram, id_almacenamiento, id_estado, id_garantia, id_sistema_operativo, id_resolucion')
                       ->where('id_categoria', $id)
                       ->groupBy('id_marca, id_color, id_ram, id_almacenamiento, id_estado, id_garantia, id_sistema_operativo, id_resolucion');
    $resultados = $productosCategoria->findAll();

    $marcasIds = [];
    $coloresIds = [];
    $ramsIds = [];
    $almacenamientosIds = [];
    $estadosIds = [];
    $garantiasIds = [];
    $soIds = [];
    $resolucionesIds = [];

    foreach ($resultados as $item) {
        if (!empty($item['id_marca'])) $marcasIds[] = $item['id_marca'];
        if (!empty($item['id_color'])) $coloresIds[] = $item['id_color'];
        if (!empty($item['id_ram'])) $ramsIds[] = $item['id_ram'];
        if (!empty($item['id_almacenamiento'])) $almacenamientosIds[] = $item['id_almacenamiento'];
        if (!empty($item['id_estado'])) $estadosIds[] = $item['id_estado'];
        if (!empty($item['id_garantia'])) $garantiasIds[] = $item['id_garantia'];
        if (!empty($item['id_sistema_operativo'])) $soIds[] = $item['id_sistema_operativo'];
        if (!empty($item['id_resolucion'])) $resolucionesIds[] = $item['id_resolucion'];
    }

    // Sacar valores únicos para 'tam' y 'tampantalla' desde productos (atributos normales)
    
                           

    // Cargar listas para filtros
    $data['marcas'] = !empty($marcasIds) ? $marcaModel->whereIn('id', $marcasIds)->findAll() : [];
    $data['colores'] = !empty($coloresIds) ? $colorModel->whereIn('id_color', $coloresIds)->findAll() : [];
    $data['rams'] = !empty($ramsIds) ? $ramModel->whereIn('id', $ramsIds)->findAll() : [];
    $data['almacenamientos'] = !empty($almacenamientosIds) ? $almacenamientoModel->whereIn('id', $almacenamientosIds)->findAll() : [];
    $data['estados'] = !empty($estadosIds) ? $estadoModel->whereIn('id', $estadosIds)->findAll() : [];
    $data['garantias'] = !empty($garantiasIds) ? $garantiaModel->whereIn('id', $garantiasIds)->findAll() : [];
    $data['sistemas_operativos'] = !empty($soIds) ? $sistemaOperativoModel->whereIn('id', $soIds)->findAll() : [];
    $data['resoluciones'] = !empty($resolucionesIds) ? $resolucionModel->whereIn('id', $resolucionesIds)->findAll() : [];

    // Para 'tam' y 'tampantalla', como son atributos normales, enviamos los arrays únicos directamente
    $data['tams'] = !empty($tamsIds) ? $tamModel->whereIn('id', $tamsIds)->findAll() : [];
    // Si 'tam' no es llave foránea, simplemente enviar $tamsIds directamente
    // $data['tams'] = $tamsIds;


    return view('oferta/oferta_home', $data);
}
}

   
