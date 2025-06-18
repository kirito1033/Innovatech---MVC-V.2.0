

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?=base_url("/assets/css/pqrs.css") ?>" rel="stylesheet">  
    <style>
   
    </style>
</head>
<body>


<header>
<?= $this->include('partials/header') ?>
</header>

<main class="container">
    <form id="pqrsForm" class="formulario-pqrs" method="POST">
        <h1>Formulario PQRS</h1>

        <!-- Tipo de PQRS -->
        <div class="mb-3">
            <label for="tipo_pqrs_id" class="form-label">Tipo de PQRS</label>
            <select class="form-select" id="tipo_pqrs_id" name="tipo_pqrs_id" required>
                <option value="" disabled selected>Seleccione el tipo de PQRS</option>
                <?php foreach ($TipoPqrs as $tipo): ?>
                    <option value="<?= esc($tipo['id']) ?>"><?= esc($tipo['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <!-- Comentario Respuesta (solo lectura) -->

        <!-- Estado (oculto, predeterminado a 'Pendiente') -->
        <input type="hidden" id="estado_pqrs_id" name="estado_pqrs_id" value="1">

        <!-- Usuario (oculto, desde la sesión) -->
        <input type="hidden" id="usuario_id" name="usuario_id" value="<?= session()->get('id') ?>">

        <!-- Botón Enviar -->
        <div class="boton-enviar-div">
            <button type="submit" class="btn btn-primary boton-enviar-pqrs">Enviar PQRS</button>
        </div>
    </form>
    <div class="table-responsive mx-auto my-4 table-rounded">
  <table class="table text-center" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th>#</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Descripción</th>
        <th>Comentario respuesta</th>
        <th>Estado</th>     
      </tr>
    </thead>
    <tbody>
      <?php if ($PqrsModel) : ?>
        <?php foreach ($PqrsModel as $pqrs) : ?>
          <?php 
            $nombreUsuario = "Desconocido";
            foreach ($Usuario as $usuario) {
                if ($usuario['id_usuario'] == $pqrs['usuario_id']) {
                    $nombreUsuario = $usuario['primer_nombre'] . " " . $usuario['primer_apellido'];
                    break;
                }
            }

            $tipoPqrs = "No asignado";
            foreach ($TipoPqrs as $tipo) {
                if ($tipo['id'] == $pqrs['tipo_pqrs_id']) {
                    $tipoPqrs = $tipo['nom'];
                    break;
                }
            }

            $estadoPqrs = "No asignado";
            foreach ($EstadoPqrs as $estado) {
                if ($estado['id'] == $pqrs['estado_pqrs_id']) {
                    $estadoPqrs = $estado['nom'];
                    break;
                }
            }

            $descripcion = htmlspecialchars($pqrs["descripcion"], ENT_QUOTES, 'UTF-8');
            $comentario = htmlspecialchars($pqrs["comentario_respuesta"], ENT_QUOTES, 'UTF-8');
          ?>
          <tr onclick="mostrarModal('<?php echo $pqrs["id"]; ?>', '<?php echo $nombreUsuario; ?>', '<?php echo $tipoPqrs; ?>', '<?php echo $descripcion; ?>', '<?php echo $comentario; ?>', '<?php echo $estadoPqrs; ?>')">
            <td><?php echo $pqrs["id"]; ?></td>
            <td><?php echo $nombreUsuario; ?></td>
            <td><?php echo $tipoPqrs; ?></td>
            <td><?php echo $descripcion; ?></td>
            <td><?php echo $comentario; ?></td>
            <td><?php echo $estadoPqrs; ?></td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="p-4 text-muted">No hay PQRS disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade modal-custom" id="modalPQRS" tabindex="-1" aria-labelledby="modalPQRSLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPQRSLabel">Detalles de la PQRS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> <span id="modal-id"></span></p>
        <p><strong>Usuario:</strong> <span id="modal-usuario"></span></p>
        <p><strong>Tipo:</strong> <span id="modal-tipo"></span></p>
        <p><strong>Descripción:</strong> <span id="modal-descripcion"></span></p>
        <p><strong>Comentario de respuesta:</strong> <span id="modal-comentario"></span></p>
        <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</main>
</body>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#pqrsForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url('pqrs/add') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.message === 'success') {
                    alert('PQRS enviada con éxito');
                    $('#pqrsForm')[0].reset();
                } else {
                    alert('Error al enviar la PQRS: ' + response.message);
                }
            },
            error: function() {
                alert('Error en la solicitud');
            }
        });
    });
});
function mostrarModal(id, usuario, tipo, descripcion, comentario, estado) {
    document.getElementById('modal-id').textContent = id;
    document.getElementById('modal-usuario').textContent = usuario;
    document.getElementById('modal-tipo').textContent = tipo;
    document.getElementById('modal-descripcion').textContent = descripcion;
    document.getElementById('modal-comentario').textContent = comentario;
    document.getElementById('modal-estado').textContent = estado;

    // Abre el modal (Bootstrap 5)
    const modal = new bootstrap.Modal(document.getElementById('modalPQRS'));
    modal.show();
  }
</script>
<footer>
<?php require_once("../app/Views/footer/footerApp.php")?>
</footer>