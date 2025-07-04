<!-- Contenedor con scroll horizontal para dispositivos pequeños -->
<div class="table-responsive mx-auto p-3">

  <!-- Tabla con estilos: rayas, hover, bordes, centrado, sombra y bordes redondeados -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla con títulos de columnas -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID de la marca -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre de la marca -->
        <th scope="col" class="p-3">Actions</th> <!-- Acciones disponibles -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <?php if ($MarcaModel) : ?>  <!-- Verifica que haya datos -->
        <!-- Recorre el arreglo de marcas y genera una fila por cada una -->
        <?php foreach ($MarcaModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>  <!-- Muestra el ID -->
            <td class="p-3"><?php echo $obj["nom"]; ?></td> <!-- Muestra el nombre de la marca -->
            <!-- Columna de acciones con botones -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para visualizar la marca -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar la marca -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar la marca -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?> <!-- Si no hay datos disponibles -->
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
