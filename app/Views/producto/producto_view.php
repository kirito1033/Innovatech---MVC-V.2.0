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
      <?php require_once("../app/Views/producto/table.php")?>
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
          <?php require_once("../app/Views/producto/form.php") ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-primary" id="btnSubmit">Send Data</button>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="modalImagenProducto" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formImagenProducto" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Actualizar Imagen del Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="productoIdImagen">
          <div class="mb-3">
            <label for="imagen" class="form-label">Selecciona una imagen</label>
            <input class="form-control" type="file" name="imagen" id="imagenInput" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Subir Imagen</button>
        </div>
      </div>
    </form>
    
  </div>
</div>

    <?php require_once("../app/Views/assets/js/js.php") ?>
    <?php require_once("../app/Views/assets/js/dataTable.php") ?>
    <script>
    const UPLOAD_URL = "<?= base_url('productos/uploadImage') ?>";
    </script>
    <script src="<?=base_url("controllers/producto/producto.js") ?>"></script>

  </body>
<script>
function showImageModal(id) {
  document.getElementById('productoIdImagen').value = id;
  document.getElementById('imagenInput').value = "";
  const modal = new bootstrap.Modal(document.getElementById('modalImagenProducto'));
  modal.show();
}

document.getElementById("formImagenProducto").addEventListener("submit", function(e) {
    e.preventDefault();
    const form = document.getElementById("formImagenProducto");
    const formData = new FormData(form);

    fetch("<?= base_url('producto/updateImage') ?>", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.message === "success") {
            alert("Imagen actualizada correctamente.");
            location.reload(); // opcional para ver el cambio
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error("Error al subir imagen:", err);
    });
});

</script>
</html>