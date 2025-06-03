<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Usuario</th>
        <th scope="col" class="p-3">Rol</th>
        <th scope="col" class="p-3">Estado</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($ApiUserModel) : ?>
        <?php foreach ($ApiUserModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <td class="p-3"><?php echo $obj["api_user"]; ?></td>
            <td class="p-3"><?php echo $obj["api_role"]; ?></td>
            <td class="p-3">
              <?php if ($obj["api_status"] === "Active") : ?>
                <span class="badge bg-success">Activo</span>
              <?php else : ?>
                <span class="badge bg-secondary">Inactivo</span>
              <?php endif; ?>
            </td>
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm">
                  <i class="bi bi-eye"></i> Ver
                </button>
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil"></i> Editar
                </button>
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Eliminar
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="5" class="p-4 text-muted">No hay usuarios disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
