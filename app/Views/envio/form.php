<!-- Formulario con ID único 'my-form', utilizado para enviar datos de un envío -->
<form id="my-form">

    <!-- Campo oculto para el ID del registro, usado al editar -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para la fecha de última actualización (opcional) -->
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>

    <!-- Campo para ingresar el número de la factura o código de envío -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero Factura" required>
        <label for="Numero Factura">Dirección</label> <!-- ⚠️ Este label está mal escrito. Debería decir "Número de Factura" -->
    </div>

    <!-- Campo para la dirección de entrega del envío -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
        <label for="direccion">Dirección</label>
    </div>

     <!-- Campo para el correo electrónico asociado al envío (cliente o responsable) -->
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
        <label for="correo">Correo</label>
    </div>

    <!-- Campo para seleccionar la fecha del envío -->
    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="fecha" name="fecha" required>
        <label for="fecha">Fecha de Envío</label>
    </div>

    <!-- Selector de estado del envío (ej: Pendiente, En tránsito, Entregado) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="estado_envio_id" name="estado_envio_id" required>
            <option value="">Seleccione un Estado de Envío</option>
            <?php foreach ($EstadoEnvio as $estado) : ?>
                <option value="<?= $estado['id']; ?>"><?= $estado['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="estado_envio_id">Estado del Envío</label>
    </div>

    <!-- Selector para asignar el envío a un usuario (generalmente un responsable o cliente) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="usuario_id" name="usuario_id" required>
            <option value="">Seleccione un Usuario</option>
            <?php foreach ($Usuario as $usuario) : ?>
                <option value="<?= $usuario['id_usuario']; ?>">
                    <!-- Concatenación del nombre completo del usuario -->
                   <?= $usuario['primer_nombre'] . ' ' . ($usuario['segundo_nombre'] ?? '') . ' ' . 
                        $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? ''); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="usuario_id">Usuario Responsable</label>
    </div>
</form>
