<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración general del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de archivos CSS compartidos (Bootstrap, íconos, estilos personalizados) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos específicos para DataTables (plugin para mejorar tablas HTML) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Sección de precarga (pantalla de carga inicial) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
    <!-- Barra de navegación principal del sistema -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor general del contenido -->
		<div class="container">

      <!-- Título de la vista, recibido dinámicamente desde el backend -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar nuevo estado, que activa la función JavaScript `add()` -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			 <!-- Inclusión de la tabla con los registros del modelo (vista parcial) -->
      <?php require_once("../app/Views/estadousuario/table.php")?>
    </div>
		
    <!-- Modal Bootstrap para mostrar el formulario (crear/editar) -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal: contiene el formulario -->
					<div class="modal-body">
          <?php require_once("../app/Views/estadousuario/form.php") ?>
        </div>
        <!-- Pie del modal: botones para cerrar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusión de scripts comunes: Bootstrap, jQuery, etc. -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inclusión del script para inicializar DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Inclusión del archivo JavaScript específico para este módulo -->
    <script src="<?=base_url("controllers/estadousuario/estadousuario.js") ?>"></script>

  </body>

</html>