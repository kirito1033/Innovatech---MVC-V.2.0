<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Nombre</th>
        <th scope="col" class="p-3">Categoría</th>
        <th scope="col" class="p-3">Marca</th>
        <th scope="col" class="p-3">Precio</th>
        <th scope="col" class="p-3">Stock</th>
        <th scope="col" class="p-3">Estado</th>
        <th scope="col" class="p-3">img</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($productos) : ?>
        <?php foreach ($productos as $producto) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $producto["id"]; ?></td>
            <td class="p-3"><?php echo $producto["nom"]; ?></td>
            
            <!-- Obtener el nombre de la categoría -->
            <td class="p-3">
                <?php 
                    $nombreCategoria = "No asignado";
                    foreach ($categorias as $categoria) {
                        if ($categoria['id'] == $producto['id_categoria']) {
                            $nombreCategoria = $categoria['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($nombreCategoria, ENT_QUOTES, 'UTF-8');
                ?>
            </td>

            <!-- Obtener el nombre de la marca -->
            <td class="p-3">
                <?php 
                    $nombreMarca = "No asignado";
                    foreach ($marcas as $marca) {
                        if ($marca['id'] == $producto['id_marca']) {
                            $nombreMarca = $marca['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($nombreMarca, ENT_QUOTES, 'UTF-8');
                ?>
            </td>

            <td class="p-3">$<?php echo number_format($producto["precio"], 2); ?></td>
            <td class="p-3"><?php echo $producto["existencias"]; ?></td>

            <!-- Obtener el nombre del estado -->
            <td class="p-3">
                <?php 
                    $nombreEstado = "No asignado";
                    foreach ($estado_productos as $estado) {
                        if ($estado['id'] == $producto['id_estado']) {
                            $nombreEstado = $estado['nom'];
                            break;
                        }
                    }
                    echo htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8');
                ?>
            </td>
            <td>
            <?php if ($producto['imagen']): ?>
                <img src="<?= base_url('uploads/' . $producto['imagen']) ?>" alt="Imagen" width="60">
              <?php else: ?>
                <span class="text-muted">Sin imagen</span>
              <?php endif; ?>
            </td>
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $producto['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button type="button" onclick="edit(<?php echo $producto['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <button type="button" onclick="delete_(<?php echo $producto['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
                <button type="button" class="btn btn-info btn-sm" onclick="showImageModal(<?php echo $producto['id']; ?>)">
                  <i class="bi bi-image"></i> Imagen
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="8" class="p-4 text-muted">No hay productos disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
