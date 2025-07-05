<!-- Contenedor que hace la tabla responsive y centra el contenido -->
<div class="table-responsive mx-auto p-3">

<!-- Tabla estilizada con clases de Bootstrap -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla con color primario y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Columna para el ID -->
        <th scope="col" class="p-3">#</th>
        <!-- Columna para el nombre de la categoría -->
        <th scope="col" class="p-3">Name</th>
        <!-- Columna para los botones de acción -->
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>

     <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">

    <!-- Verifica si hay datos en $CategoriaModel -->
      <?php if ($CategoriaModel) : ?>

        <!-- Recorre cada categoría y crea una fila -->
        <?php foreach ($CategoriaModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- Muestra el ID de la categoría -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Muestra el nombre de la categoría -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td>
            
            <!-- Columna de acciones con botones para mostrar, editar y eliminar -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para ver la categoría -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
               <!-- Botón para editar la categoría -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar la categoría -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>

        <!-- Si no hay datos en $CategoriaModel, se muestra una fila vacía -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
