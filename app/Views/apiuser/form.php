<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value="">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="api_user" name="api_user" placeholder="Nombre de usuario">
        <label for="control">Nombre de usuario</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="api_password" name="api_password" placeholder="Contraseña">
        <label for="api_password">Contraseña</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="api_role" name="api_role">
            <option value="Admin">Admin</option>
            <option value="Read-only">Read-only</option>
        </select>
        <label for="api_role">Rol</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="api_status" name="api_status">
            <option value="Active">Activo</option>
            <option value="Inactive">Inactivo</option>
        </select>
        <label for="api_status">Estado</label>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<div id="response-message" class="mt-3"></div>