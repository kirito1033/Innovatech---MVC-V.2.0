<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Modelo</th>
        <th scope="col" class="p-3">Rol</th>
        <th scope="col" class="p-3">grupo</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($ModelosRolModel) : ?>
        <?php foreach ($ModelosRolModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <td>
                <?php 
                    $modeloNombre = "No asignado"; 
                    foreach ($modelos as $model) {
                        if ($model['id'] == $obj['Modelosid']) { 
                            $modeloNombre = $model['Ruta'];
                            break;
                        }
                    }
                    echo htmlspecialchars($modeloNombre, ENT_QUOTES, 'UTF-8'); 
                ?>
            </td>
            <td>
                <?php 
                    $rolNombre = "No asignado"; 
                    foreach ($roles as $rol) {
                        if ($rol['id'] == $obj['Rolid']) { 
                            $rolNombre = $rol['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($rolNombre, ENT_QUOTES, 'UTF-8'); 
                ?>
            </td>
             <td class="p-3"><?php echo $obj["grupo"]; ?></td>         
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
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
