<!-- Formulario con ID "my-form" que se utiliza para registrar o actualizar un estado de producto -->
<form id="my-form">

    <!-- Campo oculto que almacena el ID del registro -->
  <!-- Si se deja como null, el backend asume que es un nuevo registro -->
  <!-- Si contiene un valor, se interpreta como una edición -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para almacenar la fecha/hora de la última actualización -->
  <!-- Generalmente completado automáticamente desde el backend -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <!-- Grupo de entrada con diseño de etiqueta flotante de Bootstrap -->
    <div class="for m-floating mb-3">

        <!-- Campo de entrada principal donde el usuario escribe el nombre del estado -->
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <!-- Etiqueta flotante asociada al campo "nom" -->
        <label for="nom">Name</label>
    </div>
</form>