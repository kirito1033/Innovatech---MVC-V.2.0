<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de archivos CSS comunes del proyecto (Bootstrap, estilos personalizados, etc.) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos específicos para DataTables (tabla interactiva con orden, búsqueda, paginación, etc.) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Componente de precarga (spinner o animación mientras se cargan los datos) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la página -->
		<div class="container">
      <!-- Título de la vista (dinámico según $title) -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar un nuevo registro. Al hacer clic, ejecuta la función `add()` -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			 <!-- Inclusión de la tabla de permisos (vista PHP con la estructura HTML de la tabla) -->
      <?php require_once("../app/Views/permisos/table.php")?>
    </div>
		
<!-- Modal Bootstrap para agregar o editar datos -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con el título y botón de cierre -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal: contiene el formulario de permisos -->
					<div class="modal-body">
          <?php require_once("../app/Views/permisos/form.php") ?>
        </div>
        <!-- Pie del modal: botones de cerrar y enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Archivos JavaScript comunes del proyecto (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Script específico para inicializar la tabla con DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script personalizado para la lógica de la vista de permisos -->
    <script src="<?=base_url("controllers/permisos/permisos.js") ?>"></script>

  </body>

</html>