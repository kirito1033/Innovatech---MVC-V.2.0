<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovatech - Iniciar sesión</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --encabezados-piedepagina: #020f1f;
            --Color--texto: #ffffff;
            --bright-turquoise: #04ebec;
            --Color-enlaces-menu: #272727;
            --atoll: #0a6069;
            --blue-chill: #0f838c;
            --gossamer: #048d94;
            --tarawera: #053543;
            --tarawera: #0b4454;
            --ebony-clay: #2c3443;
            --gris-: #5a626b;
        }

        body {
            background-color: var(--encabezados-piedepagina);
            color: var(--Color--texto);
        }

        .form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }

        .mb-3 {
            width: 50%;
        }

        .btn-ingresar {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .ingresar {
            width: 40%;
        }

        #error__p {
            background-color: transparent;
            border: none;
            display: none;
        }

        #error {
            font-size: 20px;
            font-weight: 600;
            color: red;
        }

        .login__logo img {
            width: 250px;
           
        }

        .login__recuperar,
        .login__registrar {
            margin-top: 10px;
        }

        .login-link {
            color: var(--bright-turquoise);
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <form class="form" id="loginForm">
            <div class="login__logo">
            <img src ="../assets/img/logo.png" style="color: white" >
            </div>

            <div class="login__titulo">
                <h1>Iniciar sesión</h1>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">
                    Aceptas las <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo">Condiciones de uso</a> y el 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo">Aviso de privacidad</a>.
                </label>
            </div>

            <div class="btn-ingresar">
                <button type="submit" class="btn btn-primary ingresar">Ingresar</button>
            </div>

            <div class="login__recuperar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo">¿Olvidaste tu contraseña?</a>
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
                    'X-Requested-With': 'XMLHttpRequest' // Asegura que isAJAX() sea true
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
<div class="modal fade" id="modalEnDesarrollo" tabindex="-1" aria-labelledby="modalEnDesarrolloLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="modalEnDesarrolloLabel">En desarrollo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
      <i class="bi bi-tools" style="font-size: 2rem; color: black;"></i>
      <p class="mt-3" style="color: black !important;">Esta sección está en desarrollo. ¡Muy pronto estará disponible!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>