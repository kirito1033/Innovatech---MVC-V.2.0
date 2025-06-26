<?php

//Controlador base del que deben extender todos los demás controladores.
//Proporciona un punto común para inicializar servicios, helpers y configuraciones compartidas.

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
* Clase BaseController
*
* BaseController proporciona un lugar práctico para cargar componentes
* realizar funciones necesarias para todos sus controladores.
* Extienda esta clase en cualquier controlador nuevo:
* class Home extends BaseController
*
* Por seguridad, asegúrese de declarar cualquier método nuevo como protegido o privado.
*/
abstract class BaseController extends Controller
{
    /**
     * Instancia principal del objeto Request.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Lista de helpers que se cargarán automáticamente al instanciar el controlador.
     *Estos estarán disponibles para todos los controladores que extiendan BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    //Inicializa el controlador base y los servicios esenciales del framework.
   //Este método es llamado automáticamente por CodeIgniter antes de ejecutar cualquier acción del controlador.

    /**
     * @param RequestInterface  $request   Objeto de solicitud (HTTP o CLI).
    * @param ResponseInterface $response  Objeto de respuesta HTTP.
    * @param LoggerInterface   $logger    Servicio de registro de logs.
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }
}
