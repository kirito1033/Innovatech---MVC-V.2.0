<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica del documento HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales del sistema (Bootstrap, fuentes, íconos, etc.) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Hoja de estilos específica para DataTables (estilo de tablas interactivas) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página, asignado desde el backend (controlador) -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload: animación o pantalla de carga mientras se prepara la interfaz -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación del sistema -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal del contenido de la vista -->
		<div class="container">

    <!-- Título principal de la sección, cargado dinámicamente -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar un nuevo estado de producto, que llama a la función JavaScript `add()` -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			 <!-- Inclusión de la tabla con los estados de producto (vista parcial) -->
      <?php require_once("../app/Views/estadoproducto/table.php")?>
    </div>
		
  <!-- Modal Bootstrap: usado para mostrar el formulario de registro o edición -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <!-- Encabezado del modal con título dinámico y botón para cerrarlo -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
           <!-- Cuerpo del modal: incluye el formulario HTML del estado de producto -->
					<div class="modal-body">
          <?php require_once("../app/Views/estadoproducto/form.php") ?>
        </div>
        <!-- Pie del modal con botones para cancelar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de los scripts base del sistema: jQuery, Bootstrap, etc. -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Script de inicialización de DataTables (para hacer la tabla interactiva) -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico de este módulo: maneja acciones como agregar, editar, eliminar -->
    <script src="<?=base_url("controllers/estadoproducto/estadoproducto.js") ?>"></script>

  </body>

</html>