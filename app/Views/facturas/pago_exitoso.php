<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pago Exitoso</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    :root {
      --atoll: #0a6069;
      --blue-chill: #0f838c;
      --bright-turquoise: #04ebec;
      --Color--texto: #ffffff;
    }

    body {
      background-color: #f2f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .success-card {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      padding: 40px;
      max-width: 500px;
      width: 100%;
      text-align: center;
    }

    .success-title {
      color: var(--blue-chill);
      font-weight: 600;
    }

    .success-message {
      color: #555;
      margin-bottom: 30px;
    }

    .btn-innovatech {
      background-color: var(--bright-turquoise);
      color: #000;
      border: none;
      font-weight: 500;
    }

    .btn-innovatech:hover {
      background-color: var(--atoll);
      color: #fff;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

  <div class="success-card">
    <h2 class="success-title">¡Gracias por tu compra!</h2>
    <p class="success-message">Tu pago fue procesado exitosamente. 🎉</p>
    <a href="<?= base_url('/facturas') ?>" class="btn btn-innovatech px-4 py-2 rounded">Ver mis facturas</a>
  </div>

</body>
</html>
