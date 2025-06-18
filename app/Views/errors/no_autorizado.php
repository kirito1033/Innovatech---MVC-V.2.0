<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>No autorizado</title>
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
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--ebony-clay);
      color: var(--Color--texto);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .container {
      background-color: var(--tarawera);
      padding: 40px 60px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      width: 100%;
    }

    h1 {
      color: var(--bright-turquoise);
      margin-bottom: 20px;
      font-size: 28px;
    }

    a {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 24px;
      background-color: var(--atoll);
      color: var(--Color--texto);
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: var(--blue-chill);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>No tienes permiso para acceder a esta página.</h1>
    <a href="/">Volver al inicio</a>
  </div>
</body>
</html>
