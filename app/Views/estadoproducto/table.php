<!-- Contenedor responsive con padding y centrado horizontal -->
<div class="table-responsive mx-auto p-3">

  <!-- Tabla Bootstrap con estilos:
       - striped: filas con colores alternos
       - hover: efecto al pasar el mouse
       - bordered: bordes visibles
       - text-center: texto centrado
       - shadow-lg: sombra grande
       - rounded: bordes redondeados -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Encabezado de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del estado -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre del estado -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones de acción -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Si hay datos en el modelo EstadoProductoModel -->
      <?php if ($EstadoProductoModel) : ?>
        <!-- Itera sobre cada objeto del modelo para crear filas -->
        <?php foreach ($EstadoProductoModel as $obj) : ?>
          <tr class="fw-bold"> <!-- Texto en negrita para mejor visibilidad -->
            <!-- Columna con el ID del estado -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Columna con el nombre del estado -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td>
            <!-- Columna con botones de acción (ver, editar, eliminar) -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para mostrar detalles del registro -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar el registro -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar el registro -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos en el modelo, muestra un mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
