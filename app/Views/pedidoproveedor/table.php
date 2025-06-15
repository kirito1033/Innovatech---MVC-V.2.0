<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Numero de factura</th>
        <th scope="col" class="p-3">Proveedor</th>
        <th scope="col" class="p-3">Producto</th>
        <th scope="col" class="p-3">Cantidad</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($PedidoProveedorModel) : ?>
        <?php foreach ($PedidoProveedorModel as $obj) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $obj["id"]; ?></td>
           <td class="p-3"><?php echo $obj["numero_factura"]; ?></td>    
           <td>
                <?php 
                    $ProveedorNombre = "No asignado"; 
                    foreach ($proveedor as $p) {
                        if ($p['id'] == $obj['id_proveedor']) { 
                            $ProveedorNombre = $p['nombre'];
                            break;
                        }
                    }
                    echo htmlspecialchars($ProveedorNombre, ENT_QUOTES, 'UTF-8'); 
                ?>
            </td>

            <td>
                  <?php 
                      $ProductoNombre = "No asignado"; 
                      foreach ($producto as $p) {
                          if ($p['id'] == $obj['producto_id']) { 
                              $ProductoNombre = $p['nom'];
                              break;
                          }
                      }
                      echo htmlspecialchars($ProductoNombre, ENT_QUOTES, 'UTF-8'); 
                  ?>
              </td>


            <td class="p-3"><?php echo $obj["cantidad"]; ?></td>                  
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> SHOW</button>
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> EDIT</button>
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> DELETE</button>
                <a href="<?= base_url('pedido/factura/' . $obj['numero_factura']) ?>" 
                target="_blank" 
                class="btn btn-sm btn-outline-danger" 
                title="Descargar PDF">
                  <img src="<?= base_url('assets/img/icons/download.svg') ?>" style="width: 16px;" alt="PDF">
              </a>
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
