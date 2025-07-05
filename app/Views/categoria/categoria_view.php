<!DOCTYPE html>
<html lang="en">

  <head>
     <!-- Define la codificación de caracteres -->
    <meta charset="UTF-8">
    <!-- Hace que la vista sea responsive en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Carga los estilos generales del sistema (Bootstrap, custom CSS, etc.) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>

    <!-- Carga los estilos de DataTables para la tabla -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

     <!-- Título dinámico del documento (usado también en el encabezado) -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload (pantalla de carga o animación inicial) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la página -->
		<div class="container">
      <!-- Título dinámico (por ejemplo: "Categorías") -->
      <h3><?= $title?></h3>
      
      <!-- Botón para abrir el formulario de agregar nueva categoría -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			
      <!-- Sección que contiene la tabla de categorías -->
      <?php require_once("../app/Views/categoria/table.php")?>
    </div>
		
    <!-- Modal de formulario para agregar/editar categoría -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Cuerpo del modal: contiene el formulario de categoría -->
					<div class="modal-body">
          <?php require_once("../app/Views/categoria/form.php") ?>
        </div>

        <!-- Pie del modal con botones de cerrar y enviar -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Scripts JS globales (Bootstrap, funciones generales) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>

    <!-- Inicialización y configuración de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>
    
    <!-- Script específico para manejar las acciones JS de la categoría -->
    <script src="<?=base_url("controllers/categoria/categoria.js") ?>"></script>
  </body>

</html>