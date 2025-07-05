<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración general de codificación y diseño responsivo -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de los estilos CSS del sistema (Bootstrap, íconos, etc.) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilo específico para tablas con DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

     <!-- Título dinámico de la pestaña -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Animación de carga mientras el sistema prepara la vista -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Menú de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal del contenido -->
		<div class="container">

    <!-- Título del módulo, cargado dinámicamente -->
      <h3><?= $title?></h3>

      <!-- Botón para abrir el modal de registro de nuevo estado PQRS -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla que muestra los registros del módulo -->
      <?php require_once("../app/Views/estadopqrs/table.php")?>
    </div>
		
    <!-- Modal Bootstrap para crear o editar un estado PQRS -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título dinámico y botón de cierre -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal que carga el formulario para ingreso o edición -->
					<div class="modal-body">
          <?php require_once("../app/Views/estadopqrs/form.php") ?>
        </div>
        <!-- Pie del modal con botones de cerrar o enviar datos -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts generales de JavaScript (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inicialización y configuración de la tabla DataTable -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script JS específico para el módulo EstadoPQRS -->
    <script src="<?=base_url("controllers/estadopqrs/estadopqrs.js") ?>"></script>
  </body>

</html>