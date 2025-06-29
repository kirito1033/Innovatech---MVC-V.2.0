<form id="formFactura" action="<?= base_url('facturas/registrar') ?>" method="post" class="p-4 shadow rounded">

      <!-- Datos ocultos -->
      <input type="hidden" name="numbering_range_id" value="8">
      <input type="hidden" name="reference_code" id="reference_code">
      <input type="hidden" name="observation" value="Pago realizado en la tienda de innovatech">
      <input type="hidden" name="payment_form" value="1">
      <input type="hidden" name="payment_due_date" value="2024-12-30">
      <input type="hidden" name="payment_method_code" value="49">
      <input type="hidden" name="operation_type" value="10">
      <input type="hidden" name="order_reference[reference_code]" value="ref-001">
      <input type="hidden" name="order_reference[issue_date]" value="">


      <!-- Cliente -->
      <h5 class="mb-3">Datos del Cliente</h5>
      <div class="mb-2">
        <label for="identification">Identificación</label>
      <input type="text" name="customer[identification]" id="identification" class="form-control"
       value="<?= esc($usuario['documento']) ?>" required>
      </div>
      <div class="mb-2">
        <label for="names">Nombres</label>
        <input type="text" name="customer[names]" id="names" class="form-control"
       value="<?= esc($usuario['primer_nombre'] . ' ' . ($usuario['segundo_nombre'] ?? '') . ' ' . $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? '')) ?>" required>
      </div>
      <div class="mb-2">
        <label for="address">Dirección</label>
        <input type="text" name="customer[address]" id="address" class="form-control"
       value="<?= esc($usuario['direccion']) ?>">
      </div>
      <div class="mb-2">
        <label for="email">Correo</label>
        <input type="email" name="customer[email]" id="email" class="form-control"
       value="<?= esc($usuario['correo']) ?>">
      </div>
      <div class="mb-2">
        <label for="phone">Teléfono</label>
        <input type="text" name="customer[phone]" id="phone" class="form-control"
       value="<?= esc($usuario['telefono1']) ?>">
      </div>

      <!-- Ocultos cliente -->
      <input type="hidden" name="customer[company]" value="">
      <input type="hidden" name="customer[trade_name]" value="">
      <input type="hidden" name="customer[legal_organization_id]" value="2">
      <input type="hidden" name="customer[tribute_id]" value="21">
      <input type="hidden" name="customer[identification_document_id]" value="3">
      <input type="hidden" name="customer[municipality_id]" value="980">

      <!-- Ítems -->
      <div class="mb-3 d-flex align-items-end gap-2">
        <div class="flex-grow-1">
            <label for="select-producto">Seleccionar producto</label>
            <select id="select-producto" class="form-select">
            <option value="">-- Selecciona un producto --</option>
            <?php foreach ($productos as $producto): ?>
                <option value="<?= esc(json_encode($producto)) ?>">
                <?= esc($producto['nom']) ?> - $<?= esc($producto['precio']) ?>
                </option>
            <?php endforeach; ?>
            </select>
        </div>
        <button type="button" class="btn btn-success" onclick="agregarProducto()">Agregar</button>
        </div>

        <div id="productos-container"></div>


      <!-- Botón -->
      <button type="submit" class="btn btn-success">Enviar factura</button>
      <button type="button" class="btn btn-outline-primary " onclick="prepararPago()"><i class="bi bi-credit-card"></i> Pagar
</button>

</form>
<form id="formPayU" method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="hidden" value="508029">
  <input name="accountId"     type="hidden" value="512321">
  <input name="description"   type="hidden" value="Factura electrónica">
  <input name="referenceCode" type="hidden" id="payu_refcode">
  <input name="amount"        type="hidden" id="payu_amount">
  <input name="tax"           type="hidden" value="0">
  <input name="taxReturnBase" type="hidden" value="0">
  <input name="currency"      type="hidden" value="COP">
  <input name="signature"     type="hidden" id="payu_signature">
  <input name="test"          type="hidden" value="1">
  <input name="buyerEmail"    type="hidden" id="payu_email">

  <!-- Rutas a crear -->
  <input name="responseUrl"   type="hidden" value="<?= base_url('facturas/respuesta') ?>">
  <input name="confirmationUrl" type="hidden" value="https://2bd0-179-51-111-179.ngrok-free.app/facturas/confirmacion">
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
<script>
function calcularTotalFactura() {
  const precios = document.querySelectorAll('input[name^="items"][name$="[price]"]');
  const cantidades = document.querySelectorAll('input[name^="items"][name$="[quantity]"]');

  let total = 0;
  for (let i = 0; i < precios.length; i++) {
    const precio = parseFloat(precios[i].value) || 0;
    const cantidad = parseInt(cantidades[i].value) || 0;
    total += precio * cantidad;
  }

  return total.toFixed(2);
}

function prepararPago() {
  const reference = 'ref_' + Date.now();
  const email = document.getElementById("email").value;
  const amount = calcularTotalFactura();
  const apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
  const merchantId = "508029";
  const currency = "COP";

  const signatureRaw = `${apiKey}~${merchantId}~${reference}~${amount}~${currency}`;
  const signature = md5(signatureRaw);

  document.getElementById("payu_refcode").value = reference;
  document.getElementById("payu_amount").value = amount;
  document.getElementById("payu_signature").value = signature;
  document.getElementById("payu_email").value = email;

  // 🔁 Guarda la factura en la DB
  const form = document.getElementById("formFactura");
  const formData = new FormData(form);
  formData.append('reference_code', reference);

  fetch("<?= base_url('facturas/guardar-temporal') ?>", {
    method: "POST",
    body: formData,
  }).then(() => {
    document.getElementById("formPayU").submit();
  });
}


</script>


<script>
  let itemIndex = 0;

  function agregarProducto() {
    const select = document.getElementById("select-producto");
    const container = document.getElementById("productos-container");

    if (!select.value) return alert("Selecciona un producto");

    const producto = JSON.parse(select.value);

    const html = `
      <div class="border rounded p-3 mb-3">
        <h6>Producto: ${producto.nom}</h6>
        <div class="mb-2">
          <label>Nombre</label>
          <input type="text" name="items[${itemIndex}][name]" class="form-control" value="${producto.nom}">
        </div>
        <div class="mb-2">
          <label>Código</label>
          <input type="text" name="items[${itemIndex}][code_reference]" class="form-control" value="${producto.id}">
        </div>
        <div class="mb-2">
          <label>Cantidad</label>
          <input type="number" step="any" name="items[${itemIndex}][quantity]" class="form-control" value="1" min="1">
        </div>
        <div class="mb-2">
          <label>Precio</label>
          <input type="number" step="any" name="items[${itemIndex}][price]" class="form-control" value="${producto.precio}">
        </div>

        <!-- Ocultos -->
        <input type="hidden" name="items[${itemIndex}][scheme_id]" value="0">
        <input type="hidden" name="items[${itemIndex}][note]" value="">
        <input type="hidden" name="items[${itemIndex}][discount_rate]" value="0">
        <input type="hidden" name="items[${itemIndex}][tax_rate]" value="19.00">
        <input type="hidden" name="items[${itemIndex}][unit_measure_id]" value="70">
        <input type="hidden" name="items[${itemIndex}][standard_code_id]" value="1">
        <input type="hidden" name="items[${itemIndex}][is_excluded]" value="0">
        <input type="hidden" name="items[${itemIndex}][tribute_id]" value="1">
        <input type="hidden" name="items[${itemIndex}][withholding_taxes][0][code]" value="06">
        <input type="hidden" name="items[${itemIndex}][withholding_taxes][0][withholding_tax_rate]" value="7.00">
        <input type="hidden" name="items[${itemIndex}][withholding_taxes][1][code]" value="05">
        <input type="hidden" name="items[${itemIndex}][withholding_taxes][1][withholding_tax_rate]" value="15.00">
        <input type="hidden" name="items[${itemIndex}][mandate][identification_document_id]" value="6">
        <input type="hidden" name="items[${itemIndex}][mandate][identification]" value="123456789">
      </div>
    `;

    container.insertAdjacentHTML("beforeend", html);
    itemIndex++;
  }
   // Función para obtener el siguiente código en formato I###
  
</script>

  </div>