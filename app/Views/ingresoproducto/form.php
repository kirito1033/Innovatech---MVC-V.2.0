<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nombre_factura" name="nombre_factura" placeholder="Nombre factura">
        <label for="nombre_factura">Nombre Factura</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="factura" name="factura" placeholder="Factura">
        <label for="factura">Factura</label>
    </div>
    
    <div class="form-floating mb-3">
    <select class="form-select" id="usuario_id" name="usuario_id" required>
    <option value="">Seleccione un usuario</option>
        <?php foreach ($usuario as $u) : ?>
            <option value="<?= $u['id_usuario']; ?>"><?= $u['primer_nombre'] . ' ' . $u['primer_apellido']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Usuario</label>
    </div>

</form>