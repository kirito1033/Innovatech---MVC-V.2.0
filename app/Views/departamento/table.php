<!-- Contenedor responsivo para la tabla con padding y centrado horizontal -->
<div class="table-responsive mx-auto p-3">
  
  <!-- Tabla con estilos Bootstrap: rayada, con hover, bordes, centrada y sombra -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla con fondo primario y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Columna de ID o índice -->
        <th scope="col" class="p-3">#</th>
        <!-- Columna para el nombre del departamento -->
        <th scope="col" class="p-3">Name</th>
        <!-- Columna para los botones de acción -->
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>

    <!-- Cuerpo de la tabla con alineación vertical centrada -->
    <tbody class="align-middle">

      <!-- Verifica si hay datos en el modelo de departamentos -->
      <?php if ($DepartamentoModel) : ?>
        <!-- Recorre cada objeto del modelo para renderizar una fila -->
        <?php foreach ($DepartamentoModel as $obj) : ?>
           <!-- ID del departamento -->
          <tr class="fw-bold">
            <!-- Nombre del departamento -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Botones de acción para mostrar, editar y eliminar -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td>
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para mostrar detalles -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- En caso de que no haya datos disponibles -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
