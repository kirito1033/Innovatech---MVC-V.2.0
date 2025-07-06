<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales (propios del sistema) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Inclusión de estilos de DataTables para mejorar la visualización de la tabla -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la pestaña, pasado desde el controlador -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload (pantalla de carga, si existe una animación mientras carga) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal del contenido -->
		<div class="container">

    <!-- Encabezado con el título de la vista (ej. "Gestión de Colores") -->
      <h3><?= $title?></h3>

      <!-- Botón para abrir el formulario de creación de un nuevo color -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			
      <!-- Inclusión del archivo PHP que contiene la tabla de colores -->
      <?php require_once("../app/Views/color/table.php")?>
    </div>
		
  <!-- Modal para formulario (crear/editar color) -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <!-- Encabezado del modal con el título dinámico -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Cuerpo del modal con el formulario -->
					<div class="modal-body">
          <?php require_once("../app/Views/color/form.php") ?>
        </div>

        <!-- Pie del modal con los botones para cerrar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de scripts JS necesarios del sistema -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico de la lógica para este módulo (crear/editar/eliminar colores) -->
    <script src="<?=base_url("controllers/color/color.js") ?>"></script>

  </body>

</html>