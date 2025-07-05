<!-- Formulario HTML con ID "my-form", utilizado para crear o editar registros -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del registro (usado en actualizaciones) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <!-- Campo oculto para registrar la fecha/hora de la última actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>

    <!-- Grupo de entrada flotante para el nombre -->
    <div class="form-floating mb-3">
        <!-- Campo de texto para ingresar el nombre -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <!-- Etiqueta asociada al campo anterior (aparece flotante) -->
        <label for="nom">Name</label>
    </div>
</form>