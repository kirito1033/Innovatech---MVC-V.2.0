<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        :root {
            --encabezados-piedepagina: #020f1f;
            --Color--texto: #0a6069;
            --bright-turquoise: #04ebec;
            --atoll: #0a6069;
            --tarawera: #0b4454;
            --ebony-clay: #f2f2f2;
            --gris: #5a626b;
        }

        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 1rem;
        }

        .titulo-compras {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            background-color: #04ebec;
            color: #0b4454;
            padding: 0.7rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        .titulos {
            color: rgb(4, 179, 179);
        }

        .valor {
            color: #0b4454;
        }


        .btn.btn-pdf {
          background-color: rgb(4, 179, 179) !important;
          color: white !important;
          border: none !important;
        }

        .container-xl-custom {
            max-width: 85%;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .success-box {
          background-color: #fff;
          padding: 3rem;
          border-radius: 1rem;
          box-shadow: 0 0 20px rgb(4, 179, 179);
          width: 100%;
        }

        .success-box h2 {
          color: rgb(4, 179, 179);
        }

        /* Preload */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<header>
    <?= $this->include('partials/header') ?>
</header>

<div class="container-xl-custom">
  <h1 class="titulo-compras mb-4">🧾 Historial de Compras</h1>

  <?php if (empty($compras)): ?>
    <div class="text-center success-box">
      <h2 class="mb-4">No has realizado compras aún.</h2>
    </div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($compras as $compra): ?>
        <?php
          $factura = json_decode($compra['factura_json'], true);
          $total = 0;
          if (isset($factura['items']) && is_array($factura['items'])) {
              foreach ($factura['items'] as $item) {
                  $precio = floatval($item['price'] ?? 0);
                  $cantidad = intval($item['quantity'] ?? 0);
                  $total += $precio * $cantidad;
              }
          }
        ?>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
          <div class="card h-100 p-3 shadow-sm">
            <p><strong class="titulos">Número:</strong> <span class="valor"><?= esc($compra['numero']) ?></span></p>
            <p><strong class="titulos">Referencia:</strong> <span class="valor"><?= esc($compra['reference_code']) ?></span></p>
            <p><strong class="titulos">Fecha:</strong> <span class="valor"><?= date('Y-m-d H:i', strtotime($compra['created_at'])) ?></span></p>
            <p><strong class="titulos">Total:</strong> <span class="valor">$<?= number_format($total, 0, ',', '.') ?></span></p>

            <!-- Boton para descargar factura -->
            <div class="btn-group" role="group" aria-label="Botones de acción">
              <?php if (!empty($compra['numero'])): ?>
                <a href="<?= site_url('facturas/pdf/' . $compra['numero']) ?>" 
                    target="_blank" 
                    class="btn btn-pdf btn-sm">
                  <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
              <?php else: ?>
                <button class="btn btn-secondary btn-sm" title="PDF no disponible">
                  <i class="bi bi-file-earmark-x"></i> PDF
                </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<footer>
    <?php require_once("../app/Views/footer/footerApp.php") ?>
</footer>


</body>
</html>