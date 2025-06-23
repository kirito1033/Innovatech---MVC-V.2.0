<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('departamento',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "DepartamentoController::index");
    $routes->get("show", "DepartamentoController::index");
    $routes->get("edit/(:num)", "DepartamentoController::singleDepartamento/$1");
    $routes->get("delete/(:num)", "DepartamentoController::delete/$1");
    $routes->post("add", "DepartamentoController::create");
    $routes->post("update", "DepartamentoController::update");
});

$routes->group('ciudad',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "CiudadController::index");
    $routes->get("show", "CiudadController::index");
    $routes->get("edit/(:num)", "CiudadController::singleCiudad/$1");
    $routes->get("delete/(:num)", "CiudadController::delete/$1");
    $routes->post("add", "CiudadController::create");
    $routes->post("update", "CiudadController::update");
});

$routes->group('estadousuario',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EstadoUsuarioController::index");
    $routes->get("show", "EstadoUsuarioController::index");
    $routes->get("edit/(:num)", "EstadoUsuarioController::singleEstadoUsuario/$1");
    $routes->get("delete/(:num)", "EstadoUsuarioController::delete/$1");
    $routes->post("add", "EstadoUsuarioController::create");
    $routes->post("update", "EstadoUsuarioController::update");
});

$routes->post("register/add", "UsuarioController::create");

$routes->group('usuario',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "UsuarioController::index");
    $routes->get("show", "UsuarioController::index");
    $routes->get("edit/(:num)", "UsuarioController::singleUsuario/$1");
    $routes->get("delete/(:num)", "UsuarioController::delete/$1");
    $routes->post("add", "UsuarioController::create");
    $routes->post("update", "UsuarioController::update");
});


$routes->group('rol',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "RolController::index");
    $routes->get("show", "RolController::index");
    $routes->get("edit/(:num)", "RolController::singleRol/$1");
    $routes->get("delete/(:num)", "RolController::delete/$1");
    $routes->post("add", "RolController::create");
    $routes->post("update", "RolController::update");
});

$routes->group('tipodocumento',['filter' => 'roleaccess'],function($routes){
    $routes->get("/", "TipoDocumentoController::index");
    $routes->get("show", "TipoDocumentoController::index");
    $routes->get("edit/(:num)", "TipoDocumentoController::singleTipoDocumento/$1");
    $routes->get("delete/(:num)", "TipoDocumentoController::delete/$1");
    $routes->post("add", "TipoDocumentoController::create");
    $routes->post("update", "TipoDocumentoController::update");
});

$routes->group('marca',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "MarcaController::index");
    $routes->get("show", "MarcaController::index");
    $routes->get("edit/(:num)", "MarcaController::singleMarca/$1");
    $routes->get("delete/(:num)", "MarcaController::delete/$1");
    $routes->post("add", "MarcaController::create");
    $routes->post("update", "MarcaController::update");
});

$routes->group('estadoproducto',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EstadoProductoController::index");
    $routes->get("show", "EstadoProductoController::index");
    $routes->get("edit/(:num)", "EstadoProductoController::singleEstadoProducto/$1");
    $routes->get("delete/(:num)", "EstadoProductoController::delete/$1");
    $routes->post("add", "EstadoProductoController::create");
    $routes->post("update", "EstadoProductoController::update");
});

$routes->group('color',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "ColorController::index");
    $routes->get("show", "ColorController::index");
    $routes->get("edit/(:num)", "ColorController::singleColor/$1");
    $routes->get("delete/(:num)", "ColorController::delete/$1");
    $routes->post("add", "ColorController::create");
    $routes->post("update", "ColorController::update");
});

$routes->group('categoria',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "CategoriaController::index");
    $routes->get("show", "CategoriaController::index");
    $routes->get("edit/(:num)", "CategoriaController::singleCategoria/$1");
    $routes->get("delete/(:num)", "CategoriaController::delete/$1");
    $routes->post("add", "CategoriaController::create");
    $routes->post("update", "CategoriaController::update");
});

$routes->group('garantia',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "GarantiaController::index");
    $routes->get("show", "GarantiaController::index");
    $routes->get("edit/(:num)", "GarantiaController::singleGarantia/$1");
    $routes->get("delete/(:num)", "GarantiaController::delete/$1");
    $routes->post("add", "GarantiaController::create");
    $routes->post("update", "GarantiaController::update");
});


$routes->group('almacenamiento',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "AlmacenamientoController::index");
    $routes->get("show", "AlmacenamientoController::index");
    $routes->get("edit/(:num)", "AlmacenamientoController::singleAlmacenamiento/$1");
    $routes->get("delete/(:num)", "AlmacenamientoController::delete/$1");
    $routes->post("add", "AlmacenamientoController::create");
    $routes->post("update", "AlmacenamientoController::update");
});

$routes->group('almacenamientoaleatorio',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "AlmacenamientoAleatorioController::index");
    $routes->get("show", "AlmacenamientoAleatorioController::index");
    $routes->get("edit/(:num)", "AlmacenamientoAleatorioController::singleAlmacenamiento/$1");
    $routes->get("delete/(:num)", "AlmacenamientoAleatorioController::delete/$1");
    $routes->post("add", "AlmacenamientoAleatorioController::create");
    $routes->post("update", "AlmacenamientoAleatorioController::update");
});


$routes->group('sistemaoperativo',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "SistemaOperativoController::index");
    $routes->get("show", "SistemaOperativoController::index");
    $routes->get("edit/(:num)", "SistemaOperativoController::singleSistemaOperativo/$1");
    $routes->get("delete/(:num)", "SistemaOperativoController::delete/$1");
    $routes->post("add", "SistemaOperativoController::create");
    $routes->post("update", "SistemaOperativoController::update");
});

$routes->group('resolucion',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "ResolucionController::index");
    $routes->get("show", "ResolucionController::index");
    $routes->get("edit/(:num)", "ResolucionController::singleResolucion/$1");
    $routes->get("delete/(:num)", "ResolucionController::delete/$1");
    $routes->post("add", "ResolucionController::create");
    $routes->post("update", "ResolucionController::update");
});
$routes->group('producto',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "ProductoController::index");
    $routes->get("show", "ProductoController::index");
    $routes->get("edit/(:num)", "ProductoController::singleProducto/$1");
    $routes->get("delete/(:num)", "ProductoController::delete/$1");
    $routes->post("add", "ProductoController::create");
    $routes->post("update", "ProductoController::update");


});

$routes->group('tipopqrs',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "TipoPqrsController::index");
    $routes->get("show", "TipoPqrsController::index");
    $routes->get("edit/(:num)", "TipoPqrsController::singleTipoPqrs/$1");
    $routes->get("delete/(:num)", "TipoPqrsController::delete/$1");
    $routes->post("add", "TipoPqrsController::create");
    $routes->post("update", "TipoPqrsController::update");


});
$routes->group('estadopqrs',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EstadoPqrsController::index");
    $routes->get("show", "EstadoPqrsController::index");
    $routes->get("edit/(:num)", "EstadoPqrsController::singleEstadoPqrs/$1");
    $routes->get("delete/(:num)", "EstadoPqrsController::delete/$1");
    $routes->post("add", "EstadoPqrsController::create");
    $routes->post("update", "EstadoPqrsController::update");


});
$routes->group('pqrs',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "PqrsController::index");
    $routes->get("show", "PqrsController::index");
    $routes->get("edit/(:num)", "PqrsController::singlePqrs/$1");
    $routes->get("delete/(:num)", "PqrsController::delete/$1");
    $routes->post("add", "PqrsController::create");
    $routes->post("update", "PqrsController::update");
    $routes->get("Cpqrs", "PqrsController::PqrsCliente");
    

});

$routes->group('estadoenvio',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EstadoEnvioController::index");
    $routes->get("show", "EstadoEnvioController::index");
    $routes->get("edit/(:num)", "EstadoEnvioController::singleEstadoEnvio/$1");
    $routes->get("delete/(:num)", "EstadoEnvioController::delete/$1");
    $routes->post("add", "EstadoEnvioController::create");
    $routes->post("update", "EstadoEnvioController::update");


});
$routes->group('estadofactura',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EstadoFacturaController::index");
    $routes->get("show", "EstadoFacturaController::index");
    $routes->get("edit/(:num)", "EstadoFacturaController::singleEstadoFactura/$1");
    $routes->get("delete/(:num)", "EstadoFacturaController::delete/$1");
    $routes->post("add", "EstadoFacturaController::create");
    $routes->post("update", "EstadoFacturaController::update");

});

$routes->group('modelo',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "ModelosController::index");
    $routes->get("show", "ModelosController::index");
    $routes->get("edit/(:num)", "ModelosController::singleModelo/$1");
    $routes->get("delete/(:num)", "ModelosController::delete/$1");
    $routes->post("add", "ModelosController::create");
    $routes->post("update", "ModelosController::update");

});
$routes->group('permisos',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "PermisosController::index");
    $routes->get("show", "PermisosController::index");
    $routes->get("edit/(:num)", "PermisosController::singlePermiso/$1");
    $routes->get("delete/(:num)", "PermisosController::delete/$1");
    $routes->post("add", "PermisosController::create");
    $routes->post("update", "PermisosController::update");

});
$routes->group('envio',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "EnvioController::index");
    $routes->get("show", "EnvioController::index");
    $routes->get("edit/(:num)", "EnvioController::singleEnvio/$1");
    $routes->get("delete/(:num)", "EnvioController::delete/$1");
    $routes->post("add", "EnvioController::create");
    $routes->post("update", "EnvioController::update");

});

$routes->group('factura',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "FacturaController::index");
    $routes->get("show", "FacturaController::index");
    $routes->get("edit/(:num)", "FacturaController::singleFactura/$1");
    $routes->get("delete/(:num)", "FacturaController::delete/$1");
    $routes->post("add", "FacturaController::create");
    $routes->post("update", "FacturaController::update");

});


$routes->group('ingresoproducto',['filter' => 'roleaccess'], function($routes){
    $routes->get("/", "IngresoProductoController::index");
    $routes->get("show", "IngresoProductoController::index");
    $routes->get("edit/(:num)", "IngresoProductoController::singleIngresoProducto/$1");
    $routes->get("delete/(:num)", "IngresoProductoController::delete/$1");
    $routes->post("add", "IngresoProductoController::create");
    $routes->post("update", "IngresoProductoController::update");
    $routes->post('subirFactura', 'IngresoProductoController::subirFactura');


});

$routes->post('usuario/login', 'UsuarioController::login');

$routes->get('usuario/login', function() {
    return view('usuario/login');
});

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('usuario', 'UsuarioController::index');
    $routes->get('home', 'HomeController::index');
});
$routes->get('register', 'UsuarioController::registerView');
$routes->post('producto/updateImage', 'ProductoController::updateImage');

$routes->get('producto/ver/(:num)', 'ProductoController::ver/$1');

$routes->get('categorias', 'ProductoController::listarProductos');
$routes->get('categoria/(:num)', 'ProductoController::listarProductos/$1');


$routes->group('oferta',['filter' => 'roleaccess'], function($routes) {
    $routes->get("/", "OfertasController::index");
    $routes->get("show", "OfertasController::index");
    $routes->get("edit/(:num)", "OfertasController::singleOferta/$1");
    $routes->get("delete/(:num)", "OfertasController::delete/$1");
    $routes->post("add", "OfertasController::create");
    $routes->post("update", "OfertasController::update");
    $routes->post('updateImage', 'OfertasController::updateImage');
});

$routes->get('/logout', 'UsuarioController::logout');

// Carrito
$routes->get('/carrito', 'CarritoController::carrito');
$routes->post('/carrito/agregar', 'CarritoController::agregarAlCarrito');
$routes->post('carrito/eliminarDelCarrito/(:num)', 'CarritoController::eliminarDelCarrito/$1');
// Metodos de pago
$routes->get('pago/contraentrega', 'CarritoController::contraentrega');
$routes->get('pago/tarjeta', 'CarritoController::tarjeta');


$routes->group('userapi', ['filter' => 'roleaccess'],function($routes) {
    $routes->get("/", "ApiUserController::index");
    $routes->get("show", "ApiUserController::index");
    $routes->get("edit/(:num)", "ApiUserController::singleUser/$1");
    $routes->get("delete/(:num)", "ApiUserController::delete/$1");
    $routes->post("add", "ApiUserController::create");
    $routes->post("update", "ApiUserController::update");
    $routes->post('updateImage', 'ApiUserController::updateImage');
});

$routes->group('modelorol', ['filter' => 'roleaccess'],function($routes) {
    $routes->get("/", "ModelosRolController::index");
    $routes->get("show", "ModelosRolController::index");
    $routes->get("edit/(:num)", "ModelosRolController::singleModelosRol/$1");
    $routes->get("delete/(:num)", "ModelosRolController::delete/$1");
    $routes->post("add", "ModelosRolController::create");
    $routes->post("update", "ModelosRolController::update");
});
$routes->group('modelorolpermisos',['filter' => 'roleaccess'],function($routes) {
    $routes->get("/", "PermisosModelosRolController::index");
    $routes->get("show", "PermisosModelosRolController::index");
    $routes->get("edit/(:num)", "PermisosModelosRolController::singleModelosRolPermisos/$1");
    $routes->get("delete/(:num)", "PermisosModelosRolController::delete/$1");
    $routes->post("add", "PermisosModelosRolController::create");
    $routes->post("update", "PermisosModelosRolController::update");
});
$routes->group('productosingresoproductos',function($routes) {
    $routes->get("/", "ProductosIngresoProductoController::index");
    $routes->get("show", "ProductosIngresoProductoController::index");
    $routes->get("edit/(:num)", "ProductosIngresoProductoController::singleProductosIngresoProducto/$1");
    $routes->get("delete/(:num)", "ProductosIngresoProductoController::delete/$1");
    $routes->post("add", "ProductosIngresoProductoController::create");
    $routes->post("update", "ProductosIngresoProductoController::update");
});
$routes->group('proveedor',function($routes) {
    $routes->get("/", "ProveedorController::index");
    $routes->get("show", "ProveedorController::index");
    $routes->get("edit/(:num)", "ProveedorController::singleProveedor/$1");
    $routes->get("delete/(:num)", "ProveedorController::delete/$1");
    $routes->post("add", "ProveedorController::create");
    $routes->post("update", "ProveedorController::update");
});
$routes->group('pedidoproveedor',function($routes) {
    $routes->get("/", "PedidoProveedorController::index");
    $routes->get("show", "PedidoProveedorController::index");
    $routes->get("edit/(:num)", "PedidoProveedorController::singlePedidoProveedor/$1");
    $routes->get("delete/(:num)", "PedidoProveedorController::delete/$1");
    $routes->post("add", "PedidoProveedorController::create");
    $routes->post("update", "PedidoProveedorController::update");
});



$routes->get('pedidoproveedor/listarFacturas', 'PedidoProveedorController::listarFacturas');


$routes->get("ofertas/(:num)", "ProductoController::listarOfertas/$1");

$routes->get('olvide-password', 'AuthController::showForgotForm');
$routes->post('send-reset-link', 'AuthController::sendResetLink');
$routes->get('reset-password/(:any)', 'AuthController::showResetForm/$1');
$routes->post('update-password', 'AuthController::updatePassword');

$routes->get('test-email', 'TestEmailController::index');
$routes->get('terminos', 'LoginTerminos::terminos');
$routes->get('condiciones', 'LoginTerminos::condiciones');

$routes->group('admin', ['filter' => 'roleaccess'], function($routes){
    $routes->get('dasboard','DashboardController::index');
});

$routes->get('no-autorizado', 'DashboardController::error');

$routes->get('no-autorizado', 'DashboardController::error');

$routes->get('carrito', 'ProductoController::carrito');

$routes->get('pedidoproveedor/generarNumeroFactura', 'PedidoProveedorController::generarNumeroFactura');


$routes->get('pedido/factura/(:num)', 'PedidoProveedorController::generarFacturaPDF/$1');
$routes->get('pedidoproveedor/enviarFacturaCorreo/(:num)', 'PedidoProveedorController::enviarFacturaCorreo/$1');

$routes->get('facturas', 'Facturas::index');
$routes->get('facturas/verQR/(:any)', 'Facturas::verQR/$1'); 
$routes->get('facturas/pdf/(:segment)', 'Facturas::pdf/$1');
$routes->post('facturas/registrar', 'Facturas::registrarFactura');
$routes->get('facturas/pagar/(:segment)', 'Facturas::pagar/$1');
$routes->get('facturas/respuesta', 'Facturas::respuesta');
$routes->post('facturas/confirmacion', 'Facturas::confirmacion'); 
$routes->post('facturas/guardar-temporal', 'Facturas::guardarFacturaTemporal');
$routes->get('facturas/notas-credito', 'Facturas::notasCredito');
$routes->post('notas-credito/registrar', 'Facturas::registrar');
$routes->get('api/token', 'ApiController::token');