<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Nombre Factura</th>
        <th scope="col" class="p-3">Producto</th>
        <th scope="col" class="p-3">Cantidad</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
     <?php if (!empty($productosIngresoProducto)) : ?>
  <?php foreach ($productosIngresoProducto as $obj) : ?>
    <tr class="fw-bold">
      <td class="p-3"><?= esc($obj["id"] ?? '-') ?></td>

      <!-- Nombre Factura -->
      <td>
        <?php
          $nombreFactura = "No asignado";
          if (!empty($facturas)) {
            foreach ($facturas as $fact) {
              if ($fact['id'] == ($obj['ingreso_producto_id'] ?? null)) {
                $nombreFactura = $fact['nombre_factura'] ?? 'Sin nombre';
                break;
              }
            }
          }
          echo esc($nombreFactura);
        ?>
      </td>

      <!-- Producto -->
      <td>
        <?php
          $productoNombre = "No asignado";
          if (!empty($producto)) {
            foreach ($producto as $p) {
              if ($p['id'] == ($obj['producto_id'] ?? null)) {
                $productoNombre = $p['nom'] ?? 'Sin nombre';
                break;
              }
            }
          }
          echo esc($productoNombre);
        ?>
      </td>

      <!-- Cantidad -->
      <td class="p-3"><?= esc($obj["cantidad"] ?? 'No disponible') ?></td>

      <!-- Actions -->
      <td class="p-3">
        <div class="btn-group" role="group">
          <button type="button" onclick="show(<?= $obj['id'] ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
          <button type="button" onclick="edit(<?= $obj['id'] ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
          <button type="button" onclick="delete_(<?= $obj['id'] ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
        </div>
      </td>
    </tr>
  <?php endforeach ?>
<?php else : ?>
  <tr>
    <td colspan="5" class="p-4 text-muted">No data available</td>
  </tr>
<?php endif ?>

    </tbody>
  </table>
</div>
