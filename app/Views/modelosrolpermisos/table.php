<!-- Contenedor responsivo que permite desplazamiento horizontal en pantallas pequeñas -->
<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos Bootstrap y sombreado para mayor legibilidad -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Encabezado de la tabla -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del registro -->
        <th scope="col" class="p-3">Modelo Rol</th> <!-- Cadena “Ruta – Rol” -->
        <th scope="col" class="p-3">Permiso</th> <!-- Nombre del permiso -->
        <th scope="col" class="p-3">Actions</th> <!-- Botones CRUD -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verificamos que haya datos en $ModelosRolPermisosModel -->
      <?php if ($ModelosRolPermisosModel) : ?>
        <!-- Recorremos cada registro (relación Modelo‑Rol‑Permiso) -->
        <?php foreach ($ModelosRolPermisosModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- Columna: ID del registro -->
            <td class="p-3"><?= $obj["id"]; ?></td>
            <td>
              <!-- Columna: Nombre del Modelo‑Rol (Ruta − Rol) -->
              <?php
              // Buscamos la combinación Modelo‑Rol por I
                $modeloNombre = "No asignado"; 
                foreach ($modelosrol as $model) {
                    if ($model['id'] == $obj['ModelosRolId']) {
                      // Construimos la etiqueta “Ruta − Rol”
                        $modeloNombre = $model['Ruta'] . ' - ' . $model['nom'];
                        break;
                    }
                }
                // Mostramos el resultado escapado para evitar XSS
                echo htmlspecialchars($modeloNombre, ENT_QUOTES, 'UTF-8');
              ?>
            </td>
            <!-- Columna: Nombre del Permiso -->
            <td>
              <?php
              // Buscamos el nombre del permiso por ID
                $permisoNombre = "No asignado"; 
                foreach ($permisos as $permiso) {
                    if ($permiso['id'] == $obj['Permisosid']) {
                        $permisoNombre = $permiso['nombre'];
                        break;
                    }
                }
                echo htmlspecialchars($permisoNombre, ENT_QUOTES, 'UTF-8');
              ?>
            </td>
            <!-- Columna: Botones de acción (condicionales según permisos del usuario) -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                <!-- Botón SHOW (solo si el usuario tiene permiso “ver”) -->
                <?php if ($puedeVer): ?>
                  <button type="button" onclick="show(<?= $obj['id']; ?>)" class="btn btn-success btn-sm">
                    <i class="bi bi-eye"></i> SHOW
                  </button>
                <?php endif; ?>
                <!-- Botón EDIT (solo si el usuario tiene permiso “editar”) -->
                <?php if ($puedeEditar): ?>
                  <button type="button" onclick="edit(<?= $obj['id']; ?>)" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> EDIT
                  </button>
                <?php endif; ?>
                   <!-- Botón DELETE (solo si el usuario tiene permiso “eliminar”) -->
                <?php if ($puedeEliminar): ?>
                  <button type="button" onclick="delete_(<?= $obj['id']; ?>)" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> DELETE
                  </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        <!-- Si no hay registros, mostramos un mensaje amigable -->
      <?php else : ?>
        <tr>
          <td colspan="4" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
