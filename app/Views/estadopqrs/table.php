<!-- Contenedor con diseño responsivo para que la tabla se adapte a diferentes tamaños de pantalla -->
<div class="table-responsive mx-auto p-3">

  <!-- Tabla estilizada con clases de Bootstrap:
       - table-striped: filas alternadas con color
       - table-hover: efecto al pasar el cursor
       - table-bordered: con bordes visibles
       - text-center: alinea el contenido al centro
       - shadow-lg: añade sombra
       - rounded: bordes redondeados -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- Columna para el ID -->
        <th scope="col" class="p-3">Name</th> <!-- Columna para el nombre del estado PQRS -->
        <th scope="col" class="p-3">Actions</th> <!-- Columna con botones de acción -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verifica si hay datos en el modelo EstadoPqrsModel -->
      <?php if ($EstadoPqrsModel) : ?>
        <!-- Recorre cada registro del modelo para mostrar una fila en la tabla -->
        <?php foreach ($EstadoPqrsModel as $obj) : ?>
          <tr class="fw-bold"> <!-- Texto en negrita para mejorar legibilidad -->
            <td class="p-3"><?php echo $obj["id"]; ?></td> <!-- ID del estado -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td> <!-- Nombre del estado -->
            
            <!-- Botones de acción agrupados -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                
                <!-- Botón para visualizar detalles del estado -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar el estado -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar el estado -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos, muestra una fila con mensaje informativo -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
