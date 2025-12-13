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
use App\Models\FacturaCompraModel;
use App\Models\FacturaModel;
use App\Models\EnvioModel;
use App\Models\EstadoEnvioModel;

/**
 * Controlador del Dashboard principal del sistema.
 * Recolecta datos de usuarios, productos, ofertas, envíos, facturas y PQRS para generar gráficos y KPIs.
 */
class Dashboard extends BaseController
{
    /**
     * Muestra la vista principal del dashboard con estadísticas generales.
     */
    public function index()
    {
        // ========== MODELOS ==========
        $rolId = session()->get('rol_id');
        $modelosModel = new ModelosModel();
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();
        $apiUserModel = new ApiUserModel();
        $productoModel = new ProductosModel();
        $categoriaModel = new CategoriaModel();
        $marcaModel = new MarcaModel();
        $estadoProductoModel = new EstadoProductoModel();
        $soModel = new SistemaOperativoModel();
        $almacenamientoModel = new AlmacenamientoModel();
        $colorModel = new ColorModel();
        $pqrsModel = new PqrsModel();
        $tipoPqrsModel = new TipoPqrsModel();
        $estadoPqrsModel = new EstadoPqrsModel();
        $ofertaModel = new OfertasModel();
        $facturaCompraModel = new FacturaCompraModel();
        $facturaModel = new FacturaModel();
        $envioModel = new EnvioModel();
        $estadoEnvioModel = new EstadoEnvioModel();

        // ========== 1. MÓDULOS PERMITIDOS ==========
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // ========== 2. KPIs Y GRÁFICAS DE USUARIOS ==========
        $usuariosPorRol = $usuarioModel
            ->select('rol_id, COUNT(*) as total')
            ->groupBy('rol_id')
            ->findAll();

        $roles = $rolModel->findAll();
        $labelsRol = [];
        $datosRol = [];

        foreach ($usuariosPorRol as $item) {
            foreach ($roles as $rol) {
                if ($rol['id'] == $item['rol_id']) {
                    $labelsRol[] = $rol['nom'];
                    $datosRol[] = $item['total'];
                    break;
                }
            }
        }

        $activos = $usuarioModel->where('estado_usuario_id', 1)->countAllResults();
        $inactivos = $usuarioModel->where('estado_usuario_id', 4)->countAllResults();

        // KPIs Usuarios por rol
        $totalUsuarios = $usuarioModel->countAllResults();
        $totalAdmin = $usuarioModel->where('rol_id', 1)->countAllResults();
        $totalClientes = $usuarioModel->where('rol_id', 3)->countAllResults();
        $totalSoporte = $usuarioModel->where('rol_id', 2)->countAllResults();

        // === Usuarios API por mes ===
        $apiActivos = $apiUserModel->where('api_status', "Active")->countAllResults();
        $apiInactivos = $apiUserModel->where('api_status', "Inactive")->countAllResults();
        $totalUsuariosApi = $apiUserModel->countAllResults();

        $apiPorMes = $apiUserModel
            ->select("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("mes", "ASC")
            ->findAll();

        $labelsMesAPI = [];
        $datosMesAPI = [];
        foreach ($apiPorMes as $row) {
            $labelsMesAPI[] = $row['mes'];
            $datosMesAPI[] = $row['total'];
        }

        // ========== 3. KPIs Y GRÁFICAS DE PRODUCTOS ==========
        // Por categoría
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

        // Por marca
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

        // Por estado
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

        // Por sistema operativo
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

        // Por almacenamiento
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

        // Por color
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

        // KPIs Productos
        $totalProductos = $productoModel->countAllResults();
        $totalDisponibles = $productoModel->where('id_estado', 1)->countAllResults();
        $categoriasUnicas = count($categorias);
        $marcasUnicas = count($marcas);

        // ========== 4. KPIs Y GRÁFICAS DE FACTURAS COMPRA ==========
        $totalFacturas = $facturaCompraModel->totalFacturas();
        $totalProductosVendidos = $facturaCompraModel->totalProductosVendidos();
        $totalGanancias = $facturaCompraModel->totalGanancias();

        // Gráfico: Ventas por mes
        $ventasMesDB = $facturaCompraModel->ventasPorMes();
        $graficoVentasMes = [
            'labels' => array_column($ventasMesDB, 'mes'),
            'data'   => array_map('floatval', array_column($ventasMesDB, 'total')),
        ];

        // Gráfico: Productos más vendidos
        $productosTopDB = $facturaCompraModel->productosMasVendidos();
        $graficoProductosTop = [
            'labels' => array_map(
                fn($p) => trim($p['nombre'], '"'),
                $productosTopDB
            ),
            'data' => array_map(
                'intval',
                array_column($productosTopDB, 'total')
            ),
        ];

        // ========== 5. KPIs Y GRÁFICAS DE FACTURAS (API) ==========
        $facturasAPI = $facturaModel->getFacturas();
        $totalFacturasAPI = 0;
        $totalesPorEstado = [];
        $totalesPorTipo = [];
        $totalesPorPago = [];

        if (!isset($facturasAPI['error']) && isset($facturasAPI['data']['data'])) {
            foreach ($facturasAPI['data']['data'] as $factura) {
                $totalFacturasAPI++;

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

        // ========== 6. KPIs Y GRÁFICAS DE PQRS ==========
        // Por tipo
        $totalPqrsPorTipo = $pqrsModel->select('tipo_pqrs_id, COUNT(*) as total')
            ->groupBy('tipo_pqrs_id')
            ->findAll();

        $labelsTipoPqrs = [];
        $datosTipoPqrs = [];
        foreach ($totalPqrsPorTipo as $item) {
            $tipo = $tipoPqrsModel->find($item['tipo_pqrs_id']);
            $labelsTipoPqrs[] = $tipo['nom'] ?? 'Desconocido';
            $datosTipoPqrs[] = $item['total'];
        }

        // Por estado
        $totalPqrsPorEstado = $pqrsModel->select('estado_pqrs_id, COUNT(*) as total')
            ->groupBy('estado_pqrs_id')
            ->findAll();

        $labelsEstadoPqrs = [];
        $datosEstadoPqrs = [];
        foreach ($totalPqrsPorEstado as $item) {
            $estado = $estadoPqrsModel->find($item['estado_pqrs_id']);
            $labelsEstadoPqrs[] = $estado['nom'] ?? 'Desconocido';
            $datosEstadoPqrs[] = $item['total'];
        }
        $totalPqrs = array_sum($datosEstadoPqrs);

        // Por mes
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
        $topUsuariosPqrs = $pqrsModel->select('usuario_id, COUNT(*) as total')
            ->groupBy('usuario_id')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->findAll();

        $labelsUsuarioPqrs = [];
        $datosUsuarioPqrs = [];
        foreach ($topUsuariosPqrs as $item) {
            $usuario = $usuarioModel->find($item['usuario_id']);
            $labelsUsuarioPqrs[] = $usuario['primer_nombre'] ?? 'Desconocido';
            $datosUsuarioPqrs[] = $item['total'];
        }

        // ========== 7. KPIs Y GRÁFICAS DE OFERTAS ==========
        $totalOfertas = $ofertaModel->countAllResults();
        $ofertasActivas = $ofertaModel->where('estado', 'Activa')->countAllResults();
        $ofertasInactivas = $ofertaModel->where('estado', 'Inactiva')->countAllResults();
        $promedioDescuento = (float) ($ofertaModel->selectAvg('descuento')->first()['descuento'] ?? 0);

        // Por estado
        $estadoOfertas = $ofertaModel
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

        // Por mes
        $ofertasPorMes = $ofertaModel
            ->select("DATE_FORMAT(created_at, '%M') as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("MIN(created_at)", "ASC")
            ->findAll();

        $labelsMesOferta = [];
        $datosMesOferta = [];
        foreach ($ofertasPorMes as $item) {
            $labelsMesOferta[] = $item['mes'];
            $datosMesOferta[] = $item['total'];
        }

        // Por rango de descuento
        $rangos = [
            '0-10%' => [0, 10],
            '11-20%' => [11, 20],
            '21-30%' => [21, 30],
            '31-50%' => [31, 50],
            '51-100%' => [51, 100]
        ];

        $ofertas = $ofertaModel->select('descuento')->findAll();
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

        // ========== 8. KPIs Y GRÁFICAS DE ENVÍOS ==========
        $totalEnvios = $envioModel->countAllResults();
        $enviosEntregados = $envioModel->where('estado_envio_id', 4)->countAllResults();
        $enviosEnProceso = $envioModel->where('estado_envio_id', 2)->countAllResults();
        $enviosCancelados = $envioModel->where('estado_envio_id', 5)->countAllResults();
        $enviosPorConfirmar = $envioModel->where('estado_envio_id', 1)->countAllResults();

        // Por estado
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

        // Por mes
        $enviosPorMes = $envioModel
            ->select("MONTH(fecha) as mes, COUNT(*) as total")
            ->groupBy("mes")
            ->orderBy("mes", "ASC")
            ->findAll();

        $labelsMesEnvio = [];
        $datosMesEnvio = [];
        foreach ($enviosPorMes as $item) {
            $labelsMesEnvio[] = $meses[$item['mes'] - 1];
            $datosMesEnvio[] = $item['total'];
        }

        // Por ciudad
        $enviosPorCiudad = $envioModel
            ->select('direccion, COUNT(*) as total')
            ->groupBy('direccion')
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

        // ========== DATOS FINALES PARA LA VISTA ==========
        $data = [
            // Módulos
            'modulos' => $modulosPermitidos,

            // KPIs Usuarios
            'totalUsuarios' => $totalUsuarios,
            'totalAdmin' => $totalAdmin,
            'totalClientes' => $totalClientes,
            'totalSoporte' => $totalSoporte,
            'totalUsuariosApi' => $totalUsuariosApi,

            // Gráficas Usuarios
            'graficoUsuariosPorRol' => [
                'labels' => $labelsRol,
                'datos' => $datosRol
            ],
            'graficoEstadoUsuarios' => [
                'labels' => ['Activo', 'Inactivo'],
                'datos' => [$activos, $inactivos]
            ],
            'graficoEstadoAPI' => [
                'labels' => ['Activo', 'Inactivo'],
                'datos' => [$apiActivos, $apiInactivos]
            ],
            'graficoMesAPI' => [
                'labels' => $labelsMesAPI,
                'datos' => $datosMesAPI
            ],

            // KPIs Productos
            'totalProductos' => $totalProductos,
            'totalDisponibles' => $totalDisponibles,
            'categoriasUnicas' => $categoriasUnicas,
            'marcasUnicas' => $marcasUnicas,

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

            // KPIs Facturas Compra
            'totalFacturas' => $totalFacturas,
            'totalProductosVendidos' => $totalProductosVendidos,
            'totalGanancias' => $totalGanancias,

            // Gráficas Facturas Compra
            'graficoVentasMes' => $graficoVentasMes,
            'graficoProductosTop' => $graficoProductosTop,

            // KPIs Facturas API
            'totalFacturasAPI' => $totalFacturasAPI,
            'totalesPorEstadoFactura' => $totalesPorEstado,
            'totalesPorTipoFactura' => $totalesPorTipo,
            'totalesPorPagoFactura' => $totalesPorPago,

            // KPIs PQRS
            'totalPqrs' => $totalPqrs,

            // Gráficas PQRS
            'graficoTipoPqrs' => [
                'labels' => $labelsTipoPqrs,
                'datos' => $datosTipoPqrs
            ],
            'graficoEstadoPqrs' => [
                'labels' => $labelsEstadoPqrs,
                'datos' => $datosEstadoPqrs
            ],
            'graficoMesPqrs' => [
                'labels' => $labelsMesPqrs,
                'datos' => $datosMesPqrs
            ],
            'graficoUsuarioPqrs' => [
                'labels' => $labelsUsuarioPqrs,
                'datos' => $datosUsuarioPqrs
            ],

            // KPIs Ofertas
            'totalOfertas' => $totalOfertas,
            'ofertasActivas' => $ofertasActivas,
            'ofertasInactivas' => $ofertasInactivas,
            'promedioDescuento' => $promedioDescuento,

            // Gráficas Ofertas
            'graficoEstadoOferta' => [
                'labels' => $labelsEstadoOferta,
                'datos' => $datosEstadoOferta
            ],
            'graficoMesOferta' => [
                'labels' => $labelsMesOferta,
                'datos' => $datosMesOferta
            ],
            'graficoRangoDescuento' => [
                'labels' => array_keys($conteoPorRango),
                'datos' => array_values($conteoPorRango)
            ],

            // KPIs Envíos
            'totalEnvios' => $totalEnvios,
            'enviosEntregados' => $enviosEntregados,
            'enviosEnProceso' => $enviosEnProceso,
            'enviosCancelados' => $enviosCancelados,
            'enviosPorConfirmar' => $enviosPorConfirmar,

            // Gráficas Envíos
            'graficoEstadoEnvio' => [
                'labels' => $labelsEstadoEnvio,
                'datos' => $datosEstadoEnvio
            ],
            'graficoMesEnvio' => [
                'labels' => $labelsMesEnvio,
                'datos' => $datosMesEnvio
            ],
            'graficoCiudadEnvio' => [
                'labels' => $labelsCiudad,
                'datos' => $datosCiudad
            ],
            'ultimosEnvios' => $ultimosEnvios,
        ];

        return view('dashboard/dashboard', $data);
    }

    /**
     * Muestra la vista de error de acceso no autorizado.
     */
    public function error()
    {
        return view('errors/no_autorizado');
    }
}