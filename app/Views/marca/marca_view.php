<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica de codificación y responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS personalizados del proyecto -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Inclusión del CSS de DataTables para mejorar las tablas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título de la página dinámico -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Carga del componente visual de precarga (spinner, animación, etc.) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Inclusión de la barra de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal -->
		<div class="container">
      <h3><?= $title?></h3>
      <!-- Botón para abrir modal y crear nueva marca -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Tabla donde se listan las marcas existentes -->
      <?php require_once("../app/Views/marca/table.php")?>
    </div>
		
    <!-- Modal emergente para agregar/editar marca -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Cabecera del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal con el formulario -->
					<div class="modal-body">
          <?php require_once("../app/Views/marca/form.php") ?>
        </div>
        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de scripts JS generales del proyecto -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inclusión del script de configuración de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Inclusión del script específico para manejar las acciones del módulo de marcas -->
    <script src="<?=base_url("controllers/marca/marca.js") ?>"></script>

  </body>

</html>