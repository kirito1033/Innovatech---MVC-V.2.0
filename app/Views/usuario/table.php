<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Nombre Completo</th>
        <th scope="col" class="p-3">Documento</th>
        <th scope="col" class="p-3">Correo</th>
        <th scope="col" class="p-3">Teléfono</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($UsuarioModel) : ?>
        <?php foreach ($UsuarioModel as $usuario) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $usuario["id_usuario"]; ?></td>
            <td class="p-3"><?php echo $usuario["primer_nombre"] . " " . $usuario["primer_apellido"]; ?></td>
            <td class="p-3"><?php echo $usuario["documento"]; ?></td>
            <td class="p-3"><?php echo $usuario["correo"]; ?></td>
            <td class="p-3"><?php echo $usuario["telefono1"]; ?></td>
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $usuario['id_usuario']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button type="button" onclick="edit(<?php echo $usuario['id_usuario']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <button type="button" onclick="delete_(<?php echo $usuario['id_usuario']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="p-4 text-muted">No hay datos disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>