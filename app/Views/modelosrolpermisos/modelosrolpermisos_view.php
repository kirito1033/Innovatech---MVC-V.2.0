<?php
// Verificamos si el usuario tiene permisos por ID directamente (usualmente IDs fijos)
// Esto se usa para condicionar qué acciones puede hacer el usuario en la vista actual.
$puedeVer = isset($permisos_usuario[1]); // Permiso para ver registros
$puedeEditar = isset($permisos_usuario[2]); // Permiso para editar registros
$puedeEliminar = isset($permisos_usuario[3]); // Permiso para eliminar registros
$puedeCrear = isset($permisos_usuario[4]); // Permiso para crear registros
?>

<!-- Página HTML de gestión de permisos por Modelo-Rol -->
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos CSS generales -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos para DataTables (tablas dinámicas) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico definido en el controlador -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload de carga (puede mostrar animaciones de carga inicial) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de contenido -->
		<div class="container">
      <!-- Título principal de la página -->
      <h3><?= $title?></h3>
      <!-- Botón de agregar nuevo (solo si tiene permiso de creación) -->
       <?php if ($puedeCrear): ?>
            <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
      <?php endif; ?>
      
			<!-- Carga de la tabla de registros -->
      <?php require_once("../app/Views/modelosrolpermisos/table.php")?>
    </div>
		
     <!-- Modal para crear/editar registros -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del formulario incluido desde archivo externo -->
					<div class="modal-body">
          <?php require_once("../app/Views/modelosrolpermisos/form.php") ?>
        </div>
        <!-- Footer con acciones de envío o cierre -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Botón que envía el formulario por ID -->
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts base comunes de JS (Bootstrap, jQuery, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <!-- Script de inicialización de DataTables -->
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script JS específico para el módulo actual (gestión modelos-roles-permisos) -->
    <script src="<?=base_url("controllers/modelosrolpermisos/modelosrolpermisos.js") ?>"></script>

  </body>

</html>