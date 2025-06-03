<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Producto</th>
        <th scope="col" class="p-3">Descuento</th>
        <th scope="col" class="p-3">Fecha inicio</th>
        <th scope="col" class="p-3">Fecha fin</th>
        <th scope="col" class="p-3">Descripción</th>
        <th scope="col" class="p-3">Estado</th>
        <th scope="col" class="p-3">Imagen</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>
    <tbody class="align-middle">
      <?php if ($OfertaModel) : ?>
        <?php foreach ($OfertaModel as $oferta) : ?>
          <tr class="fw-bold">
            <td class="p-3"><?php echo $oferta["id"]; ?></td>

            <!-- Nombre del producto -->
            <td class="p-3">
              <?php 
                $nombreProducto = "No asignado";
                foreach ($productos as $producto) {
                  if ($producto['id'] == $oferta['productos_id']) {
                    $nombreProducto = $producto['nom'];
                    break;
                  }
                }
                echo htmlspecialchars($nombreProducto, ENT_QUOTES, 'UTF-8');
              ?>
            </td>

            <td class="p-3"><?php echo $oferta["descuento"]; ?>%</td>
            <td class="p-3"><?php echo $oferta["fechaini"]; ?></td>
            <td class="p-3"><?php echo $oferta["fechafin"] ?? 'Sin definir'; ?></td>
            <td class="p-3"><?php echo $oferta["descripcion"] ?? 'Sin descripción'; ?></td>
            
            <td class="p-3">
              <?php echo ($oferta["estado"]) ? 'Activa' : 'Inactiva'; ?>
            </td>

            <td class="p-3">
              <?php 
                if (!empty($oferta['imagen'])) {
                  echo '<img src="' . base_url('uploads/' . $oferta['imagen']) . '" alt="Imagen oferta" width="60">';
                } else {
                  echo '<span class="text-muted">Sin imagen</span>';
                }
              ?>
            </td>

            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                <button type="button" onclick="show(<?php echo $oferta['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button type="button" onclick="edit(<?php echo $oferta['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <button type="button" onclick="delete_(<?php echo $oferta['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
                <button type="button" class="btn btn-info btn-sm" onclick="showImageModal(<?php echo $oferta['id']; ?>)">
                  <i class="bi bi-image"></i> Imagen
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="9" class="p-4 text-muted">No hay ofertas disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
