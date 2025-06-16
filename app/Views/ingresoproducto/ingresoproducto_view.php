<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once("../app/Views/assets/css/css.php") ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <title><?= $title ?></title>
  </head>

  <body>
		<!--Preload-->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!--Navbar-->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!--Container-->
		<div class="container">
      <h3><?= $title?></h3>
      			<!--Container Table-->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSubirFactura" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
      <?php require_once("../app/Views/ingresoproducto/table.php")?>
    </div>
		<!--Footer-->

    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
					<div class="modal-body">
          <?php require_once("../app/Views/ingresoproducto/form.php") ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal para subir factura -->
<div class="modal fade" id="modalSubirFactura" tabindex="-1" aria-labelledby="modalSubirFacturaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('ingresoproducto/subirFactura') ?>" method="post" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSubirFacturaLabel">Subir Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
           <label for="nombre_factura">Nombre Factura</label>
        <input type="text" class="form-control" id="nombre_factura" name="nombre_factura" placeholder="Nombre factura">
       
     </div>
        <div class="mb-3">
          <label for="factura_file" class="form-label">Archivo de la factura (PDF o imagen)</label>
          <input type="file" name="factura_file" class="form-control" accept=".pdf,.jpg,.png" required>
        </div>
        <div class="mb-3">
          <label for="usuario_id" class="form-label">Usuario</label>
          <select name="usuario_id" class="form-select" required>
            <?php foreach ($usuario as $u): ?>
              <option value="<?= $u['id_usuario'] ?>"><?= $u['primer_nombre'] . ' ' . $u['primer_apellido'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Subir Factura</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <script src="../controllers/ingresoproducto/ingresoproducto.js"></script>
  </body>

</html>