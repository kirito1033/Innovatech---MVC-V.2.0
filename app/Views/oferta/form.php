<form id="my-form" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="descuento" name="descuento" placeholder="Descuento">
        <label for="descuento">Descuento</label>
    </div>

    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" id="fechaini" name="fechaini" placeholder="Fecha de Inicio">
        <label for="fechaini">Fecha de Inicio</label>
    </div>

    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" id="fechafin" name="fechafin" placeholder="Fecha de Fin">
        <label for="fechafin">Fecha de Fin</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
        <label for="descripcion">Descripción</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="estado" name="estado">
            <option value="">Seleccione Estado</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <label for="estado">Estado</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="productos_id" name="productos_id">
            <option value="">Seleccione un Producto</option>
            <?php foreach ($productos as $producto) : ?>
                <option value="<?= $producto['id']; ?>"><?= $producto['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="productos_id">Producto</label>
    </div>
</form>
