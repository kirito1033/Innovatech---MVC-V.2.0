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

    <script src="<?=base_url("controllers/pedidoproveedor/pedidoproveedor.js") ?>"></script>

  </body>

<script>
  const URI_PEDIDOPROVEEDOR = '<?= base_url('pedidoproveedor') ?>';
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const selectFactura = document.getElementById('facturaSelect');
  const inputFactura = document.getElementById('inputFacturaSeleccionada');
  const btnUsar = document.getElementById('btnUsarFactura');
  const inputFacturaMain = document.getElementById('numero_factura');

  const modalFacturas = document.getElementById('modalFacturas');

  // Detectar cuando se muestra el modal usando Bootstrap Modal instance
  const observer = new MutationObserver(() => {
    if (modalFacturas.classList.contains('show')) {
      // Llamada al backend cuando el modal está visible
      fetch('<?= base_url('pedidoproveedor/listarFacturas') ?>', {
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
    }
  });

  observer.observe(modalFacturas, { attributes: true, attributeFilter: ['class'] });

  // Mostrar valor seleccionado en input
  selectFactura.addEventListener('change', () => {
    inputFactura.value = selectFactura.value;
  });

  // Usar la factura seleccionada y cerrar el modal
  btnUsar.addEventListener('click', () => {
    if (!selectFactura.value) {
      alert('Seleccione un número de factura');
      return;
    }

    inputFacturaMain.value = selectFactura.value;

    const modalInstance = bootstrap.Modal.getInstance(modalFacturas);
    modalInstance.hide();

    // Enviar correo automáticamente después de cerrar modal
    enviarFacturaPorCorreo(selectFactura.value);
  });

  function enviarFacturaPorCorreo(numeroFactura) {
    fetch(`<?= base_url('pedidoproveedor/enviarFacturaCorreo') ?>/${numeroFactura}`, {
      method: 'GET',
      headers: {
        "X-Requested-With": "XMLHttpRequest"
      }
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        alert("Factura enviada correctamente al proveedor.");
      } else {
        alert("Error al enviar la factura: " + data.message);
      }
    })
    .catch(err => {
      console.error(err);
      alert("Error al enviar la factura.");
    });
  }
});
</script>



</html>