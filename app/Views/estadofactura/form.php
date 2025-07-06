<!-- Formulario con ID "my-form", utilizado para crear o actualizar registros -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del registro -->
  <!-- Se usa para identificar si se trata de una creación (nuevo) o actualización (existente) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <!-- Campo oculto para almacenar la fecha/hora de la última modificación -->
    <!-- Generalmente se completa automáticamente desde el backend -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>

    <!-- Grupo de formulario con diseño flotante (Bootstrap) -->
    <div class="form-floating mb-3">

    <!-- Campo de texto visible para el nombre del estado (por ejemplo: "Pagado", "Pendiente") -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <!-- Etiqueta flotante que se muestra dentro del campo hasta que el usuario escribe -->
        <label for="nom">Name</label>
    </div>
</form>