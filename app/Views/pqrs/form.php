<!-- Formulario con ID "my-form", usado para crear o actualizar registros de PQRS -->
<form id="my-form">
      <!-- Campo oculto para almacenar el ID del registro (usado en edición) -->
    <input type="hidden" id="id" name="id" value="">
    <!-- Campo oculto para almacenar la fecha de actualización del registro -->
    <input type="hidden" id="updated_at" name="updated_at" value="">
    <!-- Campo de entrada de texto para la descripción del PQRS -->

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
        <label for="descripcion">Descripción</label>
    </div>

    <!-- ⚠️ Este input tiene un error: el tipo "hidder" no existe, debe ser "text" o "hidden". Lo documentamos asumiendo que debe ser "text" -->
    <!-- Campo de entrada de texto para un comentario de respuesta al PQRS -->
    <div class="form-floating mb-3">
        <input type="hidder" class="form-control" id="comentario_respuesta" name="comentario_respuesta" placeholder="Comentario de respuesta">
        <label for="comentario_respuesta">Comentario de Respuesta</label>

         <!-- Lista desplegable para seleccionar el tipo de PQRS (Petición, Queja, Reclamo, Sugerencia, etc.) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="tipo_pqrs_id" name="tipo_pqrs_id" required>
            <option value="">Seleccione un Tipo de PQRS</option>
             <!-- Se recorre el array $TipoPqrs para llenar las opciones del select -->
            <?php foreach ($TipoPqrs as $Tipo) : ?>
                <option value="<?= $Tipo['id']; ?>"><?= $Tipo['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="tipo_pqrs_id">Tipo de PQRS</label>
    </div>

    <!-- Lista desplegable para seleccionar el usuario asociado a la PQRS -->
    <div class="form-floating mb-3">
        <select class="form-select" id="usuario_id" name="usuario_id" required>
            <option value="">Seleccione un Usuario</option>
            <!-- Se recorren los usuarios disponibles para mostrar nombre y apellido como opción -->
            <?php foreach ($Usuario as $U) : ?>
                <option value="<?= $U['id_usuario']; ?>"><?= $U['primer_nombre'] . ' ' . $U['primer_apellido']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="usuario_id">Usuario</label>
    </div>

    <!-- Lista desplegable para seleccionar el estado actual de la PQRS (Ej: En proceso, Resuelto, Pendiente) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="estado_pqrs_id" name="estado_pqrs_id" required>
            <option value="">Seleccione un Estado</option>
            <!-- Se recorren los estados disponibles -->
            <?php foreach ($EstadoPqrs as $Estado) : ?>
                <option value="<?= $Estado['id']; ?>"><?= $Estado['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="estado_pqrs_id">Estado</label>
    </div>
</form>
