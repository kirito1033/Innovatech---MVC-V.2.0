<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Nombre Factura</th>
         <th scope="col" class="p-3">Usuario</th>
        <th scope="col" class="p-3">Fecha</th>
        <th scope="col" class="p-3">Factura</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($IngresoProductoModel) : ?>
        <?php foreach ($IngresoProductoModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <td class="p-3"><?php echo $obj["nombre_factura"]; ?></td>
              <!-- Obtener el nombre del usuario -->
              <td class="p-3">
                <?php 
                    $nombreUsuario = "Desconocido";
                    foreach ($usuario as $u) {
                        if ($u['id_usuario'] == $obj['usuario_id']) {
                            $nombreUsuario = $u['primer_nombre'] . " " . $u['primer_apellido'];
                            break;
                        }
                    }
                    echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8');
                ?>
            </td>
            <td class="p-3"><?php echo $obj["created_at"]; ?></td>
           <td class="p-3">
            <?php if (!empty($obj["factura"])): ?>
           <a href="<?= $obj["factura"] ?>" target="_blank" class="text-dark text-decoration-none">Ver factura</a>
            <?php else: ?>
              No disponible
            <?php endif; ?>
          </td>


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
