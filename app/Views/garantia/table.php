<!-- Contenedor con estilo responsivo y padding -->
<div class="table-responsive mx-auto p-3">

  <!-- Tabla estilizada con Bootstrap y clases adicionales para sombreado y bordes redondeados -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Cabecera de la tabla -->
    <thead class="table-primary text-white">
      <tr>
        <!-- Columnas: ID, Número, Periodo y Acciones -->
        <th scope="col" class="p-3">#</th>
        <th scope="col" class="p-3">Número</th>
        <th scope="col" class="p-3">Periodo</th>
        <th scope="col" class="p-3">Actions</th>
      </tr>
    </thead>
    <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Validar que el modelo (array) tenga datos -->
      <?php if ($GarantiaModel) : ?>
        <!-- Iterar sobre cada objeto de garantía -->
        <?php foreach ($GarantiaModel as $obj) : ?>
          <tr class="fw-bold">
            <!-- Columna ID -->
            <td class="p-3"><?php echo $obj["id"]; ?></td>
            <!-- Número de meses o años (cantidad) -->
            <td class="p-3"><?php echo $obj["numero_mes_año"]; ?></td>
            <!-- Tipo de periodo: Mes o Año -->
            <td class="p-3">
            <?php echo ($obj["mes_año"] == "Mes") ? "Mes" : "Año"; ?>
            </td>
            <!-- Acciones: Ver, Editar, Eliminar -->
            <td class="p-3">
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- Botón para mostrar detalles del registro -->
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success btn-sm">
                  <i class="bi bi-eye"></i> SHOW
                </button>
                <!-- Botón para editar el registro -->
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil"></i> EDIT
                </button>
                <!-- Botón para eliminar el registro -->
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> DELETE
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <!-- En caso de que no haya datos en $GarantiaModel -->
      <?php else : ?>
        <tr>
          <td colspan="4" class="p-4 text-muted">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
