<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Codificación y vista responsiva para dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS del sistema -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    
    <!-- Estilo para el plugin DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título de la página dinámico (pasado desde el controlador) -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preloader (pantalla de carga) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		
    <!-- Barra de navegación (Navbar) -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		
    <!-- Contenedor principal del contenido -->
		<div class="container">
      <!-- Título de la página -->
      <h3><?= $title?></h3>

      <!-- Botón para abrir el formulario modal (añadir nuevo registro) -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			
      <!-- Tabla de datos (se carga como vista PHP) -->
      <?php require_once("../app/Views/almacenamientoaleatorio/table.php")?>
    </div>
		
    <!-- Modal Bootstrap para el formulario de registro/edición -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal con título dinámico -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Cuerpo del modal que incluye el formulario -->
					<div class="modal-body">
          <?php require_once("../app/Views/almacenamientoaleatorio/form.php") ?>
        </div>

        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Scripts generales del sistema (jQuery, Bootstrap, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    
    <!-- Script para inicializar DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script personalizado para gestión de almacenamiento aleatorio (RAM) -->
    <script src="<?=base_url("controllers/almacenamientoaleatorio/almacenamientoaleatorio.js") ?>"></script>
  </body>

</html>