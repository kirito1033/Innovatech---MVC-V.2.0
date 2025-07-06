<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de hojas de estilo personalizadas (Bootstrap, FontAwesome, etc.) -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos específicos para DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título de la página dinámico -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Componente de precarga (loader de espera) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación superior -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la página -->
		<div class="container">
      <!-- Título dinámico -->
      <h3><?= $title?></h3>
      <!-- Botón para agregar un nuevo modelo -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Inclusión de la tabla de modelos -->
      <?php require_once("../app/Views/modelos/table.php")?>
    </div>
		
  <!-- Modal para agregar/editar modelos -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Cabecera del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal: formulario para el modelo -->
					<div class="modal-body">
          <?php require_once("../app/Views/modelos/form.php") ?>
        </div>
        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts generales del sistema -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Scripts específicos para manejar DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

     <!-- Script de lógica de control JS para la gestión de modelos -->
    <script src="<?=base_url("controllers/modelos/modelos.js") ?>"></script>

  </body>

</html>