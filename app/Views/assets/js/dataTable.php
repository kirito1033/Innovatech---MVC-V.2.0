<!-- Estilos de DataTables + botones -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- jQuery completo (NO slim) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- Botones para exportar -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- JSZip para Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake para PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Inicialización -->
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
          orientation: 'landscape',
          pageSize: 'A4',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }
      ],
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
      }
    });
  });
</script>
<style>
  .dt-buttons {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    gap: 10px;
    margin-left: 15%;
  }

  .btn-excel {
    background-color: #28a745 !important;
    color: white !important;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    
  }

  .btn-pdf {
    background-color: #dc3545 !important;
    color: white !important;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
  }
</style>
