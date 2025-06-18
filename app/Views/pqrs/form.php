<form id="my-form">
    <input type="hidden" id="id" name="id" value="">
    <input type="hidden" id="updated_at" name="updated_at" value="">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
        <label for="descripcion">Descripción</label>
    </div>

    <div class="form-floating mb-3">
        <input type="hidder" class="form-control" id="comentario_respuesta" name="comentario_respuesta" placeholder="Comentario de respuesta">
        <label for="comentario_respuesta">Comentario de Respuesta</label>

    <div class="form-floating mb-3">
        <select class="form-select" id="tipo_pqrs_id" name="tipo_pqrs_id" required>
            <option value="">Seleccione un Tipo de PQRS</option>
            <?php foreach ($TipoPqrs as $Tipo) : ?>
                <option value="<?= $Tipo['id']; ?>"><?= $Tipo['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="tipo_pqrs_id">Tipo de PQRS</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="usuario_id" name="usuario_id" required>
            <option value="">Seleccione un Usuario</option>
            <?php foreach ($Usuario as $U) : ?>
                <option value="<?= $U['id_usuario']; ?>"><?= $U['primer_nombre'] . ' ' . $U['primer_apellido']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="usuario_id">Usuario</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="estado_pqrs_id" name="estado_pqrs_id" required>
            <option value="">Seleccione un Estado</option>
            <?php foreach ($EstadoPqrs as $Estado) : ?>
                <option value="<?= $Estado['id']; ?>"><?= $Estado['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="estado_pqrs_id">Estado</label>
    </div>
</form>
