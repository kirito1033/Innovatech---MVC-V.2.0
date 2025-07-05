<!-- Contenedor responsive para que la tabla se adapte a distintos tamaños de pantalla -->
<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos Bootstrap para mejorar la visualización -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Cabecera de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Encabezados de columnas -->
        <th scope="col" class="p-3">#</th> <!-- ID del estado -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre del estado -->
        <th scope="col" class="p-3">Descripción</th> <!-- Descripción del estado -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones de acción -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verifica si hay datos en el modelo -->
      <?php if ($EstadoUsuarioModel) : ?>
        <!-- Recorre cada registro del modelo y genera una fila por estado -->
        <?php foreach ($EstadoUsuarioModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- ID del estado -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Nombre del estado -->
            <td class="p-3"><?php echo $obj["Nombre"]; ?></td>
            <!-- Descripción del estado -->
            <td class="p-3"><?php echo $obj["Descripción"]; ?></td>
            <!-- Botones de acción: ver, editar y eliminar -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para mostrar detalles del estado -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar el estado -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar el estado -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos en el modelo -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
