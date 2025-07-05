<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de hojas de estilo comunes del sistema -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos para el plugin DataTables (tablas interactivas) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico definido por el controlador -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload de la aplicación (pantalla de carga inicial) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
    <!-- Barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la vista -->
		<div class="container">

    <!-- Encabezado dinámico de la página -->
      <h3><?= $title?></h3>

      <!-- Botón para abrir el formulario modal y agregar nuevo registro -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Tabla de datos (importada desde vista específica) -->
      <?php require_once("../app/Views/apiuser/table.php")?>
    </div>
		
<!-- Modal Bootstrap para crear/editar un usuario -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

        <!-- Encabezado del modal con título y botón para cerrar -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Cuerpo del modal que contiene el formulario de entrada -->
					<div class="modal-body">
          <?php require_once("../app/Views/apiuser/form.php") ?>
        </div>

        <!-- Pie del modal con botones para cerrar o enviar datos -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts base del sistema (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Script para activar DataTables (buscador, paginación, etc.) -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico para gestionar la lógica de usuarios que usan API -->
    <script src="<?=base_url("controllers/apiuser/apiuser.js") ?>"></script>

  </body>

</html>