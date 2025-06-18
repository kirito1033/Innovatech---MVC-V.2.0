<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Enlace inválido</title>
  <style>
    :root {
      --encabezados-piedepagina: #020f1f;
      --Color--texto: #ffffff;
      --bright-turquoise: #04ebec;
      --Color-enlaces-menu: #272727;
      --atoll: #0a6069;
      --blue-chill: #0f838c;
      --gossamer: #048d94;
      --tarawera: #0b4454;
      --ebony-clay: #2c3443;
      --gris-: #5a626b;
    }

    body {
      background-color: var(--encabezados-piedepagina);
      color: var(--Color--texto);
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      text-align: center;
      padding: 20px;
    }

    h3 {
      color: var(--bright-turquoise);
      font-weight: 700;
      margin-top: 20px;
      margin-bottom: 16px;
      font-size: 1.2rem;
    }

    a {
      color: var(--bright-turquoise);
      font-weight: 600;
      text-decoration: underline;
      font-size: 1rem;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    a:hover {
      color: var(--gossamer);
    }

    .login__logo {
      width: 250px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <img src="../assets/img/logo.png" alt="Logo" class="login__logo">
  <h3>Este enlace ya no es válido o ha expirado</h3>
  <a href="<?= base_url('olvide-password') ?>">Solicitar uno nuevo</a>

</body>
</html>
