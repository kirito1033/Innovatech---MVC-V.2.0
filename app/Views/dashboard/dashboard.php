<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Codificación y escalado en dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos personalizados desde una vista compartida -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilo de la librería DataTables (aunque no se usa en esta vista) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título de la pestaña del navegador -->
    <title>Dashboard</title>
  </head>

  <body>
		<!-- Componente de precarga animado -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
    <!-- Contenedor principal del dashboard -->
    <div class="container my-4 text-center" >
    <h1  class="text-white">Dashboard</h1>
    </div>

    <!-- Sección de estadísticas de usuarios -->
    <div class="container my-4" >
     <h2>Usuarios</h2>
      <div class="row g-3">

        <!-- Tarjeta: Total de usuarios -->
        <div class="col-md-3">
          <div class="card text-white bg-primary shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Usuarios Totales</h6>
              <h3 class="card-text"><?= $totalUsuarios ?></h3>
            </div>
          </div>
        </div>

        <!-- Tarjeta: Administradores -->
        <div class="col-md-3">
          <div class="card text-white bg-success shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Administradores</h6>
              <h3 class="card-text"><?= $totalAdmin ?></h3>
            </div>
          </div>
        </div>

        <!-- Tarjeta: Clientes -->
        <div class="col-md-3">
          <div class="card text-white bg-info shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Clientes</h6>
              <h3 class="card-text"><?= $totalClientes ?></h3>
            </div>
          </div>
        </div>

        <!-- Tarjeta: Soporte -->
        <div class="col-md-3">
          <div class="card text-white bg-danger shadow-sm h-100 text-center">
            <div class="card-body">
              <h6 class="card-title">Soporte</h6>
              <h3 class="card-text"><?= $totalSoporte ?></h3>
            </div>
          </div>
        </div>
      </div> <!-- Fin de fila -->

     <!-- Fila de gráficos principales -->
      <div class="row g-3 mt-4">

        <!-- Gráfico de barras: Usuarios por rol -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Usuarios por Rol</div>
            <div class="card-body">
              <!-- Canvas donde se renderizará el gráfico con Chart.js -->
              <canvas id="graficoUsuariosPorRol" height="250"></canvas>
            </div>
          </div>
        </div>

        <!-- Gráfico tipo doughnut: Distribución de estados de usuarios -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Distribución de Estados</div>
            <div class="card-body">
              <canvas id="graficoEstadoUsuarios" height="250"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Fin del contenedor anterior -->
 
    <!-- Sección de Usuarios API -->
      <div class="container my-5">
         <h2>Usuarios Api</h2>

         <!-- KPI: Cantidad total de usuarios obtenidos desde la API -->
         <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm h-100 text-center mb-3">
        <div class="card-body">
          <h6 class="card-title">Usuarios API</h6>
          <h3 class="card-text"><?= $totalUsuariosApi ?></h3>
        </div>
      </div>
    </div>
    <div class="row g-4">

       <!-- Gráfico de torta o barras: Estados de usuarios API -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-light fw-bold">Distribución por Estado</div>
          <div class="card-body">
            <canvas id="graficoEstadoAPI" height="200"></canvas>
          </div>
        </div>
      </div>

      <!-- Gráfico de líneas o barras: Usuarios API registrados por mes -->
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

  <!-- Sección de Productos -->
  <div class="container my-5">
  <h2>Productos</h2>

  <!-- KPIs de productos -->
  <div class="row g-3 mb-4">

  <!-- Total de productos registrados -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Productos</h6>
          <h3 class="card-text"><?= $totalProductos ?></h3>
        </div>
      </div>
    </div>

    <!-- Productos disponibles -->
    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Disponibles</h6>
          <h3 class="card-text"><?= $totalDisponibles ?></h3>
        </div>
      </div>
    </div>

    <!-- Productos agrupados por categoría -->
    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Por Categoría</h6>
          <h3 class="card-text"><?= $categoriasUnicas ?></h3>
        </div>
      </div>
    </div>

    <!-- Productos agrupados por marca -->
    <div class="col-md-3">
      <div class="card text-white bg-info shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Por Marca</h6>
          <h3 class="card-text"><?= $marcasUnicas ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficos relacionados con productos -->
  <div class="row g-4">
    <!-- Gráfico: Productos por categoría -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Categoría</div>
        <div class="card-body">
          <canvas id="graficoCategoria" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de productos por marca -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Marca</div>
        <div class="card-body">
          <!-- Canvas para el gráfico generado con Chart.js -->
          <canvas id="graficoMarca" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de productos por estado (ej: nuevo, usado) -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoProducto" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de productos por sistema operativo (ej: Android, iOS, etc.) -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Sistema Operativo</div>
        <div class="card-body">
          <canvas id="graficoSO" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de productos por capacidad de almacenamiento -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Productos por Almacenamiento</div>
        <div class="card-body">
          <canvas id="graficoAlmacenamiento" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de productos por color -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <!-- Título de la tarjeta -->
        <div class="card-header bg-light fw-bold">Productos por Color</div>
        <div class="card-body">
          <!-- Lienzo para renderizar el gráfico con Chart.js -->
          <canvas id="graficoColor" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <h2>Facturas</h2>

  <!-- KPIs de Facturación -->
  <div class="row g-3 mb-4">

    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Facturas</h6>
          <h3><?= $totalFacturas ?? 0 ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Productos Vendidos</h6>
          <h3><?= $totalProductos ?? 0 ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Ganancias Totales</h6>
          <h3>$<?= number_format($totalGanancias ?? 0, 0, ',', '.') ?></h3>
        </div>
      </div>
    </div>

  </div>

  <!-- Gráficos -->
  <div class="row g-4">

    <!-- Ventas por Mes -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ventas por Mes</div>
        <div class="card-body">
          <canvas id="graficoVentasMes" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Productos Más Vendidos -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Top Productos Vendidos</div>
        <div class="card-body">
          <canvas id="graficoProductosTop" height="250"></canvas>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Sección de PQRS -->
<div class="container my-5">
  <h2>PQRS</h2>

  <!-- KPIs PQRS -->
  <div class="row g-4 mb-4">
    <!-- Total de PQRS recibidas -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total PQRS</h6>
          <h3 class="card-text"><?= $totalPqrs ?></h3>
        </div>
      </div>
    </div>

    <!-- Usuario que más PQRS ha generado -->
    <div class="col-md-3">
      <!-- Tarjeta de color rojo (bg-danger) para destacar visualmente -->
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
           <!-- Título de la tarjeta -->
          <h6 class="card-title">Top Usuario PQRS</h6>
          <!-- Contenido principal: nombre del usuario que más PQRS ha generado -->
          <h3 class="card-text">
            <?php
            // Validación: si existen datos en el array 'labels' del gráfico de PQRS por usuario
              if (!empty($graficoUsuarioPqrs['labels'])) {
                // Muestra el primer nombre (índice 0) del array 'labels' y su cantidad correspondiente (índice 0 de 'datos')
                echo htmlspecialchars($graficoUsuarioPqrs['labels'][0]) . ' (' . $graficoUsuarioPqrs['datos'][0] . ')';
              } else {
                // Si no hay datos disponibles, muestra un mensaje alternativo
                echo 'Sin datos';
              }
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Contenedor de fila con margen entre elementos -->
  <div class="row g-4">

    <!-- Tarjeta con gráfico de PQRS por Tipo (sugerencia, queja, reclamo, etc.) -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Tipo</div>
        <div class="card-body">
          <!-- Gráfico de barras o pastel renderizado por Chart.js -->
          <canvas id="graficoTipoPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

      <!-- Tarjeta con gráfico de PQRS por Estado (abierto, en proceso, cerrado, etc.) -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Tarjeta con gráfico de PQRS por mes (tendencia temporal) -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">PQRS por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesPqrs" height="250"></canvas>
        </div>
      </div>
    </div>

  <!-- Tarjeta que muestra el gráfico con los usuarios que más PQRS han generado -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <!-- Título de la tarjeta -->
        <div class="card-header bg-light fw-bold">Usuarios con Más PQRS</div>
        <div class="card-body">
          <!-- Lienzo para el gráfico (Chart.js u otra librería) -->
          <canvas id="graficoUsuarioPqrs" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <h2>Ofertas</h2>

  <!-- Indicadores clave de ofertas -->
  <div class="row g-3 mb-4">

    <!-- Total de ofertas registradas -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Ofertas</h6>
          <h3 class="card-text"><?= $totalOfertas ?></h3>
        </div>
      </div>
    </div>

    <!-- Número de ofertas activas -->
    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Activas</h6>
          <h3 class="card-text"><?= $ofertasActivas ?></h3>
        </div>
      </div>
    </div>

    <!-- Número de ofertas inactivas -->
    <div class="col-md-3">
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Inactivas</h6>
          <h3 class="card-text"><?= $ofertasInactivas ?></h3>
        </div>
      </div>
    </div>

    <!-- Promedio de descuento en ofertas -->
    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Prom. Descuento</h6>
          <h3 class="card-text"><?= number_format($promedioDescuento ?? 0, 1) ?>%</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficas relacionadas con las ofertas -->
  <div class="row g-4">

     <!-- Gráfico por estado de las ofertas -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ofertas por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoOferta" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico por mes -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Ofertas por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesOferta" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico por rangos de descuento -->
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

 <!-- KPIs de envíos -->
  <div class="row g-3 mb-4">

  <!-- Total de envíos -->
    <div class="col-md-3">
      <div class="card text-white bg-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Total Envíos</h6>
          <h3 class="card-text"><?= $totalEnvios ?></h3>
        </div>
      </div>
    </div>

    <!-- Envíos entregados -->
    <div class="col-md-3">
      <div class="card text-white bg-success shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Entregados</h6>
          <h3 class="card-text"><?= $enviosEntregados ?></h3>
        </div>
      </div>
    </div>

    <!-- Envíos en proceso -->
    <div class="col-md-3">
      <div class="card text-white bg-warning shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">En Proceso</h6>
          <h3 class="card-text"><?= $enviosEnProceso ?></h3>
        </div>
      </div>
    </div>

     <!-- Envíos cancelados -->
    <div class="col-md-3">
      <div class="card text-white bg-danger shadow-sm h-100 text-center">
        <div class="card-body">
          <h6 class="card-title">Cancelados</h6>
          <h3 class="card-text"><?= $enviosCancelados ?></h3>
        </div>
      </div>
    </div>

    <!-- Envíos en despacho -->
    <div class="col-md-3">
      <div class="card text-white bg-info shadow-sm h-100 text-center mt-3">
        <div class="card-body">
          <h6 class="card-title">En despacho</h6>
          <h3 class="card-text"><?= $enviosPorConfirmar ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficas de envíos -->
  <div class="row g-4">

    <!-- Gráfico por estado -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Envíos por Estado</div>
        <div class="card-body">
          <canvas id="graficoEstadoEnvio" height="250"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico por mes -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-light fw-bold">Envíos por Mes</div>
        <div class="card-body">
          <canvas id="graficoMesEnvio" height="250"></canvas>
        </div>
      </div>
    </div>

<!-- Inclusión del script de Chart.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Espera a que el DOM esté completamente cargado
  window.addEventListener("DOMContentLoaded", () => {
    // =======================
    // FACTURACIÓN - CHARTS
    // =======================

    // Ventas por Mes
    const ctxVentasMes = document.getElementById('graficoVentasMes');
    if (ctxVentasMes) {
        new Chart(ctxVentasMes, {
            type: 'line',
            data: {
            labels: <?= json_encode($graficoVentasMes['labels']) ?>,
            datasets: [{
                label: 'Ventas',
                data: <?= json_encode($graficoVentasMes['data']) ?>,
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                tension: 0.4,
                fill: true
            }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: {
                display: true,
                text: 'Ventas Mensuales',
                font: { size: 14 }
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
            }
        });
        }

        // Productos Más Vendidos
        const ctxProductosTop = document.getElementById('graficoProductosTop');
        if (ctxProductosTop) {
        new Chart(ctxProductosTop, {
            type: 'bar',
            data: {
            labels: <?= json_encode($graficoProductosTop['labels']) ?>,
            datasets: [{
                label: 'Unidades Vendidas',
                data: <?= json_encode($graficoProductosTop['data']) ?>,
                backgroundColor: '#0d6efd',
                borderRadius: 5
            }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: {
                display: true,
                text: 'Top Productos',
                font: { size: 14 }
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
            }
        });
    }

    // === Gráfico de Barras: Usuarios por Rol ===
    const ctxBar = document.getElementById('graficoUsuariosPorRol');
    if (ctxBar) {
      new Chart(ctxBar, {
        type: 'bar', // Tipo de gráfico
        data: {
          labels: <?= json_encode($graficoUsuariosPorRol['datos']) ?>, // Nombres de los roles (por ejemplo: Admin, Cliente, etc.)
          datasets: [{
            label: '', // Sin etiqueta de leyenda
            data: <?= json_encode($graficoUsuariosPorRol['datos']) ?>, // Totales de usuarios por cada rol
            backgroundColor: ['#4e79a7', '#f28e2c', '#e15759', '#76b7b2'], // Colores de las barras
            borderRadius: 4, // Bordes redondeados
            barThickness: 20 // Grosor de cada barra
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }, // Oculta la leyenda
            title: {
              display: true,
              text: 'Usuarios por Rol', // Título superior
              font: { size: 14 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5, left: 5, right: 5 }
          },
          scales: {
            y: {
              beginAtZero: true, // El eje Y comienza en 0
              ticks: { font: { size: 10 } }
            },
            x: {
              ticks: { font: { size: 10 } }
            }
          }
        }
      });
    }

    // === Gráfico Doughnut: Estado de Usuarios (Activos vs Inactivos) ===
    const ctxPie = document.getElementById('graficoEstadoUsuarios');
    if (ctxPie) {
      new Chart(ctxPie, {
        type: 'doughnut', // Gráfico tipo dona
        data: {
          labels: <?= json_encode($graficoEstadoUsuarios['labels']) ?>, // Labels como: Activos, Inactivos
          datasets: [{
            data: <?= json_encode($graficoEstadoUsuarios['datos']) ?>, // Totales correspondientes
            backgroundColor: ['#28a745', '#dc3545'] // Colores para cada estado
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '75%',  // Grosor del anillo
          plugins: {
            legend: {
              position: 'bottom', // Posición de la leyenda
              labels: { font: { size: 10 } }
            },
            title: {
              display: true,
              text: 'Activos vs Inactivos', // Título
              font: { size: 12 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5 }
          }
        }
      });
    }

    // === Gráfico de Barras: Usuarios API registrados por Mes ===
    const ctxMes = document.getElementById('graficoMesAPI');
    if (ctxMes) {
      new Chart(ctxMes, {
        type: 'bar', // Gráfico de barras
        data: {
          labels: <?= json_encode($graficoMesAPI['labels']) ?>, // Meses (Ej: Enero, Febrero...)
          datasets: [{
            label: 'Usuarios',
            data: <?= json_encode($graficoMesAPI['datos']) ?>, // Número de usuarios registrados por mes
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
              text: 'Usuarios Registrados por Mes', // Título del gráfico
              font: { size: 14 }
            },
            legend: { display: false } // Oculta la leyenda
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

    // === Gráfico Doughnut: Estado de Usuarios de la API (Activos vs Inactivos) ===
    const ctxEstadoAPI = document.getElementById('graficoEstadoAPI');
    if (ctxEstadoAPI) {
      new Chart(ctxEstadoAPI, {
        type: 'doughnut', // Tipo de gráfico: dona
        data: {
          labels: <?= json_encode($graficoEstadoAPI['labels']) ?>, // Etiquetas de los estados (Ej: Activo, Inactivo)
          datasets: [{
            data: <?= json_encode($graficoEstadoAPI['datos']) ?>,// Cantidad de usuarios por estado
            backgroundColor: ['#17a2b8', '#ffc107'] // Colores para cada estado (info y warning)
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%', // Grosor de la dona
          plugins: {
            legend: {
              position: 'bottom', // Leyenda en la parte inferior
              labels: { font: { size: 10 } }
            },
            title: {
              display: true,
              text: 'API Users Activos vs Inactivos',// Título del gráfico
              font: { size: 12 }
            }
          },
          layout: {
            padding: { top: 5, bottom: 5 } // Espaciado interno
          }
        }
      });
    }

    // === Gráfico de Barras: Productos por Categoría ===
    const ctxCategoria = document.getElementById('graficoCategoria');
    if (ctxCategoria) {
      new Chart(ctxCategoria, {
        type: 'bar', // Tipo de gráfico: barras verticales
        data: {
          labels: <?= json_encode($graficoCategoria['labels']) ?>, // Nombres de categorías de productos
          datasets: [{
            label: 'Productos',  // Etiqueta del conjunto de datos
            data: <?= json_encode($graficoCategoria['datos']) ?>, // Número de productos por categoría
            backgroundColor: '#6f42c1' // Color de las barras (púrpura)
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },  // Espaciado interno
          plugins: {
            legend: { display: false }, // Oculta la leyenda para este gráfico
            title: { display: true, text: 'Productos por Categoría', // Título del gráfico
               font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } }, // Fuente de etiquetas del eje X
            y: { beginAtZero: true, // Comienza en 0 en el eje Y
               ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Gráfico de Barras: Productos por Marca ===
    const ctxMarca = document.getElementById('graficoMarca');
    if (ctxMarca) {
      new Chart(ctxMarca, {
        type: 'bar', // Tipo de gráfico: barras verticales
        data: {
          labels: <?= json_encode($graficoMarca['labels']) ?>,  // Etiquetas de marcas (Ej: Samsung, Apple, etc.)
          datasets: [{
            label: 'Productos', // Etiqueta del conjunto de datos
            data: <?= json_encode($graficoMarca['datos']) ?>,  // Número de productos por cada marca
            backgroundColor: '#fd7e14' // Color de las barras (naranja)
          }]
        },
        options: {
          responsive: true, // Ajuste automático al tamaño del contenedor
          maintainAspectRatio: false, // No mantiene proporción de aspecto fijo
          layout: { padding: { top: 5, bottom: 5 } }, // Espaciado superior e inferior
          plugins: {
            legend: { display: false }, // Oculta la leyenda
            title: { display: true, text: 'Productos por Marca',  // Título del gráfico
              font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } }, // Tamaño de texto en eje X
            y: { beginAtZero: true,  // Comienza desde cero en eje Y
              ticks: { font: { size: 9 } } }
          }
        }
      });
    }

    // === Gráfico Doughnut: Estado de los Productos ===
    const ctxEstadoProducto = document.getElementById('graficoEstadoProducto');
    if (ctxEstadoProducto) {
      new Chart(ctxEstadoProducto, {
        type: 'doughnut', // Tipo de gráfico: dona
        data: {
          labels: <?= json_encode($graficoEstadoProducto['labels']) ?>, // Estados de los productos (Ej: Disponible, Reservado, Vendido)
          datasets: [{
            data: <?= json_encode($graficoEstadoProducto['datos']) ?>, // Cantidad de productos por estado
            backgroundColor: ['#28a745', '#ffc107', '#dc3545'] // Colores para cada estado (verde, amarillo, rojo)
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%', // Grosor del centro de la dona
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { position: 'bottom',  // Posición de la leyenda
              labels: { font: { size: 10 } } },
            title: { display: true, text: 'Estado de Productos',  // Título del gráfico
              font: { size: 12 } }
          }
        }
      });
    }

    // === Gráfico de Barras: Productos por Sistema Operativo (SO) ===
    const ctxSO = document.getElementById('graficoSO'); // Obtiene el elemento canvas para el gráfico
    if (ctxSO) {
      new Chart(ctxSO, {
        type: 'bar', // Tipo de gráfico: barras
        data: {
          labels: <?= json_encode($graficoSO['labels']) ?>,  // Etiquetas de los distintos sistemas operativos
          datasets: [{
            label: 'Productos', // Leyenda del dataset
            data: <?= json_encode($graficoSO['datos']) ?>, // Cantidad de productos por sistema operativo
            backgroundColor: '#20c997' // Color verde-menta
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, // Permite que el gráfico se adapte al contenedor
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false },  // Oculta leyenda
            title: { display: true, text: 'Productos por SO', // Título del gráfico
              font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } }, // Fuente para eje X
            y: { beginAtZero: true, ticks: { font: { size: 9 } } } // Eje Y comienza desde 0
          }
        }
      });
    }

    // === Gráfico de Barras: Productos por Capacidad de Almacenamiento ===
    const ctxAlm = document.getElementById('graficoAlmacenamiento'); // Canvas del gráfico
    if (ctxAlm) {
      new Chart(ctxAlm, {
        type: 'bar',
        data: {
          labels: <?= json_encode($graficoAlmacenamiento['labels']) ?>, // Etiquetas de capacidades (ej: 64GB, 128GB, etc.)
          datasets: [{
            label: 'Productos',
            data: <?= json_encode($graficoAlmacenamiento['datos']) ?>, // Cantidad por cada capacidad
            backgroundColor: '#0dcaf0' // Azul celeste
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

    // === Gráfico Doughnut: Productos por Color ===
    const ctxColor = document.getElementById('graficoColor'); // Canvas para gráfico de dona
    if (ctxColor) {
      new Chart(ctxColor, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode($graficoColor['labels']) ?>, // Colores (ej: Negro, Azul, Rojo, etc.)
          datasets: [{
            data: <?= json_encode($graficoColor['datos']) ?>, // Total de productos por color
            backgroundColor: [
              '#007bff', // Azul
              '#6c757d', // Gris
              '#dc3545', // Rojo
              '#ffc107', // Amarillo
              '#198754', // Verde
              '#6610f2' // Morado
            ]
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%', // Grosor del centro
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { position: 'bottom', // Muestra la leyenda debajo del gráfico
              labels: { font: { size: 10 } } },
            title: { display: true, text: 'Productos por Color', // Título del gráfico
              font: { size: 12 } }
          }
        }
      });
    }

    closepreload();
  });

      // === Facturas por Estado ===
// Este bloque genera un gráfico de tipo "doughnut" que muestra la cantidad de facturas según su estado (Ej: Pagadas, Pendientes, Canceladas, etc.)
    const ctxFactEstado = document.getElementById('graficoFacturasEstado');
    if (ctxFactEstado) {
      new Chart(ctxFactEstado, {
        type: 'doughnut',
        data: {
          labels: <?= json_encode(array_keys($totalesPorEstadoFactura)) ?>,// Etiquetas: nombres de los estados
          datasets: [{
            data: <?= json_encode(array_values($totalesPorEstadoFactura)) ?>, // Datos: cantidad por estado
            backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#6c757d'] // Colores representativos por estado
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%', // Grosor del centro del doughnut
          plugins: {
            legend: { position: 'bottom', labels: { font: { size: 10 } } }, // Tamaño del texto en la leyenda
            title: { display: true, text: 'Estado de Facturas', font: { size: 12 } }
          }
        }
      });
    }

    // === Facturas por Tipo ===
// Este bloque genera un gráfico de barras que representa la cantidad de facturas según su tipo (Ej: Electrónica, Crédito, Contado, etc.)
    const ctxFactTipo = document.getElementById('graficoFacturasTipo');
    if (ctxFactTipo) {
      new Chart(ctxFactTipo, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_keys($totalesPorTipoFactura)) ?>, // Etiquetas: tipos de factura
          datasets: [{
            label: 'Cantidad',
            data: <?= json_encode(array_values($totalesPorTipoFactura)) ?>, // Datos: número de facturas por tipo
            backgroundColor: '#0d6efd' // Color principal para las barras
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, 
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false }, // Oculta la leyenda (solo una serie de datos)
            title: { display: true, text: 'Tipos de Factura', font: { size: 12 } }
          },
          scales: {
            x: { ticks: { font: { size: 9 } } }, // Tamaño de texto en eje X
            y: { beginAtZero: true, ticks: { font: { size: 9 } } } // Escala desde 0
          }
        }
      });
    }

    // === Formas de Pago ===
// Este gráfico de barras muestra cuántas facturas se han pagado según el método utilizado (Ej: Efectivo, Tarjeta, Transferencia, etc.)
    const ctxFactPago = document.getElementById('graficoFacturasPago');
    if (ctxFactPago) {
      new Chart(ctxFactPago, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_keys($totalesPorPagoFactura)) ?>, // Etiquetas: métodos de pago
          datasets: [{
            label: 'Cantidad',
            data: <?= json_encode(array_values($totalesPorPagoFactura)) ?>, // Datos: número de facturas por método de pago
            backgroundColor: '#20c997' // Color distintivo para este gráfico
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          layout: { padding: { top: 5, bottom: 5 } },
          plugins: {
            legend: { display: false }, // Oculta leyenda
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
// Este bloque genera un gráfico de barras que muestra la cantidad de PQRS según su tipo (Ej: Petición, Queja, Reclamo, Sugerencia)
const ctxTipoPqrs = document.getElementById('graficoTipoPqrs');
if (ctxTipoPqrs) {
  new Chart(ctxTipoPqrs, {
    type: 'bar', // Tipo de gráfico: barras verticales
    data: {
      labels: <?= json_encode($graficoTipoPqrs['labels']) ?>, // Etiquetas del eje X: tipos de PQRS
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoTipoPqrs['datos']) ?>, // Cantidad de PQRS por tipo
        backgroundColor: '#4e73df' // Color de las barras
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // Permite que el gráfico se ajuste a su contenedor
      plugins: {
        title: {
          display: true,
          text: 'PQRS por Tipo', // Título del gráfico
          font: { size: 14 }
        },
        legend: { display: false } // No se muestra leyenda ya que solo hay una serie de datos
      }, 
      scales: {
        x: { ticks: { font: { size: 9 } } }, // Estilo de las etiquetas del eje X
        y: { beginAtZero: true, ticks: { font: { size: 9 } } } // Escala desde 0 en el eje Y
      }
    }
  });
}

// === PQRS por Estado ===
// Este bloque genera un gráfico tipo "doughnut" que representa la distribución de PQRS según su estado (Ej: Abierta, En proceso, Cerrada, etc.)
const ctxEstadoPqrs = document.getElementById('graficoEstadoPqrs');
if (ctxEstadoPqrs) {
  new Chart(ctxEstadoPqrs, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($graficoEstadoPqrs['labels']) ?>, // Estados de las PQRS
      datasets: [{
        data: <?= json_encode($graficoEstadoPqrs['datos']) ?>, // Cantidad por estado
        backgroundColor: ['#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6f42c1']  // Colores por estado
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '70%', // Grosor del centro del gráfico doughnut
      plugins: {
        legend: {
          position: 'bottom', // Leyenda debajo del gráfico
          labels: { font: { size: 10 } }
        },
        title: {
          display: true,
          text: 'Estado de PQRS', // Título del gráfico
          font: { size: 12 }
        }
      }
    }
  });
}

// === PQRS por Mes ===
// Gráfico de barras que muestra la cantidad de PQRS registradas en cada mes.
const ctxMesPqrs = document.getElementById('graficoMesPqrs');
if (ctxMesPqrs) {
  new Chart(ctxMesPqrs, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoMesPqrs['labels']) ?>, // Meses (ej: Enero, Febrero...)
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoMesPqrs['datos']) ?>, // Cantidades por mes
        backgroundColor: '#20c997' // Color de las barras
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
// Gráfico de barras que muestra los usuarios que han generado más PQRS.
const ctxUsuarioPqrs = document.getElementById('graficoUsuarioPqrs');
if (ctxUsuarioPqrs) {
  new Chart(ctxUsuarioPqrs, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoUsuarioPqrs['labels']) ?>, // Nombres de usuarios
      datasets: [{
        label: 'PQRS',
        data: <?= json_encode($graficoUsuarioPqrs['datos']) ?>, // Total de PQRS por usuario
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
// Gráfico tipo doughnut que muestra el estado actual de las ofertas (activas, inactivas, vencidas).
const ctxEstadoOferta = document.getElementById('graficoEstadoOferta');
if (ctxEstadoOferta) {
  new Chart(ctxEstadoOferta, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($graficoEstadoOferta['labels']) ?>,
      datasets: [{
        data: <?= json_encode($graficoEstadoOferta['datos']) ?>,
        backgroundColor: ['#198754', '#dc3545', '#ffc107'] // Colores por estado
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '70%', // Grosor del centro del doughnut
      plugins: {
        legend: { position: 'bottom', labels: { font: { size: 10 } } },
        title: { display: true, text: 'Ofertas por Estado', font: { size: 12 } }
      }
    }
  });
}

// === Ofertas por Mes ===
// Gráfico de barras que indica cuántas ofertas se registraron cada mes.
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
// Gráfico de barras que muestra la cantidad de ofertas agrupadas por rangos de descuento aplicados.
const ctxRangoDescuento = document.getElementById('graficoRangoDescuento');
if (ctxRangoDescuento) {
  new Chart(ctxRangoDescuento, {
    type: 'bar',
    data: {
      labels: <?= json_encode($graficoRangoDescuento['labels']) ?>, // Ej: 0-10%, 11-20%, etc.
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
      type: 'bar', // Tipo de gráfico: barra
      data: {
        labels: labels, // Etiquetas del eje X (por ejemplo: meses, estados, ciudades)
        datasets: [{
          label: label, // Etiqueta para la leyenda del conjunto de datos
          backgroundColor: '#04ebec', // Color de las barras
          borderColor: '#0b4454', // Color del borde de las barras
          borderWidth: 1, // Grosor del borde
          data: datos // Valores numéricos por cada etiqueta
        }]
      },
      options: {
        responsive: true, // Hace que el gráfico se adapte al tamaño del contenedor
        plugins: {
          legend: { display: false } // Oculta la leyenda ya que solo hay un dataset
        },
        scales: {
          y: { beginAtZero: true } // El eje Y empieza en 0
        } 
      }
    });
  };


    

  // 📦 Envíos por Estado (Ej: Entregado, En proceso, Cancelado, etc.)
  renderBarChart('graficoEstadoEnvio', <?= json_encode($graficoEstadoEnvio['labels']) ?>, <?= json_encode($graficoEstadoEnvio['datos']) ?>);
  // 📆 Envíos por Mes (Cantidad de envíos realizados cada mes)
  renderBarChart('graficoMesEnvio', <?= json_encode($graficoMesEnvio['labels']) ?>, <?= json_encode($graficoMesEnvio['datos']) ?>);
  // 🌍 Envíos por Ciudad (Distribución de envíos según ciudad de destino)
  renderBarChart('graficoCiudadEnvio', <?= json_encode($graficoCiudadEnvio['labels']) ?>, <?= json_encode($graficoCiudadEnvio['datos']) ?>);


  function closepreload(){
    setTimeout(() => {
      document.getElementById("preloadId").style.display = "none";
    }, 2000);
  }

</script>


  </body>

</html>