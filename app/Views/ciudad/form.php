<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Name">
        <label for="nom">Name</label>
    </div>
    <div class="form-floating mb-3">
    <select class="form-select" id="departamentoid" name="departamentoid" required>
    <option value="">Seleccione un Departamento</option>
        <?php foreach ($DepartamentoModel as $Departamento) : ?>
            <option value="<?= $Departamento['id']; ?>"><?= $Departamento['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Ciudad</label>
    </div>

</form>