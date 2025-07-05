
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Configuración del documento -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Inclusión de archivos CSS desde vistas del proyecto (puede contener estilos personalizados o librerías) -->
  <?php require_once("../app/Views/assets/css/css.php") ?>

  <!-- Bootstrap 5 para estilos responsive -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables para tablas dinámicas con paginación, búsqueda y orden -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- Estilos personalizados del sistema -->
  <link href="../assets/css/style.css" rel="stylesheet">
  
  <!-- Librería para generar hashes MD5 (si se requiere en alguna parte del sistema) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
  
  <!-- Librerías para exportar a Excel y PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- PDFMake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

  <!-- Título de la página (dinámico) -->
  <title><?= $title ?></title>
</head>

<body>
  <!-- Carga pantalla de carga -->
  <?php require_once('../app/Views/preload/preload.php') ?>
  <!-- Barra de navegación -->
  <?php require_once("../app/Views/nav/navbar.php") ?>

  <!-- Contenedor principal -->
  <div class="container">
    <!-- Título de la vista -->
    <h3><?= $title ?></h3>

    <!-- Botón para agregar nueva factura (abre modal) -->
    <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;"><img src ="../assets/img/icons/person-add.svg" style="color: white" ></button>
    <!-- Inclusión de la tabla de facturas -->
    <?php require_once("../app/Views/facturas/table.php") ?>

    <!-- Botones para exportar -->
    <div class="d-flex justify-content-center my-3 gap-2">
    <button id="export-excel" class="btn btn-success">
      <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
    </button>
    <button id="export-pdf" class="btn btn-danger">
      <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF
    </button>
  </div>


  <!-- Modal para agregar o editar facturas -->
  <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Encabezado del modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Cuerpo del modal con el formulario -->
        <div class="modal-body">
          <?php require_once("../app/Views/facturas/form.php") ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Inclusión de archivos JS personalizados -->
  <?php require_once("../app/Views/assets/js/js.php") ?>

  <!-- jQuery y Bootstrap necesarios para DataTables y el funcionamiento del modal -->
  
  <!-- jQuery 3.5.1 compatible con DataTables 1.10.21 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- Inicialización de DataTable con datos desde el servidor -->
  <script>
   $(document).ready(function() {
  $('#table-index').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "<?= base_url('facturas/ajaxData') ?>",
          type: "POST"
      },
      columns: [
          { data: "number" },
          { data: "names" },
          { data: "identification" },
          { data: "total", render: function(data) {
              return "$" + parseFloat(data).toFixed(2);
          }},
          { data: "status", render: function(data) {
              return data == 1 ? "Válida" : "Pendiente";
          }},
          { data: "document_name" },
          { data: "payment_form_name" },
          { data: "acciones", orderable: false, searchable: false }
      ],
      language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
      }
  });
});

// Función para abrir el modal y generar un nuevo código de referencia
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

    // Inicializa el código de referencia en localStorage si no existe
  if (!localStorage.getItem('last_reference_code')) {
    localStorage.setItem('last_reference_code', 'I900');
  }

  // Genera el siguiente código incremental de referencia (ej. I901, I902...)
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

  <!-- Funciones para exportar la tabla a Excel y PDF -->
<script>
  // Exportación a Excel: genera un archivo ZIP que contiene el CSV
document.getElementById('export-excel').addEventListener('click', function () {
  fetch("<?= base_url('facturas/todasExcel') ?>")
    .then(res => res.json())
    .then(data => {
      const zip = new JSZip();
      let csv = 'Número,Cliente,Identificación,Total,Estado,Tipo,Forma de Pago\n';

      data.forEach(f => {
        const estado = f.status == 1 ? 'Válida' : 'Pendiente';
        csv += `${f.number},${f.names},${f.identification},${f.total},${estado},${f.document.name},${f.payment_form.name}\n`;
      });

      zip.file("facturas.csv", csv);
      zip.generateAsync({ type: "blob" }).then(content => {
        const a = document.createElement("a");
        a.href = URL.createObjectURL(content);
        a.download = "facturas.zip";
        a.click();
      });
    });
});

// Exportación a PDF con orientación horizontal
document.getElementById('export-pdf').addEventListener('click', function () {
  fetch("<?= base_url('facturas/todasExcel') ?>")
    .then(res => res.json())
    .then(data => {
      const body = [
        ['Número', 'Cliente', 'Identificación', 'Total', 'Estado', 'Tipo', 'Pago']
      ];
      data.forEach(f => {
        const estado = f.status == 1 ? 'Válida' : 'Pendiente';
        body.push([
          f.number, f.names, f.identification,
          "$" + Number(f.total).toLocaleString(),
          estado, f.document.name, f.payment_form.name
        ]);
      });

      pdfMake.createPdf({
        content: [
          { text: 'Listado de Facturas', style: 'header' },
          { table: { headerRows: 1, body } }
        ],
        styles: {
          header: { fontSize: 18, bold: true, margin: [0, 0, 0, 10] }
        },
        pageOrientation: 'landscape'
      }).download("facturas.pdf");
    });
});
</script>

</body>

</html>