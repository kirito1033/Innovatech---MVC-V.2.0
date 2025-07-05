<!-- Estilos de DataTables para tablas responsivas y estilizadas -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<!-- Estilos para los botones de exportación (Excel, PDF, Imprimir) -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- jQuery necesario para que DataTables funcione (versión completa, no slim) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Plugin principal de DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- Complementos de DataTables para botones de exportación -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- Librería JSZip para exportar a Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Librería pdfmake y fuentes necesarias para exportar a PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Inicialización de la tabla con ID "table-index" -->
<script>
  $(document).ready(function () {
    $('#table-index').DataTable({
      dom: 'frtipB',
      buttons: [
        {
          extend: 'excelHtml5',
          text: '📥 Exportar a Excel',
          className: 'btn-excel'
        },
        {
          extend: 'pdfHtml5',
          text: '📄 Exportar a PDF',
          className: 'btn-pdf',
          orientation: 'landscape', // Horizontal
          pageSize: 'A4', // Tamaño de hoja
          exportOptions: {
            columns: [0, 1, 2, 3, 4] // Columnas que se incluirán en la exportación
          }
        }
      ],
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json' // Traducción al español
      }
    });
  });
</script>
