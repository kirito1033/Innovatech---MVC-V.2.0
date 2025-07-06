<!-- Formulario HTML para capturar o editar información básica -->
<form id="my-form">
    <!-- Campo oculto para almacenar el ID del registro (por ejemplo, al editar un elemento existente) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
     <!-- Campo oculto para registrar la fecha/hora de la última actualización (puede ser llenado automáticamente) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <!-- Campo de texto flotante para ingresar el nombre -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        <label for="nombre">Nombre</label>
    </div>
    <!-- Campo de texto flotante para ingresar la descripción -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="descripción" name="descripción" placeholder="descripción">
        <label for="descripción">Descripción</label>
    </div>
</form>