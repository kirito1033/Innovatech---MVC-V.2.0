<!-- Formulario HTML con ID "my-form", utilizado para enviar datos de creación o edición -->
<form id="my-form">

     <!-- Campo oculto para el ID del registro -->
    <!-- Si el valor es null, se asume que se está creando un nuevo registro -->
    <!-- Si tiene un valor, se está editando un registro existente -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <!-- Campo oculto para guardar la fecha de última actualización -->
    <!-- Este valor puede ser llenado automáticamente desde el backend -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <!-- Grupo de formulario flotante usando Bootstrap -->
    <div class="form-floating mb-3">
       
        <!-- Campo visible donde el usuario escribe el nombre del estado -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
         <!-- Etiqueta flotante que se muestra dentro del campo hasta que se escribe -->
        <label for="nom">Name</label>
    </div>
</form>