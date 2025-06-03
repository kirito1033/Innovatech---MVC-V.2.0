<form id="facturaForm" method="POST">
    <div>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" required>
    </div>
    <div>
        <label for="valortl">Valor Total</label>
        <input type="number" id="valortl" name="valortl" required>
    </div>
    <div>
        <label for="metodopago">Método de Pago</label>
        <select id="metodopago" name="metodopago" required>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
        </select>
    </div>
    <div>
        <label for="Estado_facturaId_Estado_factura">Estado de Factura</label>
        <select id="Estado_facturaId_Estado_factura" name="Estado_facturaId_Estado_factura" required>
            <!-- Aquí se agregarían los estados disponibles desde la base de datos -->
            <?php foreach($EstadoFactura as $estado): ?>
                <option value="<?= $estado['id'] ?>"><?= $estado['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="Pedidoid">Pedido</label>
        <select id="Pedidoid" name="Pedidoid" required>
            <!-- Aquí se agregarían los pedidos disponibles desde la base de datos -->
            <?php foreach($Pedido as $pedido): ?>
                <option value="<?= $pedido['id'] ?>"><?= $pedido['descripcion'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <button type="submit">Crear Factura</button>
    </div>
</form>