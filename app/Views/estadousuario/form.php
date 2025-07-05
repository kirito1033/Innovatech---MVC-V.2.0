<!-- Formulario principal con ID "my-form" que se usa dentro de un modal para agregar/editar -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del registro -->
    <!-- Si el valor es null, se interpreta como creación; si tiene un valor, es edición -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto que puede usarse para registrar la fecha/hora de última actualización -->
  <!-- Generalmente completado por el backend o mediante JavaScript -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <!-- Campo visible para ingresar el nombre del estado de usuario -->
    <div class="form-floating mb-3">
        <!-- Campo de texto para el nombre -->
        <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre">
        <!-- Etiqueta flotante asociada al input -->
        <label for="Nombre">Nombre</label>
       
    </div>

    <!-- Campo visible para ingresar una descripción adicional del estado -->
    <div class="form-floating mb-3">
    <!-- Campo de texto para la descripción -->
    <input type="text" class="form-control" id="Descripción" name="Descripción" placeholder="Descripción">
    <!-- Etiqueta flotante asociada al input -->
    <label for="Descripción">Descripción</label>
       
    </div>


</form>