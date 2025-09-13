<!-- Contenedor responsive centrado con padding -->
<div class="table-responsive mx-auto p-3">
    <!-- Tabla con clases de Bootstrap para estilos y sombreado -->
    <table class="table table-striped table-hover table-bordered text-center shadow-lg rounded" id="table-index">
        <!-- Encabezado de la tabla con fondo azul y texto blanco -->
        <thead class="table-primary text-white">
        <tr>
            <th scope="col" class="p-3">Número</th>
            <th scope="col" class="p-3">Cliente</th>
            <th scope="col" class="p-3">Identificación</th>
            <th scope="col" class="p-3">Total</th>
            <th scope="col" class="p-3">Estado</th>
            <th scope="col" class="p-3">Tipo</th>
            <th scope="col" class="p-3">Pago</th>
            <th scope="col" class="p-3">Acciones</th>
        </tr>
        </thead>

        <!-- Cuerpo de la tabla con alineación vertical centrada -->
        <tbody class="align-middle">
        <?php if (isset($facturas['data']['data']) && !empty($facturas['data']['data'])): ?>
            <?php foreach ($facturas['data']['data'] as $factura): ?>
            <tr class="fw-bold">
                <td class="p-3"><?= esc($factura['number'] ?? 'N/D') ?></td>
                <td class="p-3"><?= esc($factura['names'] ?? '---') ?></td>
                <td class="p-3"><?= esc($factura['identification'] ?? '---') ?></td>
                <td class="p-3">$<?= number_format($factura['total'] ?? 0, 2) ?></td>
                <td class="p-3">
                <?php 
                    $estado = $factura['status'] ?? null;
                    echo esc($estado === 1 || $estado === '1' ? 'Válida' : ($estado !== null ? 'Pendiente' : 'Desconocido'));
                ?>
                </td>
                <td class="p-3"><?= esc($factura['document']['name'] ?? '---') ?></td>
                <td class="p-3"><?= esc($factura['payment_form']['name'] ?? '---') ?></td>
                <td class="p-3">
                <div class="btn-group" role="group" aria-label="Botones de acción">
                    <a href="<?= base_url('facturas/verQR/' . urlencode($factura['number'])) ?>" target="_blank" class="btn btn-primary btn-sm">
                    <i class="bi bi-qr-code"></i> DIAN
                    </a>
                    <a href="<?= site_url('facturas/pdf/' . $factura['number']) ?>" target="_blank" class="btn btn-info btn-sm">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                </div>
                </td>
            </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
            <td colspan="8" class="p-4 text-muted">No hay facturas para mostrar.</td>
            </tr>
        <?php endif ?>
        </tbody>
    </table>
</div>