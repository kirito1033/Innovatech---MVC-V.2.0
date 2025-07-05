<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración de codificación de caracteres y diseño responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de hojas de estilo comunes del sistema -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilo de DataTables (plugin para mejorar tablas HTML) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Spinner de carga (se muestra mientras se cargan datos o la vista) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación del sistema -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la vista -->
		<div class="container">
      <!-- Título dinámico según el contexto de la vista -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar un nuevo registro (icono de usuario con "+" al hacer clic ejecuta función JS `add()`) -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla principal que muestra los datos PQRS -->
      <?php require_once("../app/Views/pqrs/table.php")?>
    </div>
		
<!-- Modal para agregar o editar datos PQRS -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título y botón de cierre -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal que incluye el formulario para PQRS -->
					<div class="modal-body">
          <?php require_once("../app/Views/pqrs/form.php") ?>
        </div>
        <!-- Pie del modal con botones para cerrar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Archivos JavaScript compartidos del sistema (ej. Bootstrap, jQuery) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Script de inicialización de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico para manejar lógica de PQRS (crear, editar, eliminar) -->
    <script src="<?=base_url("controllers/pqrs/pqrs.js") ?>"></script>

  </body>

</html>