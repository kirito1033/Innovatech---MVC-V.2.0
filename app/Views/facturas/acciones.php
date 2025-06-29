<a href="<?= base_url('facturas/verQR/' . urlencode($factura['number'])) ?>" target="_blank" class="btn btn-primary btn-sm">
    <i class="bi bi-qr-code"></i> DIAN
</a>
<a href="<?= site_url('facturas/pdf/' . $factura['number']) ?>" target="_blank" class="btn btn-info btn-sm">
    <i class="bi bi-file-earmark-pdf"></i> PDF
</a>