<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pago Exitoso</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    :root {
      --encabezados-piedepagina: #020f1f;
      --Color--texto: #0a6069;
      --bright-turquoise:rgb(4, 179, 179);
      --atoll: #0a6069;
      --tarawera: #0b4454;
      --ebony-clay: #f2f2f2;
      --gris: #5a626b;
    }

    body {
      background-color: var(--tarawera) !important;
      color: var(--atoll);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .success-box {
      background-color: #fff;
      padding: 3rem;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 100%;
    }

    h2 {
      color: var(--bright-turquoise);
      font-weight: 700;
    }

    .btn-custom-admin {
      background-color: var(--atoll);
      color: white;
      border: none;
    }

    .btn-custom-admin:hover {
      background-color: var(--tarawera);
      color: white;
    }

    .btn-custom-client {
      background-color: var(--bright-turquoise);
      color: white;
      border: none;
    }

    .btn-custom-client:hover {
      background-color: var(--atoll);
      color: white;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="text-center success-box">
    <h2 class="mb-4">¡Gracias por tu compra!</h2>
    <p class="mb-4">Tu pago fue procesado exitosamente.</p>

    <?php if (isset($rol) && $rol === 'admin') : ?>
      <a href="<?= base_url('/facturas') ?>" class="btn btn-custom-admin px-4">Volver a Facturas</a>
    <?php else : ?>
      <a href="<?= base_url('/') ?>" class="btn btn-custom-client px-4">Volver al Inicio</a>
    <?php endif; ?>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      <?php if (isset($compra_exitosa) && $compra_exitosa) : ?>
        console.log('🧹 Limpiando sessionStorage por compra exitosa');
        sessionStorage.clear();
      <?php endif; ?>
    });
  </script>
</body>
</html>