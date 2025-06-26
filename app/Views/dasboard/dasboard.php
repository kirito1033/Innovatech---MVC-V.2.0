<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once("../app/Views/assets/css/css.php") ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <title>Dasboard</title>
  </head>
  <style>
    #dashboard{
      color: ffff;
    }
  </style>
  <body>
		<!--Preload-->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!--Navbar-->
    <?php require_once("../app/Views/nav/navbar.php")?>
	    <!-- Gráfica de usuarios por rol -->
    <!-- dashboard_view.php -->
    <div class="container my-4 text-center" >
    <h1  class="text-white">Dashboard</h1>
    </div>
    <div class="container my-4" >
     <h2>Usuarios</h2>
      <div class="row g-3">
        <!-- KPI Cards -->
        <div class="col-md-3">
          <div class="card text-white bg-primary shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Usuarios Totales</h6>
              <h3 class="card-text"><?= $totalUsuarios ?></h3>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-white bg-success shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Administradores</h6>
              <h3 class="card-text"><?= $totalAdmin ?></h3>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-white bg-info shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Clientes</h6>
              <h3 class="card-text"><?= $totalClientes ?></h3>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-white bg-danger shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Soporte</h6>
              <h3 class="card-text"><?= $totalSoporte ?></h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Row for Charts -->
      <div class="row g-3 mt-4">
        <!-- Bar Chart -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Usuarios por Rol</div>
            <div class="card-body">
              <canvas id="graficoUsuarios" height="250"></canvas>
            </div>
          </div>
        </div>

        <!-- Doughnut / Gauge Chart -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Distribución de Estados</div>
            <div class="card-body">
              <canvas id="graficoEstado" height="250"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
 
      <div class="container my-5">
         <h2>Usuarios Api</h2>
         <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm h-100 text-center mb-3">
        <div class="card-body">
          <h6 class="card-title">Usuarios API</h6>
          <h3 class="card-text"><?= $totalUsuariosApi ?></h3>
        </div>
      </div>
    </div>
    <div class="row g-4">
      <!-- Estados -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-light fw-bold">Distribución por Estado</div>
          <div class="card-body">
            <canvas id="graficoEstadoAPI" height="200"></canvas>
          </div>
        </div>
      </div>

      <!-- Por mes -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-light fw-bold">Usuarios Registrados por Mes</div>
          <div class="card-body">
            <canvas id="graficoMesAPI" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container my-5">
  <h2>Productos</h2>

  <!-- KPIs -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Productos</h6>
          <h3 class="card-text"><?= $totalProductos ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Disponibles</h6>
          <h3 class="card-text"><?= $totalDisponibles ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Por Categoría</h6>
          <h3 class="card-text"><?= $categoriasUnicas ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-info shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Por Marca</h6>
          <h3 class="card-text"><?= $marcasUnicas ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficos -->
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Categoría</div>
        <div class="card-body">
          <canvas id="graficoCategoria" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Marca</div>
        <div class="card-body">
          <canvas id="graficoMarca" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoProducto" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Sistema Operativo</div>
        <div class="card-body">
          <canvas id="graficoSO" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Almacenamiento</div>
        <div class="card-body">
          <canvas id="graficoAlmacenamiento" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Color</div>
        <div class="card-body">
          <canvas id="graficoColor" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
 <div class="container my-5">
<h2>Facturas</h2>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card text-white bg-primary shadow-sm h-100 text-center">
      <div class="card-body">
        <h6 class="card-title">Total Facturas</h6>
        <h3 class="card-text"><?= $totalFacturas ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-success shadow-sm h-100 text-center">
      <div class="card-body">
        <h6 class="card-title">Tipos de Factura</h6>
        <h3 class="card-text"><?= count($totalesPorTipoFactura) ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-warning shadow-sm h-100 text-center">
      <div class="card-body">
        <h6 class="card-title">Estados Factura</h6>
        <h3 class="card-text"><?= count($totalesPorEstadoFactura) ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-white bg-info shadow-sm h-100 text-center">
      <div class="card-body">
        <h6 class="card-title">Formas de Pago</h6>
        <h3 class="card-text"><?= count($totalesPorPagoFactura) ?></h3>
      </div>
    </div>
  </div>
</div>
<div class="row g-4">
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-light fw-bold">Facturas por Estado</div>
      <div class="card-body">
        <canvas id="graficoFacturasEstado" height="250"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-light fw-bold">Facturas por Tipo</div>
      <div class="card-body">
        <canvas id="graficoFacturasTipo" height="250"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-light fw-bold">Formas de Pago</div>
      <div class="card-body">
        <canvas id="graficoFacturasPago" height="250"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Contenedor de PQRS -->
<div class="container my-5">
  <h2>PQRS</h2>

  <div class="row g-4 mb-4">
    <!-- Total PQRS -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total PQRS</h6>
          <h3 class="card-text"><?= $totalPqrs ?></h3>
        </div>
      </div>
    </div>

    <!-- Top Usuario PQRS -->
    <div class="col-md-3">
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Top Usuario PQRS</h6>
          <h3 class="card-text">
            <?php
              if (!empty($graficoUsuarioPqrs['labels'])) {
                echo htmlspecialchars($graficoUsuarioPqrs['labels'][0]) . ' (' . $graficoUsuarioPqrs['datos'][0] . ')';
              } else {
                echo 'Sin datos';
              }
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Tipo</div>
        <div class="card-body">
          <canvas id="graficoTipoPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Usuarios con Más PQRS</div>
        <div class="card-body">
          <canvas id="graficoUsuarioPqrs" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <h2>Ofertas</h2>

  <!-- KPI de Ofertas -->
  <div class="row g-3 mb-4">
    <!-- Total ofertas -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Ofertas</h6>
          <h3 class="card-text"><?= $totalOfertas ?></h3>
        </div>
      </div>
    </div>

    <!-- Ofertas activas -->
    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Activas</h6>
          <h3 class="card-text"><?= $ofertasActivas ?></h3>
        </div>
      </div>
    </div>

    <!-- Ofertas inactivas -->
    <div class="col-md-3">
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Inactivas</h6>
          <h3 class="card-text"><?= $ofertasInactivas ?></h3>
        </div>
      </div>
    </div>

    <!-- Promedio de descuento (opcional) -->
    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Prom. Descuento</h6>
          <h3 class="card-text"><?= number_format($promedioDescuento ?? 0, 1) ?>%</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficas de Ofertas -->
  <div class="row g-4">
    <!-- Ofertas por Estado -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ofertas por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoOferta" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Ofertas por Mes -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ofertas por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesOferta" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Rango de Descuentos -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ofertas por Rango de Descuento</div>
        <div class="card-body">
          <canvas id="graficoRangoDescuento" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <h2>Envíos</h2>

  <!-- KPIs -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Envíos</h6>
          <h3 class="card-text"><?= $totalEnvios ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Entregados</h6>
          <h3 class="card-text"><?= $enviosEntregados ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">En Proceso</h6>
          <h3 class="card-text"><?= $enviosEnProceso ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Cancelados</h6>
          <h3 class="card-text"><?= $enviosCancelados ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-info shadow-sm h-100 text-center mt-3">
        <div class="card-body">
          <h6 class="card-title">En despacho</h6>
          <h3 class="card-text"><?= $enviosPorConfirmar ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficas -->
  <div class="row g-4">
    <!-- Envíos por Estado -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Envíos por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoEnvio" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Envíos por Mes -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Envíos por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesEnvio" height="250"></canvas>
        </div>
      </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    // === Usuarios por Rol ===
    const ctxBar = document.getElementById('graficoUsuarios');
    if (ctxBar) {
      new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoUsuarios['labels']) ?>,
          datasets: [{
            label: '',
            data: <?= json_encode($graficoUsuarios['totales']) ?>,
            backgroundColor: ['#4e79a7', '#f28e2c', '#e15759', '#76b7b2'],
            borderRadius: 4,
            barThickness: 20
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Usuarios por Rol',
              font: { size: 14 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5, left: 5, right: 5 }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: { font: { size: 10 } }
            },
            x: {
              ticks: { font: { size: 10 } }
            }
          }
        }
      });
    }

    // === Estado Usuarios ===
    const ctxPie = document.getElementById('graficoEstado');
    if (ctxPie) {
      new Chart(ctxPie, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode($graficoEstado['labels']) ?>,
          datasets: [{
            data: <?= json_encode($graficoEstado['datos']) ?>,
            backgroundColor: ['#28a745', '#dc3545']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '75%',
          plugins: {
            legend: {
              position: 'bottom',
              labels: { font: { size: 10 } }
            },
            title: {
              display: true,
              text: 'Activos vs Inactivos',
              font: { size: 12 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5 }
          }
        }
      });
    }

    // === API Meses ===
    const ctxMes = document.getElementById('graficoMesAPI');
    if (ctxMes) {
      new Chart(ctxMes, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoMes['labels']) ?>,
          datasets: [{
            label: 'Usuarios',
            data: <?= json_encode($graficoMes['datos']) ?>,
            backgroundColor: '#4e79a7',
            borderRadius: 4,
            barThickness: 20
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: 'Usuarios Registrados por Mes',
              font: { size: 14 }
            },
            legend: { display: false }
          },
          layout: {
            padding: { top: 5, bottom: 5 }
          },
          scales: {
            y: { beginAtZero: true, ticks: { font: { size: 10 } } },
            x: { ticks: { font: { size: 10 } } }
          }
        }
      });
    }

    // === Estado API Users ===
    const ctxEstadoAPI = document.getElementById('graficoEstadoAPI');
    if (ctxEstadoAPI) {
      new Chart(ctxEstadoAPI, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode($graficoEstadoAPI['labels']) ?>,
          datasets: [{
            data: <?= json_encode($graficoEstadoAPI['datos']) ?>,
            backgroundColor: ['#17a2b8', '#ffc107']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          plugins: {
            legend: {
              position: 'bottom',
              labels: { font: { size: 10 } }
            },
            title: {
              display: true,
              text: 'API Users Activos vs Inactivos',
              font: { size: 12 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5 }
          }
        }
      });
    }

    // === Productos por Categoría ===
    const ctxCategoria = document.getElementById('graficoCategoria');
    if (ctxCategoria) {
      new Chart(ctxCategoria, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoCategoria['labels']) ?>,
          datasets: [{
            label: 'Productos',
            data: <?= json_encode($graficoCategoria['datos']) ?>,
            backgroundColor: '#6f42c1'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Productos por Categoría', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Productos por Marca ===
    const ctxMarca = document.getElementById('graficoMarca');
    if (ctxMarca) {
      new Chart(ctxMarca, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoMarca['labels']) ?>,
          datasets: [{
            label: 'Productos',
            data: <?= json_encode($graficoMarca['datos']) ?>,
            backgroundColor: '#fd7e14'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Productos por Marca', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Estado Productos ===
    const ctxEstadoProducto = document.getElementById('graficoEstadoProducto');
    if (ctxEstadoProducto) {
      new Chart(ctxEstadoProducto, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode($graficoEstadoProducto['labels']) ?>,
          datasets: [{
            data: <?= json_encode($graficoEstadoProducto['datos']) ?>,
            backgroundColor: ['#28a745', '#ffc107', '#dc3545']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { position: 'bottom', labels: { font: { size: 10 } } },
            title: { display: true, text: 'Estado de Productos', font: { size: 12 } }
          }
        }
      });
    }

    // === Productos por SO ===
    const ctxSO = document.getElementById('graficoSO');
    if (ctxSO) {
      new Chart(ctxSO, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoSO['labels']) ?>,
          datasets: [{
            label: 'Productos',
            data: <?= json_encode($graficoSO['datos']) ?>,
            backgroundColor: '#20c997'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Productos por SO', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Productos por Almacenamiento ===
    const ctxAlm = document.getElementById('graficoAlmacenamiento');
    if (ctxAlm) {
      new Chart(ctxAlm, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoAlmacenamiento['labels']) ?>,
          datasets: [{
            label: 'Productos',
            data: <?= json_encode($graficoAlmacenamiento['datos']) ?>,
            backgroundColor: '#0dcaf0'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Productos por Almacenamiento', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Productos por Color ===
    const ctxColor = document.getElementById('graficoColor');
    if (ctxColor) {
      new Chart(ctxColor, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode($graficoColor['labels']) ?>,
          datasets: [{
            data: <?= json_encode($graficoColor['datos']) ?>,
            backgroundColor: ['#007bff', '#6c757d', '#dc3545', '#ffc107', '#198754', '#6610f2']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { position: 'bottom', labels: { font: { size: 10 } } },
            title: { display: true, text: 'Productos por Color', font: { size: 12 } }
          }
        }
      });
    }
  });

      // === Facturas por Estado ===
    const ctxFactEstado = document.getElementById('graficoFacturasEstado');
    if (ctxFactEstado) {
      new Chart(ctxFactEstado, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode(array_keys($totalesPorEstadoFactura)) ?>,
          datasets: [{
            data: <?= json_encode(array_values($totalesPorEstadoFactura)) ?>,
            backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#6c757d']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          plugins: {
            legend: { position: 'bottom', labels: { font: { size: 10 } } },
            title: { display: true, text: 'Estado de Facturas', font: { size: 12 } }
          }
        }
      });
    }

    // === Facturas por Tipo ===
    const ctxFactTipo = document.getElementById('graficoFacturasTipo');
    if (ctxFactTipo) {
      new Chart(ctxFactTipo, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_keys($totalesPorTipoFactura)) ?>,
          datasets: [{
            label: 'Cantidad',
            data: <?= json_encode(array_values($totalesPorTipoFactura)) ?>,
            backgroundColor: '#0d6efd'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Tipos de Factura', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Formas de Pago ===
    const ctxFactPago = document.getElementById('graficoFacturasPago');
    if (ctxFactPago) {
      new Chart(ctxFactPago, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_keys($totalesPorPagoFactura)) ?>,
          datasets: [{
            label: 'Cantidad',
            data: <?= json_encode(array_values($totalesPorPagoFactura)) ?>,
            backgroundColor: '#20c997'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Formas de Pago', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } },
            y: { beginAtZero: true, ticks: { font: { size: 9 } } }
          }
        }
      });
    }
    // === PQRS por Tipo ===
const ctxTipoPqrs = document.getElementById('graficoTipoPqrs');
if (ctxTipoPqrs) {
  new Chart(ctxTipoPqrs, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoTipoPqrs['labels']) ?>,
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoTipoPqrs['datos']) ?>,
        backgroundColor: '#4e73df'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'PQRS por Tipo',
          font: { size: 14 }
        },
        legend: { display: false }
      },
      scales: {
        x: { ticks: { font: { size: 9 } } },
        y: { beginAtZero: true, ticks: { font: { size: 9 } } }
      }
    }
  });
}

// === PQRS por Estado ===
const ctxEstadoPqrs = document.getElementById('graficoEstadoPqrs');
if (ctxEstadoPqrs) {
  new Chart(ctxEstadoPqrs, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($graficoEstadoPqrs['labels']) ?>,
      datasets: [{
        data: <?= json_encode($graficoEstadoPqrs['datos']) ?>,
        backgroundColor: ['#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6f42c1']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '70%',
      plugins: {
        legend: {
          position: 'bottom',
          labels: { font: { size: 10 } }
        },
        title: {
          display: true,
          text: 'Estado de PQRS',
          font: { size: 12 }
        }
      }
    }
  });
}

// === PQRS por Mes ===
const ctxMesPqrs = document.getElementById('graficoMesPqrs');
if (ctxMesPqrs) {
  new Chart(ctxMesPqrs, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoMesPqrs['labels']) ?>,
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoMesPqrs['datos']) ?>,
        backgroundColor: '#20c997'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'PQRS por Mes',
          font: { size: 14 }
        },
        legend: { display: false }
      },
      scales: {
        x: { ticks: { font: { size: 9 } } },
        y: { beginAtZero: true, ticks: { font: { size: 9 } } }
      }
    }
  });
}

// === Top Usuarios con PQRS ===
const ctxUsuarioPqrs = document.getElementById('graficoUsuarioPqrs');
if (ctxUsuarioPqrs) {
  new Chart(ctxUsuarioPqrs, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoUsuarioPqrs['labels']) ?>,
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoUsuarioPqrs['datos']) ?>,
        backgroundColor: '#fd7e14'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Usuarios con Más PQRS',
          font: { size: 14 }
        },
        legend: { display: false }
      },
      scales: {
        x: { ticks: { font: { size: 9 } } },
        y: { beginAtZero: true, ticks: { font: { size: 9 } } }
      }
    }
  });
}
// === Ofertas por Estado ===
const ctxEstadoOferta = document.getElementById('graficoEstadoOferta');
if (ctxEstadoOferta) {
  new Chart(ctxEstadoOferta, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($graficoEstadoOferta['labels']) ?>,
      datasets: [{
        data: <?= json_encode($graficoEstadoOferta['datos']) ?>,
        backgroundColor: ['#198754', '#dc3545', '#ffc107']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '70%',
      plugins: {
        legend: { position: 'bottom', labels: { font: { size: 10 } } },
        title: { display: true, text: 'Ofertas por Estado', font: { size: 12 } }
      }
    }
  });
}

// === Ofertas por Mes ===
const ctxMesOferta = document.getElementById('graficoMesOferta');
if (ctxMesOferta) {
  new Chart(ctxMesOferta, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoMesOferta['labels']) ?>,
      datasets: [{
        label: 'Ofertas',
        data: <?= json_encode($graficoMesOferta['datos']) ?>,
        backgroundColor: '#4e73df'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: { display: true, text: 'Ofertas por Mes', font: { size: 14 } },
        legend: { display: false }
      },
      scales: {
        x: { ticks: { font: { size: 9 } } },
        y: { beginAtZero: true, ticks: { font: { size: 9 } } }
      }
    }
  });
}

// === Rango de Descuento ===
const ctxRangoDescuento = document.getElementById('graficoRangoDescuento');
if (ctxRangoDescuento) {
  new Chart(ctxRangoDescuento, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoRangoDescuento['labels']) ?>,
      datasets: [{
        label: 'Ofertas',
        data: <?= json_encode($graficoRangoDescuento['datos']) ?>,
        backgroundColor: '#fd7e14'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: { display: true, text: 'Rangos de Descuento', font: { size: 14 } },
        legend: { display: false }
      },
      scales: {
        x: { ticks: { font: { size: 9 } } },
        y: { beginAtZero: true, ticks: { font: { size: 9 } } }
      }
    }
  });
}

const renderBarChart = (id, labels, datos, label = 'Cantidad') => {
    new Chart(document.getElementById(id), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: label,
          backgroundColor: '#04ebec',
          borderColor: '#0b4454',
          borderWidth: 1,
          data: datos
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  };

  renderBarChart('graficoEstadoEnvio', <?= json_encode($graficoEstadoEnvio['labels']) ?>, <?= json_encode($graficoEstadoEnvio['datos']) ?>);
  renderBarChart('graficoMesEnvio', <?= json_encode($graficoMesEnvio['labels']) ?>, <?= json_encode($graficoMesEnvio['datos']) ?>);
  renderBarChart('graficoCiudadEnvio', <?= json_encode($graficoCiudadEnvio['labels']) ?>, <?= json_encode($graficoCiudadEnvio['datos']) ?>);
</script>


  </body>

</html>