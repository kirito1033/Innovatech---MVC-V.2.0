<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Configuración básica de la página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Carga de estilos personalizados -->
    <?php require_once("../app/Views/assets/css/css.php") ?>
    <!-- Estilos de DataTables -->  
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Título dinámico -->
    <title><?= $title ?></title>
  </head>

  <body>
		<!-- Preload animación (puede mostrar una carga inicial) -->
		<?php require_once('../app/Views/preload/preload.php') ?>
		<!-- Barra de navegación -->
    <?php require_once("../app/Views/nav/navbar.php")?>
		<!-- Contenedor principal -->
		<div class="container">
      <h3><?= $title?></h3>
      <!-- Botón para abrir el modal de registro de oferta -->
      <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
			<!-- Tabla de ofertas -->
      <?php require_once("../app/Views/oferta/table.php")?>
    </div>
		
    <!-- Modal de formulario de oferta -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Encabezado del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Cuerpo del modal con el formulario de oferta -->
					<div class="modal-body">
          <?php require_once("../app/Views/oferta/form.php") ?>
        </div>
        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para subir imagen de oferta -->
  <div class="modal fade" id="modalImagenOferta" tabindex="-1" aria-labelledby="modalImagenOfertaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Formulario para actualizar imagen -->
      <form id="formImagenOferta" enctype="multipart/form-data" method="POST">
        <!-- Encabezado del modal -->
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="modalImagenOfertaLabel">Actualizar Imagen de la Oferta</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <input type="hidden" name="id" id="ofertaIdImagen">
          <div class="mb-3">
            <label for="imagenOfertaInput" class="form-label">Selecciona una imagen</label>
            <input class="form-control" type="file" name="imagen" id="imagenOfertaInput" accept="image/*" required>
          </div>
        </div>
         <!-- Pie del modal -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Scripts necesarios (Bootstrap, jQuery, DataTables, etc.) -->
    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>

    <!-- Script principal de lógica JS para CRUD de oferta -->
    <script src="<?=base_url("controllers/oferta/oferta.js") ?>"></script>

      <!-- Ruta base para cargar imagen de oferta (útil si se usa desde JS) -->
    <script>
const UPLOAD_URL = "<?= base_url('ofertas/uploadImage') ?>";
</script>

  </body>
   <!-- Script para mostrar y manejar el formulario de carga de imagen -->
  <script>
    // Abre el modal de imagen y asigna el ID de la oferta
function showImageModal(ofertaId) {
  document.getElementById('ofertaIdImagen').value = ofertaId;
  const modal = new bootstrap.Modal(document.getElementById('modalImagenOferta'));
  modal.show();
}

// Manejador del envío del formulario de imagen
document.getElementById("formImagenOferta").addEventListener("submit", function(e) {
  e.preventDefault();
  const form = document.getElementById("formImagenOferta");
  const formData = new FormData(form);

  fetch("<?= base_url('oferta/updateImage') ?>", {
    method: "POST",
    body: formData,
    headers: {
      "X-Requested-With": "XMLHttpRequest" // Indica que es una petición AJAX
    }
  })
  .then(res => res.json())
  .then(data => {
    if (data.message === "success") {
      alert("Imagen actualizada correctamente.");
      location.reload(); // Recarga la página para ver cambios
    } else {
      alert(data.message); // Muestra error del backend
    }
  })
  .catch(err => {
    console.error("Error al subir imagen:", err);
  });
});
</script>

</html>