<!-- Contenedor responsivo para la tabla, centrado y con padding -->
<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos de Bootstrap: rayada, con hover, bordes y centrado -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
  <!-- Encabezado de la tabla con fondo azul y texto blanco -->  
  <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID de la PQRS -->
        <th scope="col" class="p-3">Usuario</th> <!-- Nombre del usuario -->
        <th scope="col" class="p-3">Tipo</th> <!-- Tipo de PQRS -->
        <th scope="col" class="p-3">Descripción</th> <!-- Descripción escrita -->
        <th scope="col" class="p-3">Estado</th>  <!-- Estado actual -->
        <th scope="col" class="p-3">Acciones</th> <!-- Botones de acción -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verifica si hay datos en el modelo PQRS -->
      <?php if ($PqrsModel) : ?>
        <!-- Recorre cada registro PQRS -->
        <?php foreach ($PqrsModel as $pqrs) : ?>
          <!-- Columna: ID de PQRS -->
          <tr class="fw-bold">
            <!-- Columna: Nombre del usuario (se busca por ID) -->
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
            
           <!-- Columna: Tipo de PQRS (se busca por ID) -->
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
            <!-- Columna: Descripción de la PQRS -->
            <td class="p-3"><?php echo htmlspecialchars($pqrs["descripcion"], ENT_QUOTES, 'UTF-8'); ?></td>
            
            <!-- Columna: Estado de la PQRS (se busca por ID) -->
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
            
            <!-- Columna: Botones de acción (Ver, Editar, Eliminar) -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón Ver PQRS -->
                <button type="button" onclick="show(<?php echo $pqrs['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <!-- Botón Editar PQRS -->
                <button type="button" onclick="edit(<?php echo $pqrs['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <!-- Botón Eliminar PQRS -->
                <button type="button" onclick="delete_(<?php echo $pqrs['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay datos disponibles, se muestra mensaje -->
      <?php else : ?>
        <tr>
          <td colspan="7" class="p-4 text-muted">No hay PQRS disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
