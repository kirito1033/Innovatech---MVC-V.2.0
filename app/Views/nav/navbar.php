<?php
function getIcon($ruta) {
  $modulo = trim(basename($ruta), '/');
  switch ($modulo) {
    case '':
      return 'bi-house';
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
      return 'bi-folder2';
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
    }

    .sidebar {
      width: 250px;
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
    }

    .sidebar h2 {
      color: var(--Color--texto);
      border-bottom: 1px solid var(--bright-turquoise);
      padding-bottom: 5px;
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
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

   .container {
        width: 67%;
        margin: 0 auto; /* Centra horizontalmente */
        margin-left: 20%;
        padding: 1rem;
        background-color: #0f838c; /* Fondo blanco para separar visualmente */
        border-radius: 0.5rem; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra ligera */
    }

    @media (max-width: 768px) {
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
    padding-left: 0; /* Opcional: elimina el sangrado izquierdo */
    }
  </style>
</head>
<body>
  <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

  <div class="sidebar" id="sidebar">
  <h2>Módulos disponibles</h2>
  <ul>
    <?php foreach ($modulos as $modulo): ?>
        <li>
        <a href="<?= base_url($modulo['Ruta']) ?>">
            <i class="bi <?= getIcon($modulo['Ruta']) ?>"></i>
            <?= ucfirst(trim(basename($modulo['Ruta']), '/')) ?: 'Home' ?>
        </a>
        </li>
    <?php endforeach; ?>
    </ul>

    </div>

  <div class="main-content">
    <!-- Aquí va el contenido principal -->
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('active');
    }
  </script>
</body>
</html>
