<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Define la codificación de caracteres y configuración de la vista en dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!-- Incluye los archivos CSS principales definidos por la aplicación -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    
    <!-- Importa los estilos de DataTables para aplicar a la tabla -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Establece el título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Incluye un componente visual de precarga -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Inserta la barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la vista -->
		<div class="container">
      <!-- Título de la página (dinámico) -->
      <h3><?= $title?></h3>

      <!-- Botón para abrir el formulario de nuevo departamento -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Carga la tabla que contiene la lista de departamentos -->
      <?php require_once("../app/Views/departamento/table.php")?>
    </div>
		
<!-- Modal para agregar o editar departamento -->
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
          <?php require_once("../app/Views/departamento/form.php") ?>
        </div>

        <!-- Pie del modal con botones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Carga los scripts generales de la aplicación (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Inicializa DataTables en la tabla cargada -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script JavaScript personalizado para manejar el CRUD de departamentos -->
    <script src="<?=base_url("controllers/departamento/departamento.js") ?>"></script>

  </body>

</html>