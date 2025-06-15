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
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!--Container Table-->
      <?php require_once("../app/Views/pedidoproveedor/table.php")?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFacturas">
      Enviar
    </button>
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
          <?php require_once("../app/Views/pedidoproveedor/form.php") ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modalFacturas" tabindex="-1" aria-labelledby="modalFacturasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFacturasLabel">Seleccionar Número de Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="facturaSelect" class="form-label">Números de Factura</label>
          <select class="form-select" id="facturaSelect">
            <option value="">Cargando...</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="inputFacturaSeleccionada" class="form-label">Factura Seleccionada</label>
          <input type="text" class="form-control" id="inputFacturaSeleccionada" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUsarFactura" class="btn btn-primary">Usar Factura</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <script src="../controllers/pedidoproveedor/pedidoproveedor.js"></script>
  </body>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const selectFactura = document.getElementById('facturaSelect');
  const inputFactura = document.getElementById('inputFacturaSeleccionada');
  const btnUsar = document.getElementById('btnUsarFactura');

  // Cuando el modal se abre, cargar las facturas
  const modalFacturas = document.getElementById('modalFacturas');
  modalFacturas.addEventListener('show.bs.modal', () => {
    fetch(URI_PEDIDOPROVEEDOR + '/listarFacturas', {
      headers: {
        "X-Requested-With": "XMLHttpRequest"
      }
    })
    .then(res => res.json())
    .then(data => {
      selectFactura.innerHTML = '<option value="">Seleccione una factura</option>';
      data.forEach(factura => {
        const opt = document.createElement('option');
        opt.value = factura.numero_factura;
        opt.textContent = `Factura #${factura.numero_factura}`;
        selectFactura.appendChild(opt);
      });
    })
    .catch(error => {
      selectFactura.innerHTML = '<option value="">Error al cargar</option>';
      console.error(error);
    });
  });

  // Al seleccionar una factura, mostrarla en el input
  selectFactura.addEventListener('change', () => {
    inputFactura.value = selectFactura.value;
  });

  // Al hacer clic en "Usar Factura"
  btnUsar.addEventListener('click', () => {
    if (!selectFactura.value) {
      alert('Seleccione un número de factura');
      return;
    }

    // Aquí puedes hacer lo que quieras con el número seleccionado
    // Por ejemplo, pasarlo al input del formulario principal:
    document.getElementById('numero_factura').value = selectFactura.value;

    // Cerrar modal
    const modalInstance = bootstrap.Modal.getInstance(modalFacturas);
    modalInstance.hide();
  });
});
</script>

</html>