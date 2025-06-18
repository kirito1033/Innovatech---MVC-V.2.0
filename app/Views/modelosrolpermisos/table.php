

<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Modelo Rol</th>
        <th scope="col" class="p-3">Permiso</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($ModelosRolPermisosModel) : ?>
        <?php foreach ($ModelosRolPermisosModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?= $obj["id"]; ?></td>
            <td>
              <?php
                $modeloNombre = "No asignado"; 
                foreach ($modelosrol as $model) {
                    if ($model['id'] == $obj['ModelosRolId']) {
                        $modeloNombre = $model['Ruta'] . ' - ' . $model['nom'];
                        break;
                    }
                }
                echo htmlspecialchars($modeloNombre, ENT_QUOTES, 'UTF-8');
              ?>
            </td>
            <td>
              <?php
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
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                <?php if ($puedeVer): ?>
                  <button type="button" onclick="show(<?= $obj['id']; ?>)" class="btn btn-success btn-sm">
                    <i class="bi bi-eye"></i> SHOW
                  </button>
                <?php endif; ?>

                <?php if ($puedeEditar): ?>
                  <button type="button" onclick="edit(<?= $obj['id']; ?>)" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> EDIT
                  </button>
                <?php endif; ?>

                <?php if ($puedeEliminar): ?>
                  <button type="button" onclick="delete_(<?= $obj['id']; ?>)" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> DELETE
                  </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
