<!-- Sección para buscar una factura existente por su número -->
<div class="mb-3">
  <label for="numeroFactura">Número de Factura</label>
  <div class="input-group">
    <input type="text" id="numeroFactura" class="form-control" placeholder="Ej. SETP990014304">
    <button type="button" class="btn btn-outline-primary" onclick="buscarFacturaPorNumero()">
      Cargar Factura
    </button>
  </div>
  <div id="errorFactura" class="text-danger mt-1" style="display:none;">Factura no encontrada.</div>
</div>

<!-- SELECT de Tipos de Corrección -->

<!-- Formulario para crear una Nota Crédito basada en una factura existente -->
<form id="formNotaCredito" action="<?= base_url('notas-credito/registrar') ?>" method="post" class="p-4 shadow rounded">

<!-- Selector de tipo de corrección según catálogo DIAN -->
    <div class="mb-3">
    <label for="correction_concept_code">Tipo de corrección</label>
    <select id="correction_concept_code" name="correction_concept_code" class="form-select" required>
        <option value="">-- Selecciona un tipo --</option>
        <option value="1">Devolución parcial de bienes o no aceptación parcial del servicio</option>
        <option value="2">Anulación de factura electrónica</option>
        <option value="3">Rebaja o descuento parcial o total</option>
        <option value="4">Ajuste de precio</option>
        <option value="5">Descuento comercial por pronto pago</option>
        <option value="6">Descuento comercial por volumen de ventas</option>
    </select>
    </div>

  <!-- Campos ocultos requeridos por la estructura de la nota crédito -->
  <input type="hidden" name="numbering_range_id" value="9">
  <input type="hidden" name="customization_id" value="20">
  <input type="hidden" name="bill_id">
  <input type="hidden" name="payment_method_code" value="49">

  <!-- Período de facturación relacionado con la factura original -->
  <input type="hidden" name="billing_period[start_date]">
  <input type="hidden" name="billing_period[start_time]">
  <input type="hidden" name="billing_period[end_date]">
  <input type="hidden" name="billing_period[end_time]">

  <!-- Referencia que se genera automáticamente -->
  <input type="hidden" name="reference_code">

  <!-- Observaciones explicando el motivo de la nota crédito -->
  <div class="mb-3">
    <label for="observation">Motivo / Observación</label>
    <textarea name="observation" id="observation" class="form-control" required></textarea>
  </div>

  <!-- Datos del cliente asociados a la factura -->
  <h5 class="mb-3">Datos del Cliente</h5>
  <div class="mb-2"><label for="identification">Identificación</label>
    <input type="text" name="customer[identification]" id="identification" class="form-control" required>
  </div>
  <div class="mb-2"><label for="names">Nombres</label>
    <input type="text" name="customer[names]" id="names" class="form-control" required>
  </div>
  <div class="mb-2"><label for="address">Dirección</label>
    <input type="text" name="customer[address]" id="address" class="form-control">
  </div>
  <div class="mb-2"><label for="email">Correo</label>
    <input type="email" name="customer[email]" id="email" class="form-control">
  </div>
  <div class="mb-2"><label for="phone">Teléfono</label>
    <input type="text" name="customer[phone]" id="phone" class="form-control">
  </div>

  <!-- Datos ocultos adicionales del cliente -->
  <input type="hidden" name="customer[company]">
  <input type="hidden" name="customer[trade_name]">
  <input type="hidden" name="customer[dv]">
  <input type="hidden" name="customer[legal_organization_id]">
  <input type="hidden" name="customer[tribute_id]">
  <input type="hidden" name="customer[identification_document_id]">
  <input type="hidden" name="customer[municipality_id]">

  <!-- Contenedor donde se insertan los productos a devolver -->
  <div id="itemsContainer">
    <h5 class="mt-4">Producto(s) Devuelto(s)</h5>
  </div>

  <!-- Botón para enviar la nota crédito al backend -->
  <button type="submit" class="btn btn-primary mt-3">
    <i class="bi bi-file-earmark-plus"></i> Crear Nota Crédito
  </button>
</form>

<!-- Script JS para obtener token y cargar factura desde Factus -->
<script>
let token = null;

document.addEventListener('DOMContentLoaded', async () => {
  token = await obtenerToken();

  document.getElementById('numeroFactura').addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      buscarFacturaPorNumero();
    }
  });
});

// Solicita un token JWT al backend para acceder a la API externa
async function obtenerToken() {
  try {
    const response = await fetch('<?= base_url('api/token') ?>');
    const data = await response.json();
    console.log("✅ Token recibido:", data.token);
    return data.token || null;
  } catch (error) {
    console.error('❌ Error al obtener token:', error);
    return null;
  }
}

// Consulta la API de Factus con el número de factura ingresado
function buscarFacturaPorNumero() {
  const numero = document.getElementById('numeroFactura').value.trim();
  const errorMsg = document.getElementById('errorFactura');
  errorMsg.style.display = 'none';

  if (!numero || !token) {
    console.warn("⚠️ Número o token inválido");
    return;
  }

  const url = `https://api-sandbox.factus.com.co/v1/bills/show/${encodeURIComponent(numero)}`;
  console.log("🔍 Consultando factura en:", url);

  fetch(url, {
    headers: {
      'Authorization': 'Bearer ' + token,
      'Content-Type': 'application/json'
    }
  })
  .then(res => res.json())
  .then(data => {
    console.log("📦 Respuesta factura:", data);
    if (!data || !data.data) {
      errorMsg.style.display = 'block';
      return;
    }
    cargarDatosFactura(data.data);
  })
  .catch(err => {
    console.error('❌ Error al buscar factura:', err);
    errorMsg.style.display = 'block';
  });
}

// Llena el formulario con los datos obtenidos desde la API
function cargarDatosFactura(factura) {
  console.log("📋 Cargando datos de factura:", factura);

  const bill = factura.bill;
  if (!bill) {
    console.warn("⚠️ No se encontró el objeto 'bill' dentro de la respuesta:", factura);
    return;
  }

  // General
  document.querySelector('input[name="bill_id"]').value = bill.id || '';
  document.querySelector('input[name="reference_code"]').value = `NC-REF-${bill.id || 'undefined'}`;
  console.log("✅ bill_id:", bill.id);

  const bp = factura.billing_period || {};
  document.querySelector('input[name="billing_period[start_date]"]').value = bp.start_date || '';
  document.querySelector('input[name="billing_period[start_time]"]').value = bp.start_time || '';
  document.querySelector('input[name="billing_period[end_date]"]').value = bp.end_date || '';
  document.querySelector('input[name="billing_period[end_time]"]').value = bp.end_time || '';

  document.getElementById("observation").value = factura.bill?.errors?.join(', ') || '';

  const c = factura.customer || {};
  document.getElementById("identification").value = c.identification || '';
  document.getElementById("names").value = c.names || '';
  document.getElementById("address").value = c.address || '';
  document.getElementById("email").value = c.email || '';
  document.getElementById("phone").value = c.phone || '';

  document.querySelector('input[name="customer[company]"]').value = c.company || '';
  document.querySelector('input[name="customer[trade_name]"]').value = c.trade_name || '';
  document.querySelector('input[name="customer[dv]"]').value = c.dv || '';
  document.querySelector('input[name="customer[legal_organization_id]"]').value = c.legal_organization?.id || '';
  document.querySelector('input[name="customer[tribute_id]"]').value = c.tribute?.id || '';
  document.querySelector('input[name="customer[identification_document_id]"]').value = 3;
  document.querySelector('input[name="customer[municipality_id]"]').value = c.municipality?.id || '';

  // Renderiza los productos como items devueltos
  const itemsContainer = document.getElementById('itemsContainer');
  itemsContainer.innerHTML = '<h5 class="mt-4">Producto(s) Devuelto(s)</h5>';

  factura.items?.forEach((item, i) => {
    const html = `
      <div class="border rounded p-3 mb-3">
        <div class="mb-2"><label>Nombre del producto</label>
          <input type="text" name="items[${i}][name]" class="form-control" value="${item.name || ''}">
        </div>
        <div class="mb-2"><label>Código de referencia</label>
          <input type="text" name="items[${i}][code_reference]" class="form-control" value="${item.code_reference || ''}">
        </div>
        <div class="mb-2"><label>Cantidad</label>
          <input type="number" name="items[${i}][quantity]" class="form-control" value="${item.quantity || 1}">
        </div>
        <div class="mb-2"><label>Precio</label>
          <input type="number" step="any" name="items[${i}][price]" class="form-control" value="${item.price || 0}">
        </div>
        <div class="mb-2"><label>Nota</label>
          <input type="text" name="items[${i}][note]" class="form-control" value="Devolución de factura ${bill.number}">
        </div>
        <input type="hidden" name="items[${i}][discount_rate]" value="${item.discount_rate || 0}">
        <input type="hidden" name="items[${i}][tax_rate]" value="${item.tax_rate || 19}">
        <input type="hidden" name="items[${i}][unit_measure_id]" value="${item.unit_measure_id || 70}">
        <input type="hidden" name="items[${i}][standard_code_id]" value="${item.standard_code_id || 1}">
        <input type="hidden" name="items[${i}][is_excluded]" value="${item.is_excluded || 0}">
        <input type="hidden" name="items[${i}][tribute_id]" value="${item.tribute_id || 1}">
      </div>`;
    itemsContainer.insertAdjacentHTML('beforeend', html);
  });
}
</script>
