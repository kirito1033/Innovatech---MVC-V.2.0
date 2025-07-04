<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración de codificación y adaptación a dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales desde archivo centralizado -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Inclusión de los estilos de DataTables para dar formato y funcionalidades a las tablas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preloader: animación o pantalla de carga mientras se carga el contenido -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación principal del sitio -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de contenido -->
		<div class="container">
      <!-- Encabezado con el título dinámico de la vista -->
      <h3><?= $title?></h3>

       <!-- Botón para abrir el modal de registro, llama a la función JS 'add()' -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla que muestra los estados de factura -->
      <?php require_once("../app/Views/estadofactura/table.php")?>
    </div>
		
    <!-- Modal Bootstrap para registrar o editar un estado de factura -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título dinámico -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal con el formulario de ingreso o edición -->
					<div class="modal-body">
          <?php require_once("../app/Views/estadofactura/form.php") ?>
        </div>
        <!-- Pie del modal con botones para cerrar o enviar -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Inclusión de scripts JS comunes del sistema (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inicialización de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script JavaScript específico para manejar lógica de la vista "estadofactura" -->
    <script src="<?=base_url("controllers/estadofactura/estadofactura.js") ?>"></script>

  </body>

</html>