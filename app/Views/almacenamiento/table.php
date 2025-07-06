<!-- Contenedor responsive con padding y centrado -->
<div class="table-responsive mx-auto p-3">

<!-- Tabla con estilos de Bootstrap: rayas, hover, bordes, centrado, sombra, bordes redondeados --> 
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
 
<!-- Encabezado de la tabla con fondo azul y texto blanco -->   
  <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del registro -->
        <th scope="col" class="p-3">Numero</th> <!-- Valor numérico de almacenamiento -->
        <th scope="col" class="p-3">Unidad</th> <!-- Unidad de medida (MB o GB) -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones de acción -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
     
      <!-- Verifica si hay datos en el modelo $AlmacenamientoModel -->
      <?php if ($AlmacenamientoModel) : ?>
        <!-- Recorre cada objeto del modelo para construir las filas -->
        <?php foreach ($AlmacenamientoModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td> <!-- ID del almacenamiento -->
            <td class="p-3"><?php echo $obj["num"]; ?></td> <!-- Número de unidad -->
            <td class="p-3"><?php echo ($obj["unidadestandar"] == "MB") ? "MB" : "GB"; ?></td> <!-- Unidad (MB/GB) -->
            
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

      <?php else : ?>
        <!-- Si no hay datos, se muestra mensaje de tabla vacía -->
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
