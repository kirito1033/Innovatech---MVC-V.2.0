<!-- Contenedor con scroll horizontal para dispositivos pequeños -->
<div class="table-responsive mx-auto p-3">
  
  <!-- Tabla con estilos Bootstrap: bordes, sombreado, alineación centrada y esquinas redondeadas -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    
    <!-- Encabezado de la tabla -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Número de Factura</th>
        <th scope="col" class="p-3">Dirección</th>
        <th scope="col" class="p-3">Correo</th>
        <th scope="col" class="p-3">Fecha de llegada</th>
        <th scope="col" class="p-3">Estado del Envío</th>
        <th scope="col" class="p-3">Usuario Responsable</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>

    <!-- Cuerpo de la tabla con datos dinámicos -->
    <tbody class="align-middle">
      
      <!-- Verifica si hay datos en $EnvioModel -->
      <?php if (!empty($EnvioModel)) : ?>
        <!-- Recorre cada registro de envío -->
        <?php foreach ($EnvioModel as $envio) : ?>
          <tr class="fw-bold">
            <!-- ID del envío -->
            <td class="p-3"><?= $envio["id"]; ?></td>
            <!-- Número de factura (seguro ante campos nulos o vacíos) -->
            <td class="p-3"><?= htmlspecialchars($envio["numero"] ?? 'No disponible', ENT_QUOTES, 'UTF-8'); ?></td>
            <!-- Dirección del envío -->
            <td class="p-3"><?= $envio["direccion"]; ?></td>
            <!-- Correo del destinatario o contacto -->
            <td class="p-3"><?= $envio["correo"]; ?></td>
            <!-- Fecha en que se registró/llegó el envío -->
            <td class="p-3"><?= $envio["fecha"]; ?></td>
            
            <!-- Estado del envío (buscado por ID en el arreglo $EstadoEnvio) -->
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

            <!-- Nombre completo del usuario responsable del envío -->
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

             <!-- Botones de acción: Ver, Editar, Eliminar y Ver PDF -->
            <td class="p-3">
              <div class="btn-group" role="group">
                <!-- Botón Ver -->
                <button type="button" onclick="show(<?= $envio['id']; ?>)" class="btn btn-success btn-sm">
                  <i class="bi bi-eye"></i> Ver
                </button>
                <!-- Botón Editar -->
                <button type="button" onclick="edit(<?= $envio['id']; ?>)" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil"></i> Editar
                </button>
                <!-- Botón Eliminar -->
                <button type="button" onclick="delete_(<?= $envio['id']; ?>)" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Eliminar
                </button>

                <!-- Botón PDF, visible solo si hay número de factura -->
                <?php if (!empty($envio["numero"])) : ?>
                  <a href="<?= site_url('facturas/pdf/' . $envio['numero']) ?>" target="_blank" class="btn btn-info btn-sm">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                  </a>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>

         <!-- Si no hay datos, muestra un mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="7" class="p-4 text-muted">No hay datos disponibles</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>