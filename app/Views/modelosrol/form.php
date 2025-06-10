<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    

    <div class="form-floating mb-3">
        <select class="form-select" id="Modelosid" name="Modelosid">
            <option value="">Seleccione un Estado</option>
            <?php foreach ($modelos as $model) : ?>
                <option value="<?= $model['id']; ?>"><?= $model['Ruta']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Modelosid">Estado</label>
    </div>

       <div class="form-floating mb-3">
        <select class="form-select" id="Rolid" name="Rolid">
            <option value="">Seleccione una Marca</option>
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id']; ?>"><?= $rol['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Rolid">Rol</label>
    </div>

</form>