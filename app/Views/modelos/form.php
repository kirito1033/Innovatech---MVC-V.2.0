<!-- Formulario con identificador único para ser usado con JavaScript o AJAX -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del registro (en edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para almacenar la fecha/hora de la última actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo de texto flotante para la ruta (URL, endpoint o nombre de permiso) -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="Ruta" name="Ruta" placeholder="Ruta">
        <label for="Ruta">Ruta</label>
    </div>
    <!-- Campo de texto flotante para la descripción de la ruta -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="Descripción" name="Descripción" placeholder="Descripción">
        <label for="Descripción">Descripción</label>
    </div>
</form>