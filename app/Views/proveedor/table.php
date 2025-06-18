<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Nombre</th>
         <th scope="col" class="p-3">nit</th>
          <th scope="col" class="p-3">direccion</th>
          <th scope="col" class="p-3">telefono</th>
           <th scope="col" class="p-3">email</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($ProveedorModel) : ?>
        <?php foreach ($ProveedorModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <td class="p-3"><?php echo $obj["nombre"]; ?></td>
            <td class="p-3"><?php echo $obj["nit"]; ?></td>
            <td class="p-3"><?php echo $obj["direccion"]; ?></td>
            <td class="p-3"><?php echo $obj["telefono"]; ?></td>
            <td class="p-3"><?php echo $obj["email"]; ?></td>
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
