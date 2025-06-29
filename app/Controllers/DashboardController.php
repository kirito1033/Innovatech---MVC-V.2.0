<?php

namespace App\Controllers;
use App\Models\ModelosModel;
use App\Models\UsuarioModel;
use App\Models\RolModel;
use App\Models\ApiUserModel;
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
use App\Models\PqrsModel;
use App\Models\TipoPqrsModel;
use App\Models\EstadoPqrsModel;
use App\Models\OfertasModel;

//Controlador del Dashboard principal del sistema.
// Recolecta datos de usuarios, productos, ofertas, envíos, facturas y PQRS para generar gráficos y KPIs.
class DashboardController extends BaseController
{
    /**
     * Muestra la vista principal del dashboard con estadísticas generales.
     * Genera KPIs y gráficos para:
     * - Usuarios (por rol, estado, API)
     * - Productos (por categoría, marca, estado, SO, almacenamiento, color)
     * - Ofertas (por estado, mes, rango de descuento)
     * - PQRS (por tipo, estado, mes, usuario)
     * - Facturas (por estado, tipo, forma de pago)
     * - Envíos (por estado, mes, ciudad)
     */
    public function index()
    {
        // 1. Obtener los módulos permitidos según el rol del usuario actual

        $rolId = session()->get('rol_id');
        $modelosModel = new ModelosModel();
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

         // 2. KPIs de usuarios por rol
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();
        $apiUserModel = new ApiUserModel();
        $productoModel = new \App\Models\ProductosModel();
        $categoriaModel = new \App\Models\CategoriaModel();
        $marcaModel = new \App\Models\MarcaModel();
        $estadoProductoModel = new \App\Models\EstadoProductoModel();
        $soModel = new \App\Models\SistemaOperativoModel();
        $almacenamientoModel = new \App\Models\AlmacenamientoModel();
        $colorModel = new \App\Models\ColorModel();

        // === Usuarios por Rol ===
        $usuariosPorRol = $usuarioModel
            ->select('rol_id, COUNT(*) as total')
            ->groupBy('rol_id')
            ->findAll();

        $roles = $rolModel->findAll();
        $labels = [];
        $totales = [];

        foreach ($usuariosPorRol as $item) {
            foreach ($roles as $rol) {
                if ($rol['id'] == $item['rol_id']) {
                    $labels[] = $rol['nom'];
                    $totales[] = $item['total'];
                    break;
                }
            }
        }

        // 3. Usuarios activos / inactivos
        $activos = $usuarioModel->where('estado_usuario_id', 1)->countAllResults();
        $inactivos = $usuarioModel->where('estado_usuario_id', 4)->countAllResults();

        // 4. Usuarios API activos / inactivos
        $apiActivos = $apiUserModel->where('api_status', "Active")->countAllResults();
        $apiInactivos = $apiUserModel->where('api_status', "Inactive")->countAllResults();
        $totalUsuariosApi = $apiUserModel->countAllResults();

        // 5. Usuarios API por mes
        $apiPorMes = $apiUserModel
            ->select("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("mes", "ASC")
            ->findAll();

        $labelsMes = [];
        $datosMes = [];
        foreach ($apiPorMes as $row) {
            $labelsMes[] = $row['mes'];
            $datosMes[] = $row['total'];
        }

        // 6. Productos por categoría
        $productosCategoria = $productoModel
            ->select('id_categoria, COUNT(*) as total')
            ->groupBy('id_categoria')
            ->findAll();
        $categorias = $categoriaModel->findAll();
        $labelsCategoria = [];
        $datosCategoria = [];
        foreach ($productosCategoria as $item) {
            foreach ($categorias as $cat) {
                if ($cat['id'] == $item['id_categoria']) {
                    $labelsCategoria[] = $cat['nom'];
                    $datosCategoria[] = $item['total'];
                    break;
                }
            }
        }

        // 7. Productos por marca
        $productosMarca = $productoModel
            ->select('id_marca, COUNT(*) as total')
            ->groupBy('id_marca')
            ->findAll();
        $marcas = $marcaModel->findAll();
        $labelsMarca = [];
        $datosMarca = [];
        foreach ($productosMarca as $item) {
            foreach ($marcas as $marca) {
                if ($marca['id'] == $item['id_marca']) {
                    $labelsMarca[] = $marca['nom'];
                    $datosMarca[] = $item['total'];
                    break;
                }
            }
        }

        // 8. Productos por estado
        $productosEstado = $productoModel
            ->select('id_estado, COUNT(*) as total')
            ->groupBy('id_estado')
            ->findAll();
        $estados = $estadoProductoModel->findAll();
        $labelsEstadoProducto = [];
        $datosEstadoProducto = [];
        foreach ($productosEstado as $item) {
            foreach ($estados as $estado) {
                if ($estado['id'] == $item['id_estado']) {
                    $labelsEstadoProducto[] = $estado['nom'];
                    $datosEstadoProducto[] = $item['total'];
                    break;
                }
            }
        }
        
        // 9. Productos por sistema operativo
        $productosSO = $productoModel
            ->select('id_sistema_operativo, COUNT(*) as total')
            ->groupBy('id_sistema_operativo')
            ->findAll();
        $sos = $soModel->findAll();
        $labelsSO = [];
        $datosSO = [];
        foreach ($productosSO as $item) {
            foreach ($sos as $so) {
                if ($so['id'] == $item['id_sistema_operativo']) {
                    $labelsSO[] = $so['nom'];
                    $datosSO[] = $item['total'];
                    break;
                }
            }
        }

        // 10. Productos por almacenamiento
        $productosAlm = $productoModel
            ->select('id_almacenamiento, COUNT(*) as total')
            ->groupBy('id_almacenamiento')
            ->findAll();
        $almacenamientos = $almacenamientoModel->findAll();
        $labelsAlm = [];
        $datosAlm = [];
        foreach ($productosAlm as $item) {
            foreach ($almacenamientos as $alm) {
                if ($alm['id'] == $item['id_almacenamiento']) {
                    $labelsAlm[] = $alm['num'] . ' ' . $alm['unidadestandar'];
                    $datosAlm[] = $item['total'];
                    break;
                }
            }
        }

        // 11. Productos por color
        $productosColor = $productoModel
            ->select('id_color, COUNT(*) as total')
            ->groupBy('id_color')
            ->findAll();
        $colores = $colorModel->findAll();
        $labelsColor = [];
        $datosColor = [];
        foreach ($productosColor as $item) {
            foreach ($colores as $col) {
                if ($col['id_color'] == $item['id_color']) {
                    $labelsColor[] = $col['nom'];
                    $datosColor[] = $item['total'];
                    break;
                }
            }
        }

        // 12. KPIs de productos
        $totalProductos = $productoModel->countAllResults();
        $totalDisponibles = $productoModel->where('id_estado', 1)->countAllResults(); // Ajustar el ID si necesario
        $categoriasUnicas = count($categorias);
        $marcasUnicas = count($marcas);

        // 13. KPIs de facturas (incluyendo por estado, tipo y forma de pago)
      
       $facturaModel = new \App\Models\FacturaModel();
        $facturas = $facturaModel->getFacturas();
        // Se calcula el total, y se agrupan por tipo, estado y forma de pago.
        
        $totalFacturas = 0;
        $totalesPorEstado = [];
        $totalesPorTipo = [];
        $totalesPorPago = [];

        if (!isset($facturas['error']) && isset($facturas['data']['data'])) {
            foreach ($facturas['data']['data'] as $factura) {
                $totalFacturas++;

                // Agrupar por estado
                $estado = $factura['status'] ?? 'Desconocido';
                $claveEstado = ($estado === 1 || $estado === '1') ? 'Válida' : (($estado === 0 || $estado === '0') ? 'Pendiente' : 'Otro');
                $totalesPorEstado[$claveEstado] = ($totalesPorEstado[$claveEstado] ?? 0) + 1;

                // Agrupar por tipo de documento
                $tipo = $factura['document']['name'] ?? 'Desconocido';
                $totalesPorTipo[$tipo] = ($totalesPorTipo[$tipo] ?? 0) + 1;

                // Agrupar por forma de pago
                $pago = $factura['payment_form']['name'] ?? 'Desconocido';
                $totalesPorPago[$pago] = ($totalesPorPago[$pago] ?? 0) + 1;
            }
        }

        // 14. KPIs y gráficas para PQRS (tipo, estado, mes, usuario)
        $pqrsModel = new PqrsModel();
        $tipoPqrsModel = new TipoPqrsModel();
        $estadoPqrsModel = new EstadoPqrsModel();
        $usuarioModel = new UsuarioModel();
        
        // Totales por tipo
        $totalPqrsPorTipo = $pqrsModel->select('tipo_pqrs_id, COUNT(*) as total')
            ->groupBy('tipo_pqrs_id')
            ->findAll();

        $labelsTipo = [];
        $datosTipo = [];
        foreach ($totalPqrsPorTipo as $item) {
            $tipo = $tipoPqrsModel->find($item['tipo_pqrs_id']);
            $labelsTipo[] = $tipo['nom'] ?? 'Desconocido';
            $datosTipo[] = $item['total'];
        }
       // Esto suma todos los estados PQRS
        // Totales por estado
        $totalPqrsPorEstado = $pqrsModel->select('estado_pqrs_id, COUNT(*) as total')
            ->groupBy('estado_pqrs_id')
            ->findAll();

        $labelsEstado = [];
        $datosEstado = [];
        foreach ($totalPqrsPorEstado as $item) {
            $estado = $estadoPqrsModel->find($item['estado_pqrs_id']);
            $labelsEstado[] = $estado['nom'] ?? 'Desconocido';
            $datosEstado[] = $item['total'];
        }
        $totalPqrs = array_sum($datosEstado); 
        // Totales por mes
        $totalPqrsPorMes = $pqrsModel->select("MONTH(created_at) as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("mes", "ASC")
            ->findAll();

        $meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        $labelsMesPqrs = [];
        $datosMesPqrs = [];
        foreach ($totalPqrsPorMes as $item) {
            $labelsMesPqrs[] = $meses[$item['mes'] - 1];
            $datosMesPqrs[] = $item['total'];
        }

        // Top 5 usuarios con más PQRS
        $topUsuarios = $pqrsModel->select('usuario_id, COUNT(*) as total')
            ->groupBy('usuario_id')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->findAll();

        $labelsUsuarioPqrs = [];
        $datosUsuarioPqrs = [];
        foreach ($topUsuarios as $item) {
            $usuario = $usuarioModel->find($item['usuario_id']);
            $labelsUsuarioPqrs[] = $usuario['primer_nombre'] ?? 'Desconocido';
            $datosUsuarioPqrs[] = $item['total'];
        }
        // 15. Ofertas: KPIs y estadísticas por estado, mes y descuento
        $OfertaModel = new OfertasModel();

        // Total de ofertas
        $totalOfertas = $OfertaModel->countAllResults();

        // Ofertas activas e inactivas
        $ofertasActivas = $OfertaModel->where('estado', "Activa")->countAllResults();
        $ofertasInactivas = $OfertaModel->where('estado', "Inactiva")->countAllResults();

        // === Gráfico: Ofertas por Estado ===
        $estadoOfertas = $OfertaModel
            ->select('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->findAll();

        $labelsEstadoOferta = [];
        $datosEstadoOferta = [];

        foreach ($estadoOfertas as $item) {
            $estado = $item['estado'] == 1 ? 'Activa' : 'Inactiva';
            $labelsEstadoOferta[] = $estado;
            $datosEstadoOferta[] = $item['total'];
        }

        $graficoEstadoOferta = [
            'labels' => $labelsEstadoOferta,
            'datos' => $datosEstadoOferta
        ];

        // === Gráfico: Ofertas por Mes ===
        $ofertasPorMes = $OfertaModel
            ->select("DATE_FORMAT(created_at, '%M') as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("MIN(created_at)", "ASC")
            ->findAll();

        $labelsMesOferta = [];
        $datosMesOferta = [];

        foreach ($ofertasPorMes as $item) {
            $labelsMesOferta[] = $item['mes']; // Ej: "Enero", "Febrero", etc.
            $datosMesOferta[] = $item['total'];
        }

        $graficoMesOferta = [
            'labels' => $labelsMesOferta,
            'datos' => $datosMesOferta
        ];

        // === Gráfico: Ofertas por Rango de Descuento ===
        $rangos = [
            '0-10%' => [0, 10],
            '11-20%' => [11, 20],
            '21-30%' => [21, 30],
            '31-50%' => [31, 50],
            '51-100%' => [51, 100]
        ];

        $ofertas = $OfertaModel->select('descuento')->findAll();

        $conteoPorRango = array_fill_keys(array_keys($rangos), 0);

        foreach ($ofertas as $oferta) {
            $descuento = $oferta['descuento'];
            foreach ($rangos as $label => [$min, $max]) {
                if ($descuento >= $min && $descuento <= $max) {
                    $conteoPorRango[$label]++;
                    break;
                }
            }
        }

        $graficoRangoDescuento = [
            'labels' => array_keys($conteoPorRango),
            'datos' => array_values($conteoPorRango)
        ];
        $totalOfertas      = $OfertaModel->countAllResults();
        $ofertasActivas    = $OfertaModel->where('estado', 'Activa')->countAllResults();
        $ofertasInactivas  = $OfertaModel->where('estado', 'Inactiva')->countAllResults();
        $promedioDescuento = (float) ($OfertaModel->selectAvg('descuento')->first()['descuento'] ?? 0);
        // 16. Envíos: KPIs, estados, meses y ciudades
        $envioModel = new \App\Models\EnvioModel();
        $estadoEnvioModel = new \App\Models\EstadoEnvioModel();
        $usuarioModel = new \App\Models\UsuarioModel();

        // Total general
        $totalEnvios = $envioModel->countAllResults();

        // KPIs por estado
        $enviosEntregados   = $envioModel->where('estado_envio_id', 4)->countAllResults(); // Ajusta el ID si es diferente
        $enviosEnProceso    = $envioModel->where('estado_envio_id', 2)->countAllResults();
        $enviosCancelados   = $envioModel->where('estado_envio_id', 5)->countAllResults();
        $enviosPorConfirmar = $envioModel->where('estado_envio_id', 1)->countAllResults();

        // Gráfico por estado
        $enviosPorEstado = $envioModel
            ->select('estado_envio_id, COUNT(*) as total')
            ->groupBy('estado_envio_id')
            ->findAll();

        $labelsEstadoEnvio = [];
        $datosEstadoEnvio = [];

        foreach ($enviosPorEstado as $item) {
            $estado = $estadoEnvioModel->find($item['estado_envio_id']);
            $labelsEstadoEnvio[] = $estado['nom'] ?? 'Desconocido';
            $datosEstadoEnvio[] = $item['total'];
        }

        $graficoEstadoEnvio = [
            'labels' => $labelsEstadoEnvio,
            'datos' => $datosEstadoEnvio
        ];

        // Gráfico por mes
        $enviosPorMes = $envioModel
            ->select("MONTH(fecha) as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("mes", "ASC")
            ->findAll();

        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $labelsMesEnvio = [];
        $datosMesEnvio = [];

        foreach ($enviosPorMes as $item) {
            $labelsMesEnvio[] = $meses[$item['mes'] - 1];
            $datosMesEnvio[] = $item['total'];
        }

        $graficoMesEnvio = [
            'labels' => $labelsMesEnvio,
            'datos' => $datosMesEnvio
        ];

        // Gráfico por ciudad
        $enviosPorCiudad = $envioModel
            ->select('direccion, COUNT(*) as total')
            ->groupBy('direccion') // Asumiendo que la ciudad está en la dirección
            ->limit(5)
            ->findAll();

        $labelsCiudad = [];
        $datosCiudad = [];

        foreach ($enviosPorCiudad as $item) {
            $labelsCiudad[] = $item['direccion'];
            $datosCiudad[] = $item['total'];
        }

        // Últimos 10 envíos
        $ultimosEnvios = $envioModel->orderBy('fecha', 'DESC')->limit(10)->findAll();
          $data = [

                'totalEnvios' => $totalEnvios,
                'enviosEntregados'   => $enviosEntregados,
                'enviosEnProceso'    => $enviosEnProceso,
                'enviosCancelados'   => $enviosCancelados,
                'enviosPorConfirmar' => $enviosPorConfirmar,

                'graficoEstadoEnvio' => $graficoEstadoEnvio,
                'graficoMesEnvio'    => $graficoMesEnvio,

                'ultimosEnvios'      => $ultimosEnvios,

                // ─── KPI Ofertas ─────────────────────────────────────────────
                'totalOfertas'     => $totalOfertas,
                'ofertasActivas'   => $ofertasActivas,
                'ofertasInactivas' => $ofertasInactivas,
                'promedioDescuento'=> $promedioDescuento,

                // ─── Gráficas Ofertas (ya estaban) ───────────────────────────
                'graficoEstadoOferta'   => $graficoEstadoOferta,
                'graficoMesOferta'      => $graficoMesOferta,
                'graficoRangoDescuento' => $graficoRangoDescuento,
                'graficoRangoDescuento' => $graficoRangoDescuento,
                'modulos' => $modulosPermitidos,
                'totalPqrs' => $totalPqrs,
                
                
                // KPIs Usuarios
                'totalUsuarios' => count($usuarioModel->findAll()),
                'totalAdmin' => $usuarioModel->where('rol_id', 1)->countAllResults(),
                'totalClientes' => $usuarioModel->where('rol_id', 3)->countAllResults(),
                'totalSoporte' => $usuarioModel->where('rol_id', 2)->countAllResults(),

                // KPIs API
                'totalUsuariosApi' => $totalUsuariosApi,

                // KPIs Productos
                'totalProductos' => $totalProductos,
                'totalDisponibles' => $totalDisponibles,
                'categoriasUnicas' => $categoriasUnicas,
                'marcasUnicas' => $marcasUnicas,

                // KPIs Facturas
                'totalFacturas' => $totalFacturas,
                'totalesPorEstadoFactura' => $totalesPorEstado,
                'totalesPorTipoFactura' => $totalesPorTipo,
                'totalesPorPagoFactura' => $totalesPorPago,

                // Gráficas Usuarios
                'graficoUsuarios' => [
                    'labels' => $labels,
                    'totales' => $totales
                ],
                'graficoEstado' => [
                    'labels' => ['Activo', 'Inactivo'],
                    'datos' => [$activos, $inactivos]
                ],
                'graficoEstadoAPI' => [
                    'labels' => ['Activo', 'Inactivo'],
                    'datos' => [$apiActivos, $apiInactivos]
                ],
                'graficoMes' => [
                    'labels' => $labelsMes,
                    'datos' => $datosMes
                ],

                // Gráficas Productos
                'graficoCategoria' => [
                    'labels' => $labelsCategoria,
                    'datos' => $datosCategoria
                ],
                'graficoMarca' => [
                    'labels' => $labelsMarca,
                    'datos' => $datosMarca
                ],
                'graficoEstadoProducto' => [
                    'labels' => $labelsEstadoProducto,
                    'datos' => $datosEstadoProducto
                ],
                'graficoSO' => [
                    'labels' => $labelsSO,
                    'datos' => $datosSO
                ],
                'graficoAlmacenamiento' => [
                    'labels' => $labelsAlm,
                    'datos' => $datosAlm
                ],
                'graficoColor' => [
                    'labels' => $labelsColor,
                    'datos' => $datosColor
                ],
                'graficoTipoPqrs' => [
                    'labels' => $labelsTipo,
                    'datos' => $datosTipo
                ],
                'graficoEstadoPqrs' => [
                    'labels' => $labelsEstado,
                    'datos' => $datosEstado
                    
                ],
                
                'graficoMesPqrs' => [
                    'labels' => $labelsMesPqrs,
                    'datos' => $datosMesPqrs
                ],
                'graficoUsuarioPqrs' => [
                    
                    'labels' => $labelsUsuarioPqrs,
                    'datos' => $datosUsuarioPqrs
                ],
                'graficoCiudadEnvio' => [
                    'labels' => $labelsCiudad,
                    'datos' => $datosCiudad
                ],
                
            ];

        
        return view('dasboard/dasboard', $data);
    }

    //Muestra la vista de error de acceso no autorizado.
    public function error()
    {
        
        return view('errors/no_autorizado');
    }
}