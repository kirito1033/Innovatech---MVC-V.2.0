<!-- Formulario principal con ID 'my-form' -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del registro -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para almacenar la fecha/hora de actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo visible para ingresar el nombre -->
    <div class="form-floating mb-3">
        <!-- Campo de texto para el nombre -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <!-- Etiqueta flotante que actúa como placeholder -->
        <label for="nom">Name</label>
    </div>
</form>