<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Innovatech - Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

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
      font-family: 'Segoe UI', Roboto, sans-serif;
      background-color: var(--tarawera);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-container {
      background-color: var(--encabezados-piedepagina);
      color: var(--Color--texto);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }

    .login__logo img {
      width: 200px;
      margin-bottom: 15px;
    }

    h1 {
      font-size: 1.8rem;
      font-weight: bold;
      color: var(--bright-turquoise);
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: var(--bright-turquoise);
      text-align: left;
    }

    .form-control {
      background-color: var(--ebony-clay);
      color: var(--Color--texto);
      border: 1px solid var(--gris-);
      padding: 10px;
      border-radius: 8px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--bright-turquoise);
      background-color: #3a465a;
    }

    .form-check-label {
      font-size: 0.95rem;
      text-align: left;
      color: var(--Color--texto);
    }

    .form-check-label a {
      color: var(--bright-turquoise);
      text-decoration: underline;
    }

    .btn-ingresar {
      background-color: var(--blue-chill);
      border: none;
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border-radius: 8px;
      color: var(--Color--texto);
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-ingresar:hover {
      background-color: var(--tarawera);
    }

    .btn-secondary {
      background-color: var(--gossamer);
      border: none;
      margin-top: 10px;
      width: 100%;
    }

    .btn-secondary:hover {
      background-color: var(--tarawera);
    }

    .login__recuperar a {
      color: var(--bright-turquoise);
      text-decoration: underline;
      display: block;
      margin-top: 12px;
    }

    .alert-danger {
      margin-top: 20px;
      display: none;
      font-weight: bold;
      color: red;
    }
    .form-control {
    background-color: transparent;
    color: var(--Color--texto);
    border: 1px solid var(--bright-turquoise);
    }

    .form-control::placeholder {
        color: #cccccc;
    }

    .form-control:focus {
        background-color: transparent;
        color: var(--Color--texto);
        border-color: var(--bright-turquoise);
        box-shadow: none;
    }

  </style>
</head>
<body>
  <div class="login-container">
    <form id="loginForm">
      <div class="login__logo">
        <img src="../assets/img/logo.png" alt="Logo Innovatech">
      </div>

      <h1>Iniciar sesión</h1>

      <div class="mb-3 text-start">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
      </div>

      <div class="mb-3 form-check text-start">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1">
          Aceptas las <a href="/condiciones" target="_blank">Condiciones de uso</a> y el 
          <a href="/terminos" target="_blank">Aviso de privacidad</a>.
        </label>
      </div>

      <button type="submit" class="btn-ingresar">Ingresar</button>

      <div class="login__recuperar">
        <a href="/olvide-password">¿Olvidaste tu contraseña?</a>
      </div>

      <div class="login__registrar">
        <a href="/register" class="btn btn-secondary">Crear cuenta</a>
      </div>

      <div class="alert alert-danger mt-3" id="error__p">
        <p id="error">Email o contraseña incorrecta, vuelva a intentarlo nuevamente</p>
      </div>
    </form>
  </div>

  <!-- Script -->
  <script>
    document.getElementById('loginForm').addEventListener('submit', async function (e) {
      e.preventDefault();

      const usuario = document.getElementById('usuario').value;
      const password = document.getElementById('password').value;

      const response = await fetch('/usuario/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ usuario, password })
      });

      const data = await response.json();

      if (data.status === 'error') {
        document.getElementById('error__p').style.display = 'block';
        document.getElementById('error').innerText = data.message || 'Error desconocido';
      } else if (data.token) {
        localStorage.setItem('token', data.token);
        window.location.href = data.redirect;
      }
    });
  </script>
</body>
</html>