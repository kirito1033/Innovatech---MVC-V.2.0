<?php
// Retorna un icono de Bootstrap Icons asociado a la ruta/módulo.
function getIcon($ruta) {
  // Extrae el último segmento de la ruta eliminando la barra final si existe.
  $modulo = trim(basename($ruta), '/');

  // Selecciona el ícono basado en el nombre del módulo
  switch ($modulo) {
    case '':
      return 'bi-house'; // Página principal
    case 'usuario':
      return 'bi-people';
    case 'rol':
      return 'bi-shield-lock';
    case 'permisos':
      return 'bi-key';
    case 'departamento':
      return 'bi-building';
    case 'ciudad':
      return 'bi-geo-alt';
    case 'estadousuario':
      return 'bi-person-check';
    case 'tipodocumento':
      return 'bi-file-earmark-text';
    case 'producto':
      return 'bi-box';
    case 'oferta':
      return 'bi-megaphone';
    case 'marca':
      return 'bi-tag';
    case 'modelo':
      return 'bi-boxes';
    case 'estadoproducto':
      return 'bi-check-square';
    case 'color':
      return 'bi-palette';
    case 'categoria':
      return 'bi-list-ul';
    case 'garantia':
      return 'bi-shield-check';
    case 'almacenamiento':
      return 'bi-hdd';
    case 'almacenamientoaleatorio':
      return 'bi-hdd-stack';
    case 'sistemaoperativo':
      return 'bi-gear-wide-connected';
    case 'resolucion':
      return 'bi-display';
    case 'ingresoproducto':
      return 'bi-box-arrow-in-down';
    case 'tipopqrs':
      return 'bi-question-circle';
    case 'estadopqrs':
      return 'bi-info-circle';
    case 'pqrs':
      return 'bi-chat-dots';
    case 'estadoenvio':
      return 'bi-truck';
    case 'envio':
      return 'bi-box-seam';
    case 'estadofactura':
      return 'bi-receipt';
    case 'factura':
      return 'bi-file-earmark-ruled';
    case 'userapi':
      return 'bi-plug';
    case 'logout':
      return 'bi-box-arrow-right';
       case 'modelorol':
      return 'bi-diagram-3';
    default:
      return 'bi-folder2'; // Ícono genérico por defecto
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- Carga los íconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
 
</head>
<body>
  <!-- Botón hamburguesa para activar el menú lateral en modo responsive -->
  <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

   <!-- SIDEBAR: Menú lateral izquierdo -->
  <div class="sidebar" id="sidebar">
    <!-- Logo de la empresa o aplicación -->
    <div class="login__logo text-center mb-4">
      <img src="../assets/img/logo.png" alt="Logo Innovatech">
    </div>

    <!--Agrupamiento y ordenamiento de módulos-->
    <?php
    $grupos = [];

    // Agrupar módulos por su clave 'grupo'
    foreach ($modulos as $modulo) {
      $grupo = $modulo['grupo'] ?? 'Sin grupo'; // Agrupa como 'Sin grupo' si no tiene asignado
      $grupos[$grupo][] = $modulo;
    }

    // Ordenar alfabéticamente los nombres de los grupos
    ksort($grupos);

    // Ordenar alfabéticamente los módulos dentro de cada grupo
    foreach ($grupos as &$modulosGrupo) {
      usort($modulosGrupo, function ($a, $b) {
        $nombreA = ucfirst(trim(basename($a['Ruta']), '/'));
        $nombreB = ucfirst(trim(basename($b['Ruta']), '/'));
        return strcasecmp($nombreA, $nombreB); // Comparación sin distinción entre mayúsculas/minúsculas
      });
    }
    unset($modulosGrupo); // Limpieza de referencia
    ?>

<!--Menú lateral dinámico por grupo-->
    <?php foreach ($grupos as $grupo => $modulosGrupo): ?>
      <div class="grupo">
        <!-- Título del grupo con botón desplegable -->
        <button class="grupo-toggle">
          <?= htmlspecialchars($grupo) ?>
          <i class="bi bi-chevron-down"></i>
        </button>
        <!-- Lista de módulos dentro del grupo -->
        <ul class="grupo-list">
          <?php foreach ($modulosGrupo as $modulo): ?>
            <li>
              <!-- Enlace al módulo con ícono dinámico -->
              <a href="<?= base_url($modulo['Ruta']) ?>" style="text-align: left;">
                <i class="bi <?= getIcon($modulo['Ruta']) ?>"></i>
                <?= ucfirst(trim(basename($modulo['Ruta']), '/')) ?: 'Home' ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>

    <hr style="border-color: var(--gris-); margin: 15px 0;">

    <!-- Enlaces al perfil y logout -->
    <ul style="list-style: none; padding-left: 15px;">
      <li>
        <a href="<?= base_url('/perfil') ?>" style="text-align: left;">
          <i class="bi bi-person-circle"></i> Perfil
        </a>
      </li>
      <li>
        <a href="<?= base_url('/logout') ?>" style="text-align: left;">
          <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
      </li>
    </ul>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <div class="main-content">
    <!-- Aquí va el contenido principal -->
  </div>

  <!-- SCRIPT TOGGLE -->
  <script>
    // Función para mostrar/ocultar la sidebar (en responsive)
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('active');
    }

    // Controla el despliegue de cada grupo
    document.addEventListener('DOMContentLoaded', () => {
      const toggles = document.querySelectorAll('.grupo-toggle');
      toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
          toggle.classList.toggle('active'); // Rota el ícono
          const list = toggle.nextElementSibling;
          list.classList.toggle('show'); // Muestra u oculta la lista
        });
      });
    });
  </script>
</body>
