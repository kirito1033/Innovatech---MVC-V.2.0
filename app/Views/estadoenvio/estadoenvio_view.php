<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración de codificación de caracteres y escala en dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales del sistema -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
     <!-- Inclusión del estilo de DataTables para tablas interactivas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

      <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preloader (pantalla de carga mientras se renderiza el contenido) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación (menú superior del sitio) -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		 <!-- Contenedor principal del contenido -->
		<div class="container">
      <!-- Título principal dinámico -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar un nuevo elemento, dispara la función JavaScript `add()` -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			
       <!-- Inclusión de la tabla que muestra los datos -->
      <?php require_once("../app/Views/estadoenvio/table.php")?>
    </div>
		
    <!-- Modal Bootstrap para crear o editar elementos -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título dinámico -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Cuerpo del modal, incluye el formulario para el estado de envío -->
					<div class="modal-body">
          <?php require_once("../app/Views/estadoenvio/form.php") ?>
        </div>

        <!-- Pie del modal con botones de cerrar y enviar datos -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de scripts JS comunes del proyecto -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inclusión de la configuración de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Inclusión del archivo JS específico para la lógica de "estadoenvio" -->
    <script src="<?=base_url("controllers/estadoenvio/estadoenvio.js") ?>"></script>

  </body>

</html>