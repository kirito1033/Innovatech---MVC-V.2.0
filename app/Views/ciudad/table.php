<!-- Contenedor que hace la tabla responsiva en pantallas pequeñas -->
<div class="table-responsive mx-auto p-3">

  <!-- Tabla principal con clases Bootstrap para estilo y formato -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Columna para ID de la ciudad -->
        <th scope="col" class="p-3">#</th>
        <!-- Columna para el código de la ciudad -->
        <th scope="col" class="p-3">Codigó</th>
        <!-- Columna para el nombre de la ciudad -->
        <th scope="col" class="p-3">Nombre</th>
        <!-- Columna para el departamento asociado -->
        <th scope="col" class="p-3">Departamento</th>
        <!-- Columna para botones de acción (ver, editar, eliminar) -->
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>

    <!-- Cuerpo de la tabla que contiene los datos dinámicos -->
    <tbody class="align-middle">

      <!-- Verifica si existe información en el modelo -->
      <?php if ($CiudadModel) : ?>

        <!-- Itera sobre cada objeto (ciudad) del modelo -->
        <?php foreach ($CiudadModel as $obj) : ?>
          <tr class="fw-bold">
             <!-- ID -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Código -->
            <td class="p-3"><?php echo $obj["code"]; ?></td>
            <!-- Nombre -->
            <td class="p-3"><?php echo $obj["name"]; ?></td>
            <!-- Departamento -->
            <td class="p-3"><?php echo $obj["department"]; ?></td>                 
            
             <!-- Botones de acción -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para ver los detalles -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <!-- Botón para editar la ciudad -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <!-- Botón para eliminar la ciudad -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>

        <!-- Si no hay datos, muestra mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
