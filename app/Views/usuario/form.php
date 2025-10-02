<form id="my-form">
    <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" placeholder="Primer Nombre" required>
        <label for="primer_nombre">Primer Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Segundo Nombre">
        <label for="segundo_nombre">Segundo Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" required>
        <label for="primer_apellido">Primer Apellido</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido">
        <label for="segundo_apellido">Segundo Apellido</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="tipo_documento_id" name="tipo_documento_id" required>
            <option value="">Seleccione un Tipo de Documento</option>
            <?php foreach ($TipoDocumento as $Tipo) : ?>
                <option value="<?= $Tipo['id']; ?>"><?= $Tipo['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="tipo_documento_id">Tipo de Documento</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="documento" name="documento" placeholder="Documento">
        <label for="documento">Documento</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
        <label for="correo">Correo</label>
    </div>
    <div class="form-floating mb-3">
        <input type="tel" class="form-control" id="telefono1" name="telefono1" placeholder="Teléfono 1">
        <label for="telefono1">Teléfono 1</label>
    </div>
    <div class="form-floating mb-3">
        <input type="tel" class="form-control" id="telefono2" name="telefono2" placeholder="Teléfono 2">
        <label for="telefono2">Teléfono 2</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
        <label for="direccion">Dirección</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
        <label for="usuario">Usuario</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
        <label for="password">Contraseña</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="ciudad_id" name="ciudad_id" required>
            <option value="">Seleccione una Ciudad</option>
            <?php foreach ($Ciudad as $Ciu) : ?>
                <option value="<?= $Ciu['id']; ?>"><?= $Ciu['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="ciudad_id">Ciudad</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="rol_id" name="rol_id" required>
            <option value="">Seleccione un Rol</option>
            <?php foreach ($Rol as $R) : ?>
                <option value="<?= $R['id']; ?>"><?= $R['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="rol_id">Rol</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="estado_usuario_id" name="estado_usuario_id" required>
            <option value="">Seleccione un Estado</option>
            <?php foreach ($EstadoUsuario as $Estado) : ?>
                <option value="<?= $Estado['id']; ?>"><?= $Estado['Nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="estado_usuario_id">Estado</label>
    </div>
    <button type="submit" class="btn btn-primary" id="btnSubmit">Send Data</button>
  
</form>