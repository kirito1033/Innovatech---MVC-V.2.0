<!-- Contenedor que hace la tabla responsive y agrega espaciado -->
<div class="table-responsive mx-auto p-3">
   <!-- Tabla con clases de Bootstrap para estilos: rayado, hover, bordeada, centrada, con sombra y bordes redondeados -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Encabezado de la tabla con fondo primario y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del permiso -->
        <th scope="col" class="p-3">Name</th> <!-- Nombre del permiso -->
        <th scope="col" class="p-3">Descripción</th> <!-- Descripción del permiso -->
        <th scope="col" class="p-3">Actions</th> <!-- Acciones disponibles (Ver, Editar, Eliminar) -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla con alineación vertical centrada -->
    <tbody class="align-middle">
      <!-- Verifica si hay datos disponibles en el modelo de permisos -->
      <?php if ($PermisosModel) : ?>
        <!-- Itera sobre cada permiso encontrado -->
        <?php foreach ($PermisosModel as $obj) : ?>
          <tr class="fw-bold"> <!-- Fila con fuente en negrita -->
            <!-- Botón para ver detalles del permiso -->
            <td class="p-3"><?php echo $obj["id"]; ?></td><!-- Muestra el ID -->
            <!-- Botón para editar el permiso -->
            <td class="p-3"><?php echo $obj["nombre"]; ?></td> <!-- Muestra el nombre del permiso -->
            <!-- Botón para eliminar el permiso -->
            <td class="p-3"><?php echo $obj["descripción"]; ?></td> <!-- Muestra la descripción -->
            <!-- Columna de acciones con grupo de botones -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos, mostrar un mensaje indicando que no hay información -->
      <?php else : ?>
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
