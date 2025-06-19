
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

  <title><?= $title ?></title>
</head>

<body>
  <!-- Preload -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!-- Navbar -->
  <?php require_once("../app/Views/nav/navbar.php") ?>

  <!-- Container -->
  <div class="container">
    <h3><?= $title ?></h3>
    <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
    <!-- Table -->
    <?php require_once("../app/Views/facturas/table.php") ?>
      <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>


  <!-- Modal -->
  <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php require_once("../app/Views/facturas/form.php") ?>
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
      $('#table-index').DataTable({
        responsive: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
      });
    });
      function add() {
      var modal = new bootstrap.Modal(document.getElementById('my-modal'));
      modal.show();
      // Este ejemplo asume que tienes un input con ID reference_code
      const refInput = document.getElementById('reference_code');
      if (refInput) {
        refInput.value = getNextReferenceCode();
      }

      // Aquí puedes agregar más lógica que ejecutas al hacer clic en el botón "Add"
      console.log('Código generado:', refInput.value);
    }

  if (!localStorage.getItem('last_reference_code')) {
    localStorage.setItem('last_reference_code', 'I900');
  }

  function getNextReferenceCode() {
    let lastCode = localStorage.getItem('last_reference_code');

    // Obtener número actual y sumarle 1
    const currentNumber = parseInt(lastCode.substring(1)) + 1;
    const nextCode = 'I' + String(currentNumber).padStart(3, '0');

    // Guardar el nuevo código
    localStorage.setItem('last_reference_code', nextCode);
    return nextCode;
  }


  
  </script>

</body>

</html>