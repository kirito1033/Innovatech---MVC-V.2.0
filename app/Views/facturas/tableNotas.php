<!-- Contenedor responsive con padding y centrado -->
<div class="table-responsive mx-auto p-3">
  <!-- Tabla con estilos Bootstrap y clases de formato -->
  <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
    <!-- Cabecera de la tabla con fondo azul y texto blanco -->
    <thead class="table-primary text-white">
      <tr>
        <th scope="col" class="p-3">Número</th>
        <th scope="col" class="p-3">Cliente</th>
        <th scope="col" class="p-3">Identificación</th>
        <th scope="col" class="p-3">Total</th>
        <th scope="col" class="p-3">Estado</th>
        <th scope="col" class="p-3">Referencia</th>
        <th scope="col" class="p-3">Creado</th>
        <th scope="col" class="p-3">Acciones</th>
      </tr>
    </thead>

     <!-- Cuerpo de la tabla -->
    <tbody class="align-middle">
      <!-- Verifica que existan datos en el arreglo $notas['data']['data'] -->
      <?php if (isset($notas['data']['data']) && !empty($notas['data']['data'])): ?>
        <!-- Recorre cada nota y muestra su información -->
        <?php foreach ($notas['data']['data'] as $nota): ?>
          <tr class="fw-bold">
            <!-- Número de nota -->
            <td class="p-3"><?= esc($nota['number'] ?? 'N/D') ?></td>
            <!-- Nombre del cliente o razón social (alternativa) -->
            <td class="p-3"><?= esc($nota['names'] ?? $nota['graphic_representation_name'] ?? '---') ?></td>
            <!-- Identificación del cliente -->
            <td class="p-3"><?= esc($nota['identification'] ?? '---') ?></td>
            <!-- Total formateado con separador de miles y decimales -->
            <td class="p-3">$<?= number_format(floatval($nota['total'] ?? 0), 2, ',', '.') ?></td>
            <!-- Estado de la nota: válida o pendiente -->
            <td class="p-3">
              <?php 
                $estado = $nota['status'] ?? null;
                echo esc($estado === 1 || $estado === '1' ? 'Válida' : ($estado !== null ? 'Pendiente' : 'Desconocido'));
              ?>
            </td>
             <!-- Código de referencia relacionado a la factura -->
            <td class="p-3"><?= esc($nota['reference_code'] ?? '---') ?></td>
            <!-- Fecha de creación -->
            <td class="p-3"><?= esc($nota['created_at'] ?? '---') ?></td>
            <!-- Botones de acción -->
            <td class="p-3">
              <div class="btn-group" role="group">
              
              <!-- Ver PDF -->
               <button
                type="button"
                class="btn btn-outline-danger"
                onclick="verNotaPDF('<?= esc($nota['number']) ?>')"
                >
                <i class="bi bi-file-earmark-pdf-fill"></i> Ver PDF
                </button>
                <!-- Ver QR DIAN -->
                <button
                type="button"
                class="btn btn-primary btn-sm"
                onclick="abrirQRNotaCredito('<?= esc($nota['number']) ?>')"
                >
                <i class="bi bi-qr-code"></i> DIAN
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        <!-- Si no hay notas -->
      <?php else: ?>
        <tr>
          <td colspan="8" class="p-4 text-muted">No hay notas crédito para mostrar.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<script>

  // Espera a que el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  // Función para obtener y mostrar el PDF de una nota crédito
  window.verNotaPDF = async function(numeroNota) {
    try {
       // Solicita token desde tu API local
      const tokenResponse = await fetch("<?= base_url('api/token') ?>");
      const tokenData = await tokenResponse.json();
      const token = tokenData.token;

      if (!token) throw new Error("No se pudo obtener el token.");

      // Llama a la API de Factus para obtener el PDF codificado en base64
      const url = `https://api-sandbox.factus.com.co/v1/credit-notes/download-pdf/${encodeURIComponent(numeroNota)}`;
      const response = await fetch(url, {
        headers: {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
      });

      const data = await response.json();

       // Validación de respuesta
      if (!data || data.status !== "OK" || !data.data?.pdf_base_64_encoded) {
        throw new Error("Respuesta inválida o sin PDF.");
      }

      // Decodifica el PDF base64 y crea un blob
      const base64 = data.data.pdf_base_64_encoded;
      const binary = atob(base64);
      const len = binary.length;
      const bytes = new Uint8Array(len);
      for (let i = 0; i < len; i++) {
        bytes[i] = binary.charCodeAt(i);
      }

      // Crea una URL temporal para abrir el PDF en otra pestaña
      const blob = new Blob([bytes], { type: 'application/pdf' });
      const blobUrl = URL.createObjectURL(blob);

      // Abrir en nueva pestaña
      window.open(blobUrl, '_blank');

    } catch (err) {
      console.error("❌ Error al abrir PDF:", err);
      alert("No se pudo abrir la nota crédito en PDF.");
    }
  };
});

// Función global para abrir el QR de una nota crédito
async function abrirQRNotaCredito(numeroNota) {
  try {
    // Obtener token de autenticación
    const tokenRes = await fetch("<?= base_url('api/token') ?>");
    const tokenData = await tokenRes.json();
    const token = tokenData.token;

    // Llama al endpoint de Factus para obtener los datos de la nota
    const url = `https://api-sandbox.factus.com.co/v1/credit-notes/${encodeURIComponent(numeroNota)}`;
    const response = await fetch(url, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'application/json'
      }
    });

    const data = await response.json();
    console.log("QR:", data);

    const qrUrl = data?.data?.credit_note?.qr;

    // Si el QR está disponible, lo abre en otra pestaña
    if (data?.status === "OK" && qrUrl) {
      window.open(qrUrl, '_blank');
    } else {
      alert("QR no disponible para esta nota.");
    }
  } catch (err) {
    console.error("❌ Error al obtener QR:", err);
    alert("No se pudo abrir el QR de la nota crédito.");
  }
}

</script>

