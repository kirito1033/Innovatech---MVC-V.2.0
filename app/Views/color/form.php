<!-- Formulario para crear o editar un color -->
<form id="my-form">

    <!-- Campo oculto para el ID del color (usado en modo edición) -->
    <input type="hidden" class="form-control" id="id_color" name="id_color" value=null>
    
    <!-- Campo oculto para la fecha de última actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo de entrada para el nombre del color -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <label for="nom">Name</label>
    </div>
</form>