<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <!-- Configuración de vista para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de archivos CSS personalizados -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- DataTables CSS para estilos de tabla -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload (pantalla de carga) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal -->
		<div class="container">
      <!-- Título dinámico -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar nuevo registro (abre modal) -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla de garantías -->
      <?php require_once("../app/Views/garantia/table.php")?>
    </div>
		
    <!-- Modal para formulario de garantía -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título y botón de cierre -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal con el formulario incluido -->
					<div class="modal-body">
          <?php require_once("../app/Views/garantia/form.php") ?>
        </div>
        <!-- Pie del modal con botones para cerrar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Botón para enviar el formulario con id="my-form" -->
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de scripts JS generales (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inicialización de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script principal de lógica JS para garantías -->
    <script src="<?=base_url("controllers/garantia/garantia.js") ?>"></script>

  </body>

</html>