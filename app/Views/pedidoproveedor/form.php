<!-- 
Formulario para registrar o editar una factura de ingreso de productos. 
Incluye campos ocultos para ID y fecha de actualización, además de inputs para número de factura, producto, proveedor y cantidad.
-->
<form id="my-form"  method="post">

    <!-- Campo oculto para almacenar el ID del registro (usado en edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <!-- Campo oculto para almacenar la fecha de actualización (si aplica) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
     
     <!-- Número de Factura -->
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numero_factura" name="numero_factura" placeholder="Numero factura">
        <label for="numero_factura">Numero factura</label>
    </div>

    <!-- Selección de producto asociado a la factura -->
     <div class="form-floating mb-3">
    <select class="form-select" id="producto_id" name="producto_id" required>
    <option value="">Seleccione un producto</option>
        <?php foreach ($producto as $p) : ?>
            <option value="<?= $p['id']; ?>"><?= $p['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Producto</label>
    </div>

    <!-- Selección de proveedor que entrega el producto -->
    <div class="form-floating mb-3">
    <select class="form-select" id="id_proveedor" name="id_proveedor" required>
    <option value="">Seleccione un Proveedor</option>
        <?php foreach ($proveedor as $p) : ?>
            <option value="<?= $p['id']; ?>"><?= $p['nombre']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="id">Proveedor</label>
    </div>
   
    <!-- Cantidad de productos ingresados en la factura -->
    <div class="form-floating mb-3">
            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            <label for="cantidad">Cantidad</label>
        </div>
        
</form>