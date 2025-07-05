<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica de caracteres y vista responsiva -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de archivos CSS comunes definidos en un archivo PHP externo -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Inclusión del estilo de DataTables para tablas dinámicas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <!-- Título de la página que se carga dinámicamente -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Sección de precarga visual durante la carga de la aplicación -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la página -->
		<div class="container">
      <!-- Título dinámico de la vista -->
      <h3><?= $title?></h3>

      <!-- Botón para agregar un nuevo registro, que llama a la función JavaScript `add()` -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla que muestra los registros de "envío" -->
      <?php require_once("../app/Views/envio/table.php")?>
    </div>
		
  <!-- Modal para agregar o editar datos -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con el título dinámico y botón de cierre -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal con el formulario incluido desde otro archivo -->
					<div class="modal-body">
          <?php require_once("../app/Views/envio/form.php") ?>
        </div>
        <!-- Pie del modal con botones para cerrar o enviar el formulario -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Inclusión de scripts JS comunes (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
     <!-- Inclusión del script para inicializar DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script principal de lógica para esta vista, que maneja eventos, AJAX, etc. -->
    <script src="<?=base_url("controllers/envio/envio.js") ?>"></script>

  </body>

</html>