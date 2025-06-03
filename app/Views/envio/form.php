<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
        <label for="direccion">Dirección</label>
    </div>

    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="fecha" name="fecha" required>
        <label for="fecha">Fecha de Envío</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="estado_envio_id" name="estado_envio_id" required>
            <option value="">Seleccione un Estado de Envío</option>
            <?php foreach ($EstadoEnvio as $estado) : ?>
                <option value="<?= $estado['id']; ?>"><?= $estado['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="estado_envio_id">Estado del Envío</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="usuario_id" name="usuario_id" required>
            <option value="">Seleccione un Usuario</option>
            <?php foreach ($Usuario as $usuario) : ?>
                <option value="<?= $usuario['id_usuario']; ?>">
                    <?= $usuario['primer_nombre'] . ' ' . ($usuario['segundo_nombre'] ?? '') . ' ' . 
                        $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? ''); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="usuario_id">Usuario Responsable</label>
    </div>
</form>
