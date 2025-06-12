<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    

    <div class="form-floating mb-3">
        <select class="form-select" id="Permisosid" name="Permisosid">
            <option value="">Seleccione un permiso</option>
            <?php foreach ($permisos as $permiso) : ?>
                <option value="<?= $permiso['id']; ?>"><?= $permiso['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Permisosid">Permisos</label>
    </div>

       <div class="form-floating mb-3">
            <select class="form-select" id="ModelosRolId" name="ModelosRolId">
                <option value="">Seleccione un modelo rol</option>
                <?php foreach ($modelosrol as $modelorol) : ?>
                    <option value="<?= $modelorol['id']; ?>">
                        <?= $modelorol['Ruta'] . ' - ' . $modelorol['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="ModelosRolId">Modelo Rol</label>
        </div>


</form>