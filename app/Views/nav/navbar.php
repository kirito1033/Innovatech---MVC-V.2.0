<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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

        body{
               background-color: #020f1f; /* Dark blue background for sidebar */
        }
        /* Estilos del Sidebar */
        .sidebar {
            width: 250px;
            background-color: #020f1f; /* Dark blue background for sidebar */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar h4, .sidebar h5 {
            color: var(--Color--texto); /* White text for headers */
            border-bottom: 1px solid var(--bright-turquoise); /* Bright turquoise for divider */
            padding-bottom: 5px;
        }

        .sidebar a {
            display: block;
            color: var(--Color--texto); /* White text for links */
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px 0;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: var(--blue-chill); /* Slightly lighter blue for hover */
            color: var(--Color--texto);
        }

        .sidebar hr {
            border-color: var(--gris-); /* Gray for horizontal rules */
        }

        .sidebar i {
            margin-right: 10px;
            color: var(--bright-turquoise); /* Bright turquoise for icons */
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            background-color: var(--ebony-clay); /* Darker background for toggle button */
            color: var(--Color--texto); /* White text */
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

         .container{
            background-color: var( --blue-chill);
            width: 80%;
            margin-left: 18%;
            margin-top: auto;
            padding: 0;
            border: 1px solid #666

         
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
        h3{
          
            width: 100%;
            padding: 0.9%;
            color: #04ebec;
            font-weight: 500;
            font-size: 1.2rem;
            background-color: #0b4454;
            border: 1px solid #666;
            border-radius: 8px; 
        }
        /* Scrollbar para navegadores WebKit (Chrome, Edge, Safari) */
        ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
        }

        ::-webkit-scrollbar-track {
        background: var(--tarawera); /* fondo del track */
        border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
        background-color: var(--bright-turquoise); /* scroll bar */
        border-radius: 10px;
        border: 2px solid var(--tarawera); /* opcional: borde interno */
        }

        ::-webkit-scrollbar-thumb:hover {
        background-color: var(--gossamer); /* hover del scroll */
        }

        /* Scrollbar para Firefox */
        * {
        scrollbar-width: thin;
        scrollbar-color: var(--bright-turquoise) var(--tarawera); /* thumb | track */
        }
       
      
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <h4 class="text-center my-3">Dashboard</h4>
        <a href="/"><i class="bi bi-house"></i> Home</a>
        <a href="/usuario"><i class="bi bi-people"></i> Usuarios</a>
        <a href="/rol"><i class="bi bi-shield-lock"></i> Roles</a>
        <a href="/permisos"><i class="bi bi-key"></i> Permisos</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Gestión</h5>
        <a href="/departamento"><i class="bi bi-building"></i> Departamentos</a>
        <a href="/ciudad"><i class="bi bi-geo-alt"></i> Ciudades</a>
        <a href="/estadousuario"><i class="bi bi-person-check"></i> Estado Usuarios</a>
        <a href="/tipodocumento"><i class="bi bi-file-earmark-text"></i> Tipos de Documento</a>
        <a href="/producto"><i class="bi bi-box"></i> Productos</a>
          <a href="/oferta"><i class="bi bi-megaphone"></i> Ofertas</a>
        <a href="/marca"><i class="bi bi-tag"></i> Marcas</a>
        <a href="/modelo"><i class="bi bi-boxes"></i> Modelos</a>
        <a href="/estadoproducto"><i class="bi bi-check-square"></i> Estado Productos</a>
        <a href="/color"><i class="bi bi-palette"></i> Colores</a>
        <a href="/categoria"><i class="bi bi-list-ul"></i> Categorías</a>
        <a href="/garantia"><i class="bi bi-shield-check"></i> Garantías</a>
        <a href="/almacenamiento"><i class="bi bi-hdd"></i> Almacenamiento</a>
        <a href="/almacenamientoaleatorio"><i class="bi bi-hdd-stack"></i> Almacenamiento Aleatorio</a>
        <a href="/sistemaoperativo"><i class="bi bi-gear-wide-connected"></i> Sistemas Operativos</a>
        <a href="/resolucion"><i class="bi bi-display"></i> Resoluciones</a>
        <a href="/ingresoproducto"><i class="bi bi-box-arrow-in-down"></i> Ingreso Productos</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">PQRS</h5>
        <a href="/tipopqrs"><i class="bi bi-question-circle"></i> Tipos PQRS</a>
        <a href="/estadopqrs"><i class="bi bi-info-circle"></i> Estado PQRS</a>
        <a href="/pqrs"><i class="bi bi-chat-dots"></i> PQRS</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Facturación y Envíos</h5>
        <a href="/estadoenvio"><i class="bi bi-truck"></i> Estado Envíos</a>
        <a href="/envio"><i class="bi bi-box-seam"></i> Envíos</a>
        <a href="/estadofactura"><i class="bi bi-receipt"></i> Estado Facturas</a>
        <a href="/factura"><i class="bi bi-file-earmark-ruled"></i> Facturas</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Módulos</h5>
        <a href="/userapi"><i class="bi bi-plug"></i> Usuarios API</a>
      

        <hr class="my-2">
        <h5 class="text-center mt-3">Configuración</h5>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo"><i class="bi bi-gear"></i> Configuración General</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo"><i class="bi bi-lock"></i> Seguridad</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo"><i class="bi bi-bell"></i> Notificaciones</a>
        <a href="/logout"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <!-- Aquí va el contenido de tu vista (tabla, etc.) -->
    </div>

</body>
</html>