<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales del sistema -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos para DataTables (tabla interactiva) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload (pantalla de carga mientras se inicializa la vista) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal -->
		<div class="container">
      <h3><?= $title?></h3>
      <!-- Botón para abrir el formulario modal y registrar nueva relación Modelo-Rol -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Tabla con los registros existentes de modelo-rol -->
      <?php require_once("../app/Views/modelosrol/table.php")?>
    </div>
		
    <!-- Modal (ventana emergente) para agregar o editar modelo-rol -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Cabecera del modal con el título -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal: se carga el formulario dinámico -->
					<div class="modal-body">
          <?php require_once("../app/Views/modelosrol/form.php") ?>
        </div>
        <!-- Pie de página del modal con los botones de acción -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts comunes del proyecto (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Scripts para inicializar la tabla interactiva DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico que contiene la lógica JS de modelosrol (CRUD, validaciones, etc.) -->
    <script src="<?=base_url("controllers/modelosrol/modelosrol.js") ?>"></script>

  </body>

</html>