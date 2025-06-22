
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php require_once("../app/Views/assets/css/css.php") ?>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables 1.10.21 CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- Tu CSS personalizado -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>

  <title>Notas credito</title>
</head>

<body>
  <!-- Preload -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!-- Navbar -->
  <?php require_once("../app/Views/nav/navbar.php") ?>

  <!-- Container -->
  <div class="container">
    <title>Notas credito</title>
    <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
    <!-- Table -->
    <?php require_once("../app/Views/facturas/tableNotas.php") ?>
     


  <!-- Modal -->
  <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel">Notas credito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php require_once("../app/Views/facturas/formNotas.php") ?>
        </div>
      </div>
    </div>
  </div>


  <?php require_once("../app/Views/assets/js/js.php") ?>

  <!-- jQuery 3.5.1 compatible con DataTables 1.10.21 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


  <script>
  $(document).ready(function () {
    // Inicializar DataTables con español
    $('#table-index').DataTable({
      responsive: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });
  });

  // Función para abrir el modal y asignar un nuevo código
  function add() {
    var modal = new bootstrap.Modal(document.getElementById('my-modal'));
    modal.show();

  }
</script>


</body>

</html>
