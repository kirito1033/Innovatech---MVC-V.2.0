<!-- Contenedor responsivo para la tabla, con padding y centrado horizontal -->
<div class="table-responsive mx-auto p-3">

<!-- Tabla con estilos de Bootstrap: rayada, con hover, bordeada, centrada, sombreada y esquinas redondeadas -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">

  <!-- Encabezado de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Encabezados de columnas -->
        <th scope="col" class="p-3">#</th> <!-- ID -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre del estado de envío -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones para ver, editar y eliminar -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla con celdas verticalmente centradas -->
    <tbody class="align-middle">

    <!-- Validación: si hay datos en $EstadoEnvioModel -->
      <?php if ($EstadoEnvioModel) : ?>

        <!-- Recorre cada elemento del modelo para renderizar una fila -->
        <?php foreach ($EstadoEnvioModel as $obj) : ?>
          <tr class="fw-bold"> <!-- Fila con texto en negrita -->
            <td class="p-3"><?php echo $obj["id"]; ?></td> <!-- Muestra el ID -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td> <!-- Muestra el nombre -->
            
            <!-- Columna de acciones con botones -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para ver detalles -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos, se muestra un mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
