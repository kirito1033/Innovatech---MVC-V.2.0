<!-- Contenedor responsive para adaptar la tabla a pantallas pequeñas -->
<div class="table-responsive mx-auto p-3">

 <!-- Tabla estilizada con Bootstrap para mostrar usuarios API -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
  <!-- Encabezado de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del usuario -->
        <th scope="col" class="p-3">Usuario</th> <!-- Nombre de usuario API -->
        <th scope="col" class="p-3">Rol</th> <!-- Rol asignado (Admin, Read-only) -->
        <th scope="col" class="p-3">Estado</th> <!-- Estado (Activo o Inactivo) -->
        <th scope="col" class="p-3">Acciones</th> <!-- Botones de acción -->
      </tr>
    </thead>

    <!-- Cuerpo de la tabla con los datos dinámicos -->
    <tbody class="align-middle">

    <!-- Verifica si hay usuarios disponibles -->
      <?php if ($ApiUserModel) : ?>

        <!-- Recorre cada usuario y genera una fila con su información -->
        <?php foreach ($ApiUserModel as $obj) : ?>
          <tr class="fw-bold">

          <!-- ID del usuario -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Nombre de usuario -->
            <td class="p-3"><?php echo $obj["api_user"]; ?></td>
            <!-- Rol del usuario (Admin / Read-only) -->
            <td class="p-3"><?php echo $obj["api_role"]; ?></td>
            
            <!-- Estado del usuario: visualmente destacado como badge -->
            <td class="p-3">
              <?php if ($obj["api_status"] === "Active") : ?>
                <span class="badge bg-success">Activo</span>
              <?php else : ?>
                <span class="badge bg-secondary">Inactivo</span>
              <?php endif; ?>
            </td>

            <!-- Botones de acción: Ver, Editar, Eliminar -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                
              <!-- Ver detalles del usuario -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm">
                  <i class="bi bi-eye"></i> Ver
                </button>
                
                <!-- Editar datos del usuario -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil"></i> Editar
                </button>

                <!-- Eliminar usuario -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Eliminar
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>

        <!-- Si no hay usuarios, mostrar mensaje amigable -->
      <?php else : ?>
        <tr>
          <td colspan="5" class="p-4 text-muted">No hay usuarios disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
