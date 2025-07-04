<!-- Contenedor responsivo para la tabla con padding y centrado horizontal -->
<div class="table-responsive mx-auto p-3">

<!-- Tabla estilizada con Bootstrap:
       - table-striped: filas alternadas
       - table-hover: efecto al pasar el mouse
       - table-bordered: bordes visibles
       - text-center: texto centrado
       - shadow-lg: sombra
       - rounded: bordes redondeados -->
    <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Encabezado de la tabla con color primario y texto blanco --> 
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del estado -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre del estado -->
        <th scope="col" class="p-3">Actions</th> <!-- Acciones (ver, editar, eliminar) -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verifica si existen datos en el modelo EstadoFacturaModel -->
      <?php if ($EstadoFacturaModel) : ?>

         <!-- Recorre el arreglo de estados y renderiza una fila por cada elemento -->
        <?php foreach ($EstadoFacturaModel as $obj) : ?>
          <tr class="fw-bold"> <!-- Texto en negrita -->
            <!-- Muestra el ID del estado -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Muestra el nombre del estado -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td>
            <!-- Botones de acción: SHOW, EDIT, DELETE -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para ver detalles del estado -->  
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar el estado -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar el estado -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos disponibles, muestra un mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
