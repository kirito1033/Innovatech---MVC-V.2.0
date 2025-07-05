<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuraciones de codificación y escalado en dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de estilos personalizados desde una vista compartida -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos de DataTables para manejo de tablas dinámicas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload de carga inicial del sistema -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación principal -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de contenido -->
		<div class="container">
      <!-- Título de la vista -->
      <h3><?= $title?></h3>
      		 <!-- Botón que abre un modal para subir una factura -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSubirFactura" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
      <?php require_once("../app/Views/ingresoproducto/table.php")?>
    </div>
		
    <!-- Modal para registrar o editar un ingreso de producto -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <!-- Cabecera del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
           <!-- Formulario de ingreso de producto -->
					<div class="modal-body">
          <?php require_once("../app/Views/ingresoproducto/form.php") ?>
        </div>
        <!-- Botones de acción del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal para subir una factura en formato archivo (PDF o imagen) -->
<div class="modal fade" id="modalSubirFactura" tabindex="-1" aria-labelledby="modalSubirFacturaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Formulario para subir factura -->
    <form action="<?= base_url('ingresoproducto/subirFactura') ?>" method="post" enctype="multipart/form-data" class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalSubirFacturaLabel">Subir Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <!-- Cuerpo del modal con los campos -->
      <div class="modal-body">
        <!-- Campo: nombre que identifica la factura -->
        <div class="mb-3">
           <label for="nombre_factura">Nombre Factura</label>
        <input type="text" class="form-control" id="nombre_factura" name="nombre_factura" placeholder="Nombre factura">
       
     </div>
     <!-- Campo: carga del archivo PDF o imagen -->
        <div class="mb-3">
          <label for="factura_file" class="form-label">Archivo de la factura (PDF o imagen)</label>
          <input type="file" name="factura_file" class="form-control" accept=".pdf,.jpg,.png" required>
        </div>
        <!-- Campo: selección del usuario relacionado -->
        <div class="mb-3">
          <label for="usuario_id" class="form-label">Usuario</label>
          <select name="usuario_id" class="form-select" required>
            <?php foreach ($usuario as $u): ?>
              <option value="<?= $u['id_usuario'] ?>"><?= $u['primer_nombre'] . ' ' . $u['primer_apellido'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- Botones del modal -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Subir Factura</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

    <!-- Inclusión de scripts JS comunes y configuración de DataTables -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico para manejar lógica de ingreso de producto -->
    <script src="<?=base_url("controllers/ingresoproducto/ingresoproducto.js") ?>"></script>

  </body>

</html>