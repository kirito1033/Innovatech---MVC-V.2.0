<form action="<?= base_url('facturas/registrar') ?>" method="post" class="p-4 shadow rounded">

      <!-- Datos ocultos -->
      <input type="hidden" name="numbering_range_id" value="8">
      <input type="hidden" name="reference_code" value="I421">
      <input type="hidden" name="observation" value="">
      <input type="hidden" name="payment_form" value="1">
      <input type="hidden" name="payment_due_date" value="2024-12-30">
      <input type="hidden" name="payment_method_code" value="10">
      <input type="hidden" name="operation_type" value="10">
      <input type="hidden" name="order_reference[reference_code]" value="ref-001">
      <input type="hidden" name="order_reference[issue_date]" value="">
      <input type="hidden" name="billing_period[start_date]" value="2024-01-10">
      <input type="hidden" name="billing_period[start_time]" value="00:00:00">
      <input type="hidden" name="billing_period[end_date]" value="2024-02-09">
      <input type="hidden" name="billing_period[end_time]" value="23:59:59">

      <!-- Cliente -->
      <h5 class="mb-3">Datos del Cliente</h5>
      <div class="mb-2">
        <label for="identification">Identificación</label>
        <input type="text" name="customer[identification]" id="identification" class="form-control" value="7788999456" required>
      </div>
      <div class="mb-2">
        <label for="dv">Dígito de verificación</label>
        <input type="text" name="customer[dv]" id="dv" class="form-control" value="3">
      </div>
      <div class="mb-2">
        <label for="names">Nombres</label>
        <input type="text" name="customer[names]" id="names" class="form-control" value="Alan Turing" required>
      </div>
      <div class="mb-2">
        <label for="address">Dirección</label>
        <input type="text" name="customer[address]" id="address" class="form-control" value="calle 1 # 2-68">
      </div>
      <div class="mb-2">
        <label for="email">Correo</label>
        <input type="email" name="customer[email]" id="email" class="form-control" value="alanturing@enigmasas.com">
      </div>
      <div class="mb-2">
        <label for="phone">Teléfono</label>
        <input type="text" name="customer[phone]" id="phone" class="form-control" value="1234567890">
      </div>

      <!-- Ocultos cliente -->
      <input type="hidden" name="customer[company]" value="">
      <input type="hidden" name="customer[trade_name]" value="">
      <input type="hidden" name="customer[legal_organization_id]" value="2">
      <input type="hidden" name="customer[tribute_id]" value="21">
      <input type="hidden" name="customer[identification_document_id]" value="3">
      <input type="hidden" name="customer[municipality_id]" value="980">

      <!-- Ítems -->
      <h5 class="mt-4 mb-3">Productos</h5>

      <!-- Producto 1 -->
      <div class="border rounded p-3 mb-3">
        <div class="mb-2">
          <label>Nombre</label>
          <input type="text" name="items[0][name]" class="form-control" value="producto de prueba">
        </div>
        <div class="mb-2">
          <label>Código</label>
          <input type="text" name="items[0][code_reference]" class="form-control" value="12345">
        </div>
        <div class="mb-2">
          <label>Cantidad</label>
          <input type="number" name="items[0][quantity]" class="form-control" value="1" min="1">
        </div>
        <div class="mb-2">
          <label>Precio</label>
          <input type="number" name="items[0][price]" class="form-control" value="50000">
        </div>

        <!-- Ocultos producto 1 -->
        <input type="hidden" name="items[0][scheme_id]" value="1">
        <input type="hidden" name="items[0][note]" value="">
        <input type="hidden" name="items[0][discount_rate]" value="20">
        <input type="hidden" name="items[0][tax_rate]" value="19.00">
        <input type="hidden" name="items[0][unit_measure_id]" value="70">
        <input type="hidden" name="items[0][standard_code_id]" value="1">
        <input type="hidden" name="items[0][is_excluded]" value="0">
        <input type="hidden" name="items[0][tribute_id]" value="1">
        <input type="hidden" name="items[0][withholding_taxes][0][code]" value="06">
        <input type="hidden" name="items[0][withholding_taxes][0][withholding_tax_rate]" value="7.00">
        <input type="hidden" name="items[0][withholding_taxes][1][code]" value="05">
        <input type="hidden" name="items[0][withholding_taxes][1][withholding_tax_rate]" value="15.00">
        <input type="hidden" name="items[0][mandate][identification_document_id]" value="6">
        <input type="hidden" name="items[0][mandate][identification]" value="123456789">
      </div>

      <!-- Producto 2 -->
      <div class="border rounded p-3 mb-3">
        <div class="mb-2">
          <label>Nombre</label>
          <input type="text" name="items[1][name]" class="form-control" value="producto de prueba 2">
        </div>
        <div class="mb-2">
          <label>Código</label>
          <input type="text" name="items[1][code_reference]" class="form-control" value="54321">
        </div>
        <div class="mb-2">
          <label>Cantidad</label>
          <input type="number" name="items[1][quantity]" class="form-control" value="1" min="1">
        </div>
        <div class="mb-2">
          <label>Precio</label>
          <input type="number" name="items[1][price]" class="form-control" value="50000">
        </div>

        <!-- Ocultos producto 2 -->
        <input type="hidden" name="items[1][scheme_id]" value="0">
        <input type="hidden" name="items[1][note]" value="">
        <input type="hidden" name="items[1][discount_rate]" value="0">
        <input type="hidden" name="items[1][tax_rate]" value="5.00">
        <input type="hidden" name="items[1][unit_measure_id]" value="70">
        <input type="hidden" name="items[1][standard_code_id]" value="1">
        <input type="hidden" name="items[1][is_excluded]" value="0">
        <input type="hidden" name="items[1][tribute_id]" value="1">
      </div>

      <!-- Botón -->
      <button type="submit" class="btn btn-success">Enviar factura</button>
    </form>

  </div>