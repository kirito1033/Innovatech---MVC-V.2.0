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
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  />
  <style>
    :root {
    --encabezados-piedepagina: #020f1f;
    --Color--texto: #ffffff;
    --bright-turquoise: #04ebec;
    --Color-enlaces-menu: #272727;
    --atoll: #0a6069;
    --blue-chill: #0f838c;
    --gossamer: #048d94;
    --tarawera: #0b4454;
    --ebony-clay: #2c3443;
    --gris-: #5a626b;
  }

  body {
    background-color: var(--encabezados-piedepagina);
    margin: 0;
    font-family: sans-serif;
    overflow-x: hidden;
  }

  .sidebar {
    width: 300px;
    background-color: var(--encabezados-piedepagina);
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    z-index: 1000;
    overflow-y: auto;
    transform: translateX(0); /* Valor por defecto */
  }

  .sidebar h2 {
    color: var(--Color--texto);
    border-bottom: 1px solid var(--bright-turquoise);
    padding-bottom: 5px;
    font-size: 1.5rem;
  }

  .sidebar a {
    display: block;
    color: var(--Color--texto);
    padding: 10px;
    text-decoration: none;
    border-radius: 4px;
    margin: 5px 0;
    transition: background-color 0.2s;
  }

  .sidebar a:hover {
    background-color: var(--blue-chill);
    color: var(--Color--texto);
  }

  .sidebar hr {
    border-color: var(--gris-);
  }

  .sidebar i {
    margin-right: 10px;
    color: var(--bright-turquoise);
  }

  .menu-toggle {
    display: none;
    position: fixed;
    top: 10px;
    left: 10px;
    background-color: var(--ebony-clay);
    color: var(--Color--texto);
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    z-index: 1100;
  }

  .main-content {
    margin-left: 300px;
    padding: 20px;
    transition: margin-left 0.3s ease;
  }

  .container {
    width: 78%;
    margin: 0 auto;
    margin-left: 20%;
    padding: 1rem;
    background-color: #0f838c;
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  h3 {
    width: 100%;
    padding: 0.9%;
    color: var(--bright-turquoise);
    font-weight: 500;
    font-size: 1.2rem;
    background-color: var(--tarawera);
    border: 1px solid #666;
    border-radius: 8px;
  }

  ::-webkit-scrollbar {
    width: 10px;
    height: 10px;
  }

  ::-webkit-scrollbar-track {
    background: var(--tarawera);
    border-radius: 10px;
  }

  ::-webkit-scrollbar-thumb {
    background-color: var(--bright-turquoise);
    border-radius: 10px;
    border: 2px solid var(--tarawera);
  }

  ::-webkit-scrollbar-thumb:hover {
    background-color: var(--gossamer);
  }

  * {
    scrollbar-width: thin;
    scrollbar-color: var(--bright-turquoise) var(--tarawera);
  }

  ul {
    list-style: none;
    padding-left: 0;
  }

  .login__logo img {
    width: 200px;
  }

  .grupo {
    margin-bottom: 10px;
  }

  .grupo-toggle {
    width: 100%;
    background-color: transparent;
    color: var(--Color--texto);
    border: none;
    font-size: 1.3rem;
    font-weight: 500;
    text-align: left;
    padding: 10px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .grupo-toggle i {
    transition: transform 0.3s ease;
  }

  .grupo-toggle.active i {
    transform: rotate(180deg);
  }

  .grupo-list {
    list-style: none;
    padding-left: 15px;
    margin: 0;
    display: none;
    font-size: 1.1rem;
  }

  .grupo-list.show {
    display: block;
  }

  /* ================= RESPONSIVE ================= */
  @media (max-width: 1212px) {
    .sidebar {
      transform: translateX(-100%);
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .main-content {
      margin-left: 0;
    }

    .menu-toggle {
      display: block;
    }

    .container {
      width: 95%;
      margin-left: auto;
      margin-right: auto;
    }
  }
  </style>
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
