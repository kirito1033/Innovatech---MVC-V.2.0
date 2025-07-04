<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos Bootstrap para mostrar registros de rutas -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Encabezado de la tabla con estilos personalizados -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- Columna ID -->
        <th scope="col" class="p-3">Ruta</th> <!-- Ruta del recurso -->
         <th scope="col" class="p-3">Descripción</th> <!-- Descripción de la ruta -->
        <th scope="col" class="p-3">Actions</th> <!-- Acciones disponibles -->
      </tr>
    </thead>
     <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Validación de existencia de datos en el modelo -->
      <?php if ($ModelosModel) : ?>
        <!-- Recorrido dinámico de los datos -->
        <?php foreach ($ModelosModel as $obj) : ?>
          <tr class="fw-bold">
             <td class="p-3"><?php echo $obj["id"]; ?></td>  <!-- ID del registro -->
            <td class="p-3"><?php echo $obj["Ruta"]; ?></td> <!-- Ruta o URL asociada -->
            <td class="p-3"><?php echo $obj["Descripción"]; ?></td> <!-- Descripción textual -->
            <!-- Botones de acción: ver, editar, eliminar -->
            <td class="p-3"> 
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
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
