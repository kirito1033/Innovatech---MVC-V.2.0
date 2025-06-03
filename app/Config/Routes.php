<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('departamento', function($routes){
    $routes->get("/", "DepartamentoController::index");
    $routes->get("show", "DepartamentoController::index");
    $routes->get("edit/(:num)", "DepartamentoController::singleDepartamento/$1");
    $routes->get("delete/(:num)", "DepartamentoController::delete/$1");
    $routes->post("add", "DepartamentoController::create");
    $routes->post("update", "DepartamentoController::update");
});

$routes->group('ciudad', function($routes){
    $routes->get("/", "CiudadController::index");
    $routes->get("show", "CiudadController::index");
    $routes->get("edit/(:num)", "CiudadController::singleCiudad/$1");
    $routes->get("delete/(:num)", "CiudadController::delete/$1");
    $routes->post("add", "CiudadController::create");
    $routes->post("update", "CiudadController::update");
});

$routes->group('estadousuario', function($routes){
    $routes->get("/", "EstadoUsuarioController::index");
    $routes->get("show", "EstadoUsuarioController::index");
    $routes->get("edit/(:num)", "EstadoUsuarioController::singleEstadoUsuario/$1");
    $routes->get("delete/(:num)", "EstadoUsuarioController::delete/$1");
    $routes->post("add", "EstadoUsuarioController::create");
    $routes->post("update", "EstadoUsuarioController::update");
});

$routes->group('usuario',['filter' => 'sessionauth'], function($routes){
    $routes->get("/", "UsuarioController::index");
    $routes->get("show", "UsuarioController::index");
    $routes->get("edit/(:num)", "UsuarioController::singleUsuario/$1");
    $routes->get("delete/(:num)", "UsuarioController::delete/$1");
    $routes->post("add", "UsuarioController::create");
    $routes->post("update", "UsuarioController::update");
});


$routes->group('rol', function($routes){
    $routes->get("/", "RolController::index");
    $routes->get("show", "RolController::index");
    $routes->get("edit/(:num)", "RolController::singleRol/$1");
    $routes->get("delete/(:num)", "RolController::delete/$1");
    $routes->post("add", "RolController::create");
    $routes->post("update", "RolController::update");
});

$routes->group('tipodocumento', function($routes){
    $routes->get("/", "TipoDocumentoController::index");
    $routes->get("show", "TipoDocumentoController::index");
    $routes->get("edit/(:num)", "TipoDocumentoController::singleTipoDocumento/$1");
    $routes->get("delete/(:num)", "TipoDocumentoController::delete/$1");
    $routes->post("add", "TipoDocumentoController::create");
    $routes->post("update", "TipoDocumentoController::update");
});

$routes->group('marca', function($routes){
    $routes->get("/", "MarcaController::index");
    $routes->get("show", "MarcaController::index");
    $routes->get("edit/(:num)", "MarcaController::singleMarca/$1");
    $routes->get("delete/(:num)", "MarcaController::delete/$1");
    $routes->post("add", "MarcaController::create");
    $routes->post("update", "MarcaController::update");
});

$routes->group('estadoproducto', function($routes){
    $routes->get("/", "EstadoProductoController::index");
    $routes->get("show", "EstadoProductoController::index");
    $routes->get("edit/(:num)", "EstadoProductoController::singleEstadoProducto/$1");
    $routes->get("delete/(:num)", "EstadoProductoController::delete/$1");
    $routes->post("add", "EstadoProductoController::create");
    $routes->post("update", "EstadoProductoController::update");
});

$routes->group('color', function($routes){
    $routes->get("/", "ColorController::index");
    $routes->get("show", "ColorController::index");
    $routes->get("edit/(:num)", "ColorController::singleColor/$1");
    $routes->get("delete/(:num)", "ColorController::delete/$1");
    $routes->post("add", "ColorController::create");
    $routes->post("update", "ColorController::update");
});

$routes->group('categoria', function($routes){
    $routes->get("/", "CategoriaController::index");
    $routes->get("show", "CategoriaController::index");
    $routes->get("edit/(:num)", "CategoriaController::singleCategoria/$1");
    $routes->get("delete/(:num)", "CategoriaController::delete/$1");
    $routes->post("add", "CategoriaController::create");
    $routes->post("update", "CategoriaController::update");
});

$routes->group('garantia', function($routes){
    $routes->get("/", "GarantiaController::index");
    $routes->get("show", "GarantiaController::index");
    $routes->get("edit/(:num)", "GarantiaController::singleGarantia/$1");
    $routes->get("delete/(:num)", "GarantiaController::delete/$1");
    $routes->post("add", "GarantiaController::create");
    $routes->post("update", "GarantiaController::update");
});


$routes->group('almacenamiento', function($routes){
    $routes->get("/", "AlmacenamientoController::index");
    $routes->get("show", "AlmacenamientoController::index");
    $routes->get("edit/(:num)", "AlmacenamientoController::singleAlmacenamiento/$1");
    $routes->get("delete/(:num)", "AlmacenamientoController::delete/$1");
    $routes->post("add", "AlmacenamientoController::create");
    $routes->post("update", "AlmacenamientoController::update");
});

$routes->group('almacenamientoaleatorio', function($routes){
    $routes->get("/", "AlmacenamientoAleatorioController::index");
    $routes->get("show", "AlmacenamientoAleatorioController::index");
    $routes->get("edit/(:num)", "AlmacenamientoAleatorioController::singleAlmacenamiento/$1");
    $routes->get("delete/(:num)", "AlmacenamientoAleatorioController::delete/$1");
    $routes->post("add", "AlmacenamientoAleatorioController::create");
    $routes->post("update", "AlmacenamientoAleatorioController::update");
});


$routes->group('sistemaoperativo', function($routes){
    $routes->get("/", "SistemaOperativoController::index");
    $routes->get("show", "SistemaOperativoController::index");
    $routes->get("edit/(:num)", "SistemaOperativoController::singleSistemaOperativo/$1");
    $routes->get("delete/(:num)", "SistemaOperativoController::delete/$1");
    $routes->post("add", "SistemaOperativoController::create");
    $routes->post("update", "SistemaOperativoController::update");
});

$routes->group('resolucion', function($routes){
    $routes->get("/", "ResolucionController::index");
    $routes->get("show", "ResolucionController::index");
    $routes->get("edit/(:num)", "ResolucionController::singleResolucion/$1");
    $routes->get("delete/(:num)", "ResolucionController::delete/$1");
    $routes->post("add", "ResolucionController::create");
    $routes->post("update", "ResolucionController::update");
});
$routes->group('producto', function($routes){
    $routes->get("/", "ProductoController::index");
    $routes->get("show", "ProductoController::index");
    $routes->get("edit/(:num)", "ProductoController::singleProducto/$1");
    $routes->get("delete/(:num)", "ProductoController::delete/$1");
    $routes->post("add", "ProductoController::create");
    $routes->post("update", "ProductoController::update");


});

$routes->group('tipopqrs', function($routes){
    $routes->get("/", "TipoPqrsController::index");
    $routes->get("show", "TipoPqrsController::index");
    $routes->get("edit/(:num)", "TipoPqrsController::singleTipoPqrs/$1");
    $routes->get("delete/(:num)", "TipoPqrsController::delete/$1");
    $routes->post("add", "TipoPqrsController::create");
    $routes->post("update", "TipoPqrsController::update");


});
$routes->group('estadopqrs', function($routes){
    $routes->get("/", "EstadoPqrsController::index");
    $routes->get("show", "EstadoPqrsController::index");
    $routes->get("edit/(:num)", "EstadoPqrsController::singleEstadoPqrs/$1");
    $routes->get("delete/(:num)", "EstadoPqrsController::delete/$1");
    $routes->post("add", "EstadoPqrsController::create");
    $routes->post("update", "EstadoPqrsController::update");


});
$routes->group('pqrs', function($routes){
    $routes->get("/", "PqrsController::index");
    $routes->get("show", "PqrsController::index");
    $routes->get("edit/(:num)", "PqrsController::singlePqrs/$1");
    $routes->get("delete/(:num)", "PqrsController::delete/$1");
    $routes->post("add", "PqrsController::create");
    $routes->post("update", "PqrsController::update");
    $routes->get("Cpqrs", "PqrsController::PqrsCliente");
    

});

$routes->group('estadoenvio', function($routes){
    $routes->get("/", "EstadoEnvioController::index");
    $routes->get("show", "EstadoEnvioController::index");
    $routes->get("edit/(:num)", "EstadoEnvioController::singleEstadoEnvio/$1");
    $routes->get("delete/(:num)", "EstadoEnvioController::delete/$1");
    $routes->post("add", "EstadoEnvioController::create");
    $routes->post("update", "EstadoEnvioController::update");


});
$routes->group('estadofactura', function($routes){
    $routes->get("/", "EstadoFacturaController::index");
    $routes->get("show", "EstadoFacturaController::index");
    $routes->get("edit/(:num)", "EstadoFacturaController::singleEstadoFactura/$1");
    $routes->get("delete/(:num)", "EstadoFacturaController::delete/$1");
    $routes->post("add", "EstadoFacturaController::create");
    $routes->post("update", "EstadoFacturaController::update");

});

$routes->group('modelo', function($routes){
    $routes->get("/", "ModelosController::index");
    $routes->get("show", "ModelosController::index");
    $routes->get("edit/(:num)", "ModelosController::singleModelo/$1");
    $routes->get("delete/(:num)", "ModelosController::delete/$1");
    $routes->post("add", "ModelosController::create");
    $routes->post("update", "ModelosController::update");

});
$routes->group('permisos', function($routes){
    $routes->get("/", "PermisosController::index");
    $routes->get("show", "PermisosController::index");
    $routes->get("edit/(:num)", "PermisosController::singlePermiso/$1");
    $routes->get("delete/(:num)", "PermisosController::delete/$1");
    $routes->post("add", "PermisosController::create");
    $routes->post("update", "PermisosController::update");

});
$routes->group('envio', function($routes){
    $routes->get("/", "EnvioController::index");
    $routes->get("show", "EnvioController::index");
    $routes->get("edit/(:num)", "EnvioController::singleEnvio/$1");
    $routes->get("delete/(:num)", "EnvioController::delete/$1");
    $routes->post("add", "EnvioController::create");
    $routes->post("update", "EnvioController::update");

});

$routes->group('factura', function($routes){
    $routes->get("/", "FacturaController::index");
    $routes->get("show", "FacturaController::index");
    $routes->get("edit/(:num)", "FacturaController::singleFactura/$1");
    $routes->get("delete/(:num)", "FacturaController::delete/$1");
    $routes->post("add", "FacturaController::create");
    $routes->post("update", "FacturaController::update");

});


$routes->group('ingresoproducto', function($routes){
    $routes->get("/", "IngresoProductoController::index");
    $routes->get("show", "IngresoProductoController::index");
    $routes->get("edit/(:num)", "IngresoProductoController::singleIngresoProducto/$1");
    $routes->get("delete/(:num)", "IngresoProductoController::delete/$1");
    $routes->post("add", "IngresoProductoController::create");
    $routes->post("update", "IngresoProductoController::update");

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

$routes->get('categoria/(:num)', 'ProductoController::listarProductos/$1');


$routes->group('oferta', function($routes) {
    $routes->get("/", "OfertasController::index");
    $routes->get("show", "OfertasController::index");
    $routes->get("edit/(:num)", "OfertasController::singleOferta/$1");
    $routes->get("delete/(:num)", "OfertasController::delete/$1");
    $routes->post("add", "OfertasController::create");
    $routes->post("update", "OfertasController::update");
    $routes->post('updateImage', 'OfertasController::updateImage');
});

$routes->get('/logout', 'UsuarioController::logout');

$routes->group('userapi', function($routes) {
    $routes->get("/", "ApiUserController::index");
    $routes->get("show", "ApiUserController::index");
    $routes->get("edit/(:num)", "ApiUserController::singleUser/$1");
    $routes->get("delete/(:num)", "ApiUserController::delete/$1");
    $routes->post("add", "ApiUserController::create");
    $routes->post("update", "ApiUserController::update");
    $routes->post('updateImage', 'ApiUserController::updateImage');
});
