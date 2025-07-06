
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Configuración básica de codificación y adaptabilidad -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Inclusión de estilos CSS comunes del proyecto -->
  <?php require_once("../app/Views/assets/css/css.php") ?>

  <!-- Bootstrap 5: Framework CSS para diseño responsive -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables: Estilos para tablas dinámicas -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- Estilos personalizados del proyecto -->
  <link href="../assets/css/style.css" rel="stylesheet">
  
  <!-- Librería MD5: usada para generar hashes si se necesita en formularios -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>

  <!-- Título del documento -->
  <title>Notas credito</title>
</head>

<body>
  <!-- Pantalla de carga inicial (preloader) -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!-- Menú de navegación principal -->
  <?php require_once("../app/Views/nav/navbar.php") ?>

  <!-- Contenedor principal -->
  <div class="container">
    <title>Notas credito</title>

    <!-- Botón para agregar una nueva nota crédito (abre el modal) -->
    <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
    <!-- Tabla que muestra las notas crédito existentes -->
    <?php require_once("../app/Views/facturas/tableNotas.php") ?>
     


   <!-- Modal para crear o editar una nota crédito -->
  <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecera del modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel">Notas credito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Cuerpo del modal con el formulario -->
        <div class="modal-body">
          <?php require_once("../app/Views/facturas/formNotas.php") ?>
        </div>
      </div>
    </div>
  </div>

<!-- Scripts personalizados del sistema -->
  <?php require_once("../app/Views/assets/js/js.php") ?>

  <!-- jQuery para manipulación del DOM y AJAX -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap Bundle JS para modales y componentes dinámicos -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS para funcionalidades de tabla -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <!-- Script principal -->
  <script>
  $(document).ready(function () {
    // Inicializa DataTable en español
    $('#table-index').DataTable({
      responsive: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });
  });

  // Abre el modal para agregar una nueva nota crédito
  function add() {
    var modal = new bootstrap.Modal(document.getElementById('my-modal'));
    modal.show();

  }
</script>


</body>

</html>
