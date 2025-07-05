<!-- Contenedor con diseño responsivo y padding -->
<div class="table-responsive mx-auto p-3">
 
  <!-- Tabla con estilos de Bootstrap -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- Columna para el ID del color -->
        <th scope="col" class="p-3">Name</th> <!-- Columna para el nombre del color -->
        <th scope="col" class="p-3">Actions</th> <!-- Columna para acciones (ver, editar, eliminar) -->
      </tr> 
    </thead>
    <tbody class="align-middle">
      <!-- Verifica si hay datos en el modelo -->
      <?php if ($ColorModel) : ?>
         <!-- Recorre los datos y genera una fila por cada registro -->
        <?php foreach ($ColorModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id_color"]; ?></td> <!-- ID del color -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td> <!-- Nombre del color -->
            <td class="p-3">

            <!-- Grupo de botones con acciones -->
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para mostrar detalles del color -->
                <button type="button" onclick="show(<?php echo $obj['id_color']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar color -->
                <button type="button" onclick="edit(<?php echo $obj['id_color']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar color -->
                <button type="button" onclick="delete_(<?php echo $obj['id_color']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <!-- Fila mostrada si no hay registros disponibles -->
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
