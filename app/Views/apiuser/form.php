<!-- Formulario para gestionar un usuario de API (crear o editar) -->
<form id="my-form">

    <!-- Campo oculto: almacena el ID del usuario (usado al editar registros existentes) -->
    <input type="hidden" class="form-control" id="id" name="id" value="">

    <!-- Campo oculto: almacena la fecha de última actualización (puede usarse para control de cambios) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="">

    <!-- Campo de texto para ingresar el nombre de usuario que usará la API -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="api_user" name="api_user" placeholder="Nombre de usuario">
        <label for="control">Nombre de usuario</label>
    </div>

    <!-- Campo para ingresar la contraseña del usuario API -->
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="api_password" name="api_password" placeholder="Contraseña">
        <label for="api_password">Contraseña</label>
    </div>

    <!-- Selector del rol asignado al usuario (ej: permisos de administrador o solo lectura) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="api_role" name="api_role">
            <option value="Admin">Admin</option>
            <option value="Read-only">Read-only</option>
        </select>
        <label for="api_role">Rol</label>
    </div>

    <!-- Selector del estado del usuario (activo o inactivo para controlar acceso) -->
    <div class="form-floating mb-3">
        <select class="form-select" id="api_status" name="api_status">
            <option value="Active">Activo</option>
            <option value="Inactive">Inactivo</option>
        </select>
        <label for="api_status">Estado</label>
    </div>

    <!-- Botón para enviar el formulario -->
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<!-- Contenedor para mostrar mensajes de respuesta (éxito, error, etc.) -->
<div id="response-message" class="mt-3"></div>