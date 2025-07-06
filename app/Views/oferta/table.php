<!-- Contenedor con estilo responsivo para la tabla -->
<div class="table-responsive mx-auto p-3">
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
     <!-- Encabezado de la tabla -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">#</th> <!-- ID -->
        <th scope="col" class="p-3">Producto</th> <!-- Nombre del producto asociado -->
        <th scope="col" class="p-3">Descuento</th> <!-- Porcentaje de descuento -->
        <th scope="col" class="p-3">Fecha inicio</th> <!-- Fecha de inicio de la oferta -->
        <th scope="col" class="p-3">Fecha fin</th> <!-- Fecha de finalización -->
        <th scope="col" class="p-3">Descripción</th> <!-- Texto descriptivo -->
        <th scope="col" class="p-3">Estado</th> <!-- Activa / Inactiva -->
        <th scope="col" class="p-3">Imagen</th> <!-- Imagen asociada a la oferta -->
        <th scope="col" class="p-3">Acciones</th> <!-- Botones: ver, editar, eliminar, imagen -->
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verificación: ¿hay datos en el modelo? -->
      <?php if ($OfertaModel) : ?>
        <!-- Recorremos las ofertas -->
        <?php foreach ($OfertaModel as $oferta) : ?>
          <tr class="fw-bold">
            <!-- ID de la oferta -->
            <td class="p-3"><?php echo $oferta["id"]; ?></td>

            <!-- Buscar y mostrar el nombre del producto relacionado -->
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

            <!-- Descuento aplicado -->
            <td class="p-3"><?php echo $oferta["descuento"]; ?>%</td>
            <!-- Fechas de inicio y fin -->
            <td class="p-3"><?php echo $oferta["fechaini"]; ?></td>
            <td class="p-3"><?php echo $oferta["fechafin"] ?? 'Sin definir'; ?></td>
             <!-- Descripción (opcional) -->
            <td class="p-3"><?php echo $oferta["descripcion"] ?? 'Sin descripción'; ?></td>
            
            <!-- Estado de la oferta: activa/inactiva -->
            <td class="p-3">
              <?php echo ($oferta["estado"]) ? 'Activa' : 'Inactiva'; ?>
            </td>

            <!-- Imagen de la oferta -->
            <td class="p-3">
              <?php 
                if (!empty($oferta['imagen'])) {
                  echo '<img src="' . base_url('uploads/' . $oferta['imagen']) . '" alt="Imagen oferta" width="60">';
                } else {
                  echo '<span class="text-muted">Sin imagen</span>';
                }
              ?>
            </td>

            <!-- Botones de acción para cada oferta -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Botones de acción">
                <!-- Ver detalles -->
                <button type="button" onclick="show(<?php echo $oferta['id']; ?>)" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <!-- Editar oferta -->
                <button type="button" onclick="edit(<?php echo $oferta['id']; ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</button>
                <!-- Eliminar oferta -->
                <button type="button" onclick="delete_(<?php echo $oferta['id']; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
                <!-- Subir o actualizar imagen -->
                <button type="button" class="btn btn-info btn-sm" onclick="showImageModal(<?php echo $oferta['id']; ?>)">
                  <i class="bi bi-image"></i> Imagen
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- Si no hay registros -->
      <?php else : ?>
        <tr>
          <td colspan="9" class="p-4 text-muted">No hay ofertas disponibles</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
