<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="num" name="num" placeholder="Numero">
        <label for="num">Numero</label>
    </div>
    <div class="form-floating mb-3">
    <select class="form-select" id="unidadestandar" name="unidadestandar" required>
        <option value="" selected disabled>Seleccione una unidad</option>
        <option value="MB">MB</option>
        <option value="GB">GB</option>
    </select>
    <label for="unidadestandar">Unidad Estándar</label>
</div>

</form>