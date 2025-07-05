<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusión de archivos CSS comunes -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos específicos para DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico de la página -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preloader mientras carga la interfaz -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal de la página -->
		<div class="container">
      <!-- Encabezado -->
      <h3><?= $title?></h3>
      <!-- Botón para abrir formulario de creación de pedido -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!--Container Table-->
      <?php require_once("../app/Views/pedidoproveedor/table.php")?>
      <!-- Botón que lanza modal de selección de factura -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFacturas">
      Enviar
    </button>
    </div>
		
    <!-- Modal para agregar o editar un pedido -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Formulario incluido dentro del modal -->
					<div class="modal-body">
          <?php require_once("../app/Views/pedidoproveedor/form.php") ?>
        </div>
        <!-- Botones del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal para seleccionar una factura y enviarla por correo -->
<div class="modal fade" id="modalFacturas" tabindex="-1" aria-labelledby="modalFacturasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalFacturasLabel">Seleccionar Número de Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <!-- Contenido del modal: selector de facturas -->
      <div class="modal-body">
        <!-- Select para listar facturas obtenidas desde backend -->
        <div class="mb-3">
          <label for="facturaSelect" class="form-label">Números de Factura</label>
          <select class="form-select" id="facturaSelect">
            <option value="">Cargando...</option>
          </select>
        </div>
        <!-- Input para mostrar la factura seleccionada -->
        <div class="mb-3">
          <label for="inputFacturaSeleccionada" class="form-label">Factura Seleccionada</label>
          <input type="text" class="form-control" id="inputFacturaSeleccionada" readonly>
        </div>
      </div>
      <!-- Botón para confirmar selección -->
      <div class="modal-footer">
        <button type="button" id="btnUsarFactura" class="btn btn-primary">Usar Factura</button>
      </div>
    </div>
  </div>
</div>

<!-- Inclusión de archivos JavaScript comunes -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script específico del módulo de pedido a proveedor -->
    <script src="<?=base_url("controllers/pedidoproveedor/pedidoproveedor.js") ?>"></script>

  </body>

  <!-- Definición de constante con la URL base del módulo -->
<script>
  const URI_PEDIDOPROVEEDOR = '<?= base_url('pedidoproveedor') ?>';
</script>
<!-- Lógica para cargar y usar una factura al mostrar el modal -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const selectFactura = document.getElementById('facturaSelect');
  const inputFactura = document.getElementById('inputFacturaSeleccionada');
  const btnUsar = document.getElementById('btnUsarFactura');
  const inputFacturaMain = document.getElementById('numero_factura');

  const modalFacturas = document.getElementById('modalFacturas');

  // Observa el cambio de clase del modal para saber si se abre
  const observer = new MutationObserver(() => {
    if (modalFacturas.classList.contains('show')) {
      // Cuando el modal se muestra, se hace petición AJAX al backend para obtener facturas
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

  // Actualiza el input con la factura seleccionada
  selectFactura.addEventListener('change', () => {
    inputFactura.value = selectFactura.value;
  });

  // Asigna la factura seleccionada al formulario principal y cierra el modal
  btnUsar.addEventListener('click', () => {
    if (!selectFactura.value) {
      alert('Seleccione un número de factura');
      return;
    }

    inputFacturaMain.value = selectFactura.value;

    const modalInstance = bootstrap.Modal.getInstance(modalFacturas);
    modalInstance.hide();

    // Enviar correo con la factura al proveedor
    enviarFacturaPorCorreo(selectFactura.value);
  });

   // Función para hacer fetch que notifica vía correo al proveedor
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