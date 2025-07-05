<!-- Formulario para asignar un permiso a una relación Modelo-Rol -->
<form id="my-form">

    <!-- Campo oculto para el ID del registro (útil en edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para registrar la fecha/hora de actualización (opcionalmente manejado por backend) -->
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    
    <!-- Selector de Permisos -->
    <div class="form-floating mb-3">
        <!-- Dropdown para seleccionar un permiso existente -->
        <select class="form-select" id="Permisosid" name="Permisosid">
            <option value="">Seleccione un permiso</option>
            <!-- Se genera una opción por cada permiso disponible -->
            <?php foreach ($permisos as $permiso) : ?>
                <option value="<?= $permiso['id']; ?>"><?= $permiso['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Permisosid">Permisos</label>
    </div>

    <!-- Selector de Modelo-Rol -->
       <div class="form-floating mb-3">
        <!-- Dropdown para seleccionar una combinación de Modelo (Ruta) con Rol -->
            <select class="form-select" id="ModelosRolId" name="ModelosRolId">
                <option value="">Seleccione un modelo rol</option>
                 <!-- Cada opción combina la Ruta del modelo con el nombre del rol -->
                <?php foreach ($modelosrol as $modelorol) : ?>
                    <option value="<?= $modelorol['id']; ?>">
                        <?= $modelorol['Ruta'] . ' - ' . $modelorol['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="ModelosRolId">Modelo Rol</label>
        </div>


</form>