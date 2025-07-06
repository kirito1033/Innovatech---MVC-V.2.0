<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos Bootstrap, DataTables y bordes decorativos -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID del registro -->
        <th scope="col" class="p-3">Modelo</th> <!-- Ruta o módulo asignado -->
        <th scope="col" class="p-3">Rol</th> <!-- Rol al que se asigna el modelo -->
        <th scope="col" class="p-3">grupo</th> <!-- Categoría funcional (ej. Usuarios, Dashboard, etc.) -->
        <th scope="col" class="p-3">Actions</th> <!-- Acciones disponibles -->
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($ModelosRolModel) : ?>
        <?php foreach ($ModelosRolModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- ID del registro -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
             <!-- Nombre del modelo (ruta) asociado -->
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
               <!-- Nombre del rol asignado -->
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
            <!-- Grupo funcional al que pertenece -->
             <td class="p-3"><?php echo $obj["grupo"]; ?></td>         
            <!-- Acciones: Ver, Editar y Eliminar -->
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
        <!-- Mensaje si no hay registros disponibles -->
        <tr>
          <td colspan="3" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
