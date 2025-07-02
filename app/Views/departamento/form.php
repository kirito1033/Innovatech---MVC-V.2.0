<!-- Formulario principal con identificador "my-form", utilizado para registrar o actualizar un departamento -->
<form id="my-form">

     <!-- Campo oculto que almacena el ID del departamento (se usa para edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <!-- Campo oculto para registrar la fecha de actualización del registro -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo visible para ingresar el nombre del departamento -->
    <div class="form-floating mb-3">
        <!-- Input de texto para el nombre -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <!-- Etiqueta flotante que actúa como placeholder flotante (estilo Bootstrap) -->
        <label for="nom">Name</label>
    </div>
</form>