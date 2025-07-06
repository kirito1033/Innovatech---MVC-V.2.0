<!-- Formulario con ID "my-form" y soporte para envío de archivos (enctype), aunque en este caso no hay campos file -->
<form id="my-form" enctype="multipart/form-data">
    
    <!-- Campo oculto para almacenar el ID (útil para edición de ofertas) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

    <!-- Campo numérico flotante para ingresar el descuento aplicado a la oferta -->
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="descuento" name="descuento" placeholder="Descuento">
        <label for="descuento">Descuento</label>
    </div>

     <!-- Campo de fecha y hora para indicar cuándo inicia la oferta -->
    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" id="fechaini" name="fechaini" placeholder="Fecha de Inicio">
        <label for="fechaini">Fecha de Inicio</label>
    </div>

    <!-- Campo de fecha y hora para indicar cuándo finaliza la oferta -->
    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" id="fechafin" name="fechafin" placeholder="Fecha de Fin">
        <label for="fechafin">Fecha de Fin</label>
    </div>

    <!-- Campo de texto para añadir una descripción breve de la oferta -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
        <label for="descripcion">Descripción</label>
    </div>

    <!-- Selector desplegable para elegir el producto al cual se le aplicará la oferta -->
    <div class="form-floating mb-3">
        <select class="form-select" id="productos_id" name="productos_id">
            <option value="">Seleccione un Producto</option>
            <?php foreach ($productos as $producto) : ?>
                <!-- Carga dinámica de productos desde el arreglo $productos -->
                <option value="<?= $producto['id']; ?>"><?= $producto['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="productos_id">Producto</label>
    </div>
</form>
