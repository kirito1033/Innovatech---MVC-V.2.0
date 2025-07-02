<!-- Contenedor que hace que la tabla sea responsive en pantallas pequeñas -->
<div class="table-responsive mx-auto p-3">
  
  <!-- Tabla con clases de estilo Bootstrap: rayas, bordes, centrado, sombreado -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
  <!-- Encabezado de la tabla con fondo azul y texto blanco -->
  <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del registro -->
        <th scope="col" class="p-3">Numero</th> <!-- Cantidad de almacenamiento -->
        <th scope="col" class="p-3">Unidad</th> <!-- Unidad de medida (MB/GB) -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones de acción (ver, editar, eliminar) -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">

    <!-- Verifica si hay datos en el modelo -->
      <?php if ($AlmacenamientoAleatorioModel) : ?>
        <!-- Recorre cada registro para construir filas dinámicas -->
        <?php foreach ($AlmacenamientoAleatorioModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- ID -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Número (cantidad de almacenamiento) -->
            <td class="p-3"><?php echo $obj["num"]; ?></td>
            <!-- Unidad (MB o GB) con validación simple -->
            <td class="p-3"><?php echo ($obj["unidadestandar"] == "MB") ? "MB" : "GB"; ?></td>
            
            <!-- Botones de acción para cada fila -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                
                <!-- Ver registro -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Editar registro -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Eliminar registro -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>

        <!-- Si no hay datos, muestra una fila con mensaje vacío -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
