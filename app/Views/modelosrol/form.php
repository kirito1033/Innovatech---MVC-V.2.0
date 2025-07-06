<form id="my-form">
    <!-- Campos ocultos para almacenar el ID del registro y la fecha de actualización -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    
    <!-- Selector de Modelo -->
    <div class="form-floating mb-3">
        <select class="form-select" id="Modelosid" name="Modelosid">
            <option value="">Seleccione un Modelo</option>
            <!-- Itera sobre el array $modelos para mostrar las rutas disponibles -->
            <?php foreach ($modelos as $model) : ?>
                <option value="<?= $model['id']; ?>"><?= $model['Ruta']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Modelosid">Modelo</label>
    </div>

     <!-- Selector de Rol -->
       <div class="form-floating mb-3">
        <select class="form-select" id="Rolid" name="Rolid">
            <option value="">Seleccione una Rol</option>
            <!-- Itera sobre el array $roles para mostrar los nombres de roles -->
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id']; ?>"><?= $rol['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Rolid">Rol</label>
    </div>

    <!-- Selector del Grupo funcional -->
    <div class="form-floating mb-3">
    <select class="form-select" id="grupo" name="grupo" required>
        <option value="">Seleccione un Grupo</option>
        <!-- Lista fija de grupos funcionales disponibles -->
        <option value="Modelos">Modelos</option>
        <option value="PQRS">PQRS</option>
        <option value="Facturacion">Facturación</option>
        <option value="envios">Envios</option>
        <option value="Usuarios">Usuarios</option>
        <option value="Productos">Productos</option>
        <option value="Roles">Roles</option>
        <option value="Filtros">Filtros</option>
        <option value="Facturas">Facturas</option>
        <option value="Dashboard">Dashboard</option>
        <option value="Proveedor">Proveedor</option>
    </select>
    <label for="grupo">Grupo</label>
</div>


</form>