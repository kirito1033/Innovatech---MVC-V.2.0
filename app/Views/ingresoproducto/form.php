<!-- Formulario con ID único para envío de datos -->
<form id="my-form">

    <!-- Campo oculto para el ID de la factura (usado en edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para la fecha de actualización (timestamp del último cambio) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>

    <!-- Campo de entrada para el nombre de la factura -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nombre_factura" name="nombre_factura" placeholder="Nombre factura">
        <label for="nombre_factura">Nombre Factura</label>
    </div>

    <!-- Campo de entrada para el número o código de la factura -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="factura" name="factura" placeholder="Factura">
        <label for="factura">Factura</label>
    </div>
    
    <!-- Selector desplegable para elegir un usuario asociado a la factura -->
    <div class="form-floating mb-3">
    <select class="form-select" id="usuario_id" name="usuario_id" required>
    <option value="">Seleccione un usuario</option>
        <!-- Carga dinámica de usuarios desde el backend -->
        <?php foreach ($usuario as $u) : ?>
            <option value="<?= $u['id_usuario']; ?>"><?= $u['primer_nombre'] . ' ' . $u['primer_apellido']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Usuario</label>
    </div>

</form>