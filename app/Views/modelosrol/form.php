<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <div class="form-floating mb-3">
    <select class="form-select" id="Rolid" name="Rolid" required>
    <option value="">Seleccione un Rol</option>
        <?php foreach ($DepartamentoModel as $Departamento) : ?>
            <option value="<?= $Departamento['id']; ?>"><?= $Departamento['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Ciudad</label>
    </div>
    
</form>