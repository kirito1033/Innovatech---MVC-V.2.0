<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>
    
      <div class="form-floating mb-3">
        <select class="form-select" id="ingreso_producto_id" name="ingreso_producto_id">
            <option value="">Seleccione el nombre de la factura</option>
            <?php foreach ($facturas as $Ingreso) : ?>
                <option value="<?= $Ingreso['id']; ?>"><?= $Ingreso['nombre_factura']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="ingreso_producto_id">Nombre de la factura</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="producto_id" name="producto_id">
            <option value="">Seleccione un Producto</option>
            <?php foreach ($producto as $p) : ?>
                <option value="<?= $p['id']; ?>"><?= $p['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Modelosid">Producto</label>
    </div>

     
  <div class="form-floating mb-3">
        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad">
        <label for="cantidad">cantidad</label>
    </div>
</form>