<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Dirección</th>
        <th scope="col" class="p-3">Fecha de Envío</th>
        <th scope="col" class="p-3">Estado del Envío</th>
        <th scope="col" class="p-3">Usuario Responsable</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if (!empty($EnvioModel)) : ?>
        <?php foreach ($EnvioModel as $envio) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $envio["id"]; ?></td>
            <td class="p-3"><?php echo $envio["direccion"]; ?></td>
            <td class="p-3"><?php echo $envio["fecha"]; ?></td>
            <td class="p-3">
              <?php 
                $estadoNombre = "Desconocido"; 
                foreach ($EstadoEnvio as $estado) {
                    if ($estado['id'] == $envio['estado_envio_id']) { 
                        $estadoNombre = $estado['nom'];
                        break;
                    }
                }
                echo htmlspecialchars($estadoNombre, ENT_QUOTES, 'UTF-8'); 
              ?>
            </td>
            <td class="p-3">
              <?php 
                $usuarioNombre = "No asignado"; 
                foreach ($Usuario as $usuario) {
                    if ($usuario['id_usuario'] == $envio['usuario_id']) { 
                        $usuarioNombre = $usuario['primer_nombre'] . ' ' . ($usuario['segundo_nombre'] ?? '') . ' ' . 
                                         $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? '');
                        break;
                    }
                }
                echo htmlspecialchars(trim($usuarioNombre), ENT_QUOTES, 'UTF-8'); 
              ?>
            </td>
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $envio['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button type="button" onclick="edit(<?php echo $envio['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <button type="button" onclick="delete_(<?php echo $envio['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="p-4 text-muted">No hay datos disponibles</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
