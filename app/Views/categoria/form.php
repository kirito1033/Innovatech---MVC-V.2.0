<!-- Formulario principal con ID "my-form", usado en combinación con JavaScript para enviar los datos -->
<form id="my-form">

  <!-- Campo oculto para almacenar el ID del registro (usado en ediciones) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

      <!-- Campo oculto para almacenar la fecha de actualización (puede ser manejado automáticamente por el backend) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Grupo flotante para ingresar el nombre de la categoría o entidad -->
    <div class="form-floating mb-3">

     <!-- Campo de texto donde el usuario ingresa el nombre -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        
        <!-- Etiqueta flotante asociada al campo anterior -->
        <label for="nom">Name</label>
    </div>
</form>