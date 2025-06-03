<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Usuario</th>
        <th scope="col" class="p-3">Tipo</th>
        <th scope="col" class="p-3">Descripción</th>
        <th scope="col" class="p-3">Estado</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($PqrsModel) : ?>
        <?php foreach ($PqrsModel as $pqrs) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $pqrs["id"]; ?></td>
            
            <!-- Obtener el nombre del usuario -->
            <td class="p-3">
                <?php 
                    $nombreUsuario = "Desconocido";
                    foreach ($Usuario as $usuario) {
                        if ($usuario['id_usuario'] == $pqrs['usuario_id']) {
                            $nombreUsuario = $usuario['primer_nombre'] . " " . $usuario['primer_apellido'];
                            break;
                        }
                    }
                    echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8');
                ?>
            </td>
            
            <!-- Obtener el tipo de PQRS -->
            <td class="p-3">
                <?php 
                    $tipoPqrs = "No asignado";
                    foreach ($TipoPqrs as $tipo) {
                        if ($tipo['id'] == $pqrs['tipo_pqrs_id']) {
                            $tipoPqrs = $tipo['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($tipoPqrs, ENT_QUOTES, 'UTF-8');
                ?>
            </td>
            
            <td class="p-3"><?php echo htmlspecialchars($pqrs["descripcion"], ENT_QUOTES, 'UTF-8'); ?></td>
            
            <!-- Obtener el estado de PQRS -->
            <td class="p-3">
                <?php 
                    $estadoPqrs = "No asignado";
                    foreach ($EstadoPqrs as $estado) {
                        if ($estado['id'] == $pqrs['estado_pqrs_id']) {
                            $estadoPqrs = $estado['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($estadoPqrs, ENT_QUOTES, 'UTF-8');
                ?>
            </td>
            
            
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $pqrs['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button type="button" onclick="edit(<?php echo $pqrs['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <button type="button" onclick="delete_(<?php echo $pqrs['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="7" class="p-4 text-muted">No hay PQRS disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
