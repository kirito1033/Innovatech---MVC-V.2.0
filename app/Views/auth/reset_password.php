<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Codificación UTF-8 y diseño responsivo para móviles -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restablecer contraseña</title>

</head>
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
      color: var(--Color--texto);
    }

    .form {
      background-color: var(--encabezados-piedepagina);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
      width: 100%;
      max-width: 400px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .login__logo {
      width: 200px;
      margin-bottom: 20px;
    }

    .mb-3 {
      width: 100%;
      display: flex;
      flex-direction: column;
      margin-bottom: 1rem;
    }

    .mb-3 label {
      margin-bottom: 6px;
      font-weight: 600;
      color: var(--bright-turquoise);
    }

    .mb-3 input[type="password"],
    .mb-3 input[type="text"] {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid var(--bright-turquoise);
      background-color: transparent;
      color: var(--Color--texto);
      font-size: 0.95rem;
    }

    .mb-3 input::placeholder {
      color: #cccccc;
    }

    .mb-3 input:focus {
      outline: none;
      border-color: var(--bright-turquoise);
      background-color: transparent;
      box-shadow: 0 0 5px var(--bright-turquoise);
    }

    #showPasswords {
      accent-color: var(--bright-turquoise);
    }

    #error-message {
      color: #ff6b6b;
      font-weight: bold;
      display: none;
      margin-bottom: 10px;
    }

    button{
      background-color: var(--blue-chill);
      color: var(--Color--texto);
      border: none;
      padding: 15px 0;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      max-width: 250px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }
    .btn-back{
      background-color: var(--blue-chill);
      color: var(--Color--texto);
      border: none;
      padding: 12px 0;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      max-width: 250px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }

    button:hover,
    .btn-back:hover {
      background-color: var(--gossamer);
    }

    .btn-container {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }

    .show-password-container {
      display: flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      max-width: 250px;
    }

    .show-password-container label {
      font-size: 0.95rem;
      color: var(--bright-turquoise);
      cursor: pointer;
      user-select: none;
    }
  </style>
<body>

<!-- Formulario para actualizar la contraseña del usuario -->
  <form method="post" action="<?= base_url('update-password') ?>" class="form" id="resetPasswordForm">
    
    <!-- Logo de la empresa -->
    <img src="../assets/img/logo.png" class="login__logo" alt="Logo" />
    <!-- Protección CSRF de CodeIgniter -->
    <?= csrf_field() ?>

    <!-- Token oculto que permite validar la solicitud de restablecimiento -->
    <input type="hidden" name="token" value="<?= $token ?>" />
    
    <!-- Campo para nueva contraseña -->
    <div class="mb-3">
      <label for="password">Nueva contraseña</label>
      <input type="password" name="password" id="password" placeholder="Nueva contraseña" required />
    </div>
    
    <!-- Campo para confirmar la nueva contraseña -->
    <div class="mb-3">
      <label for="confirm_password">Confirmar contraseña</label>
      <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirma tu contraseña" required />
    </div>

    <!-- Opción para mostrar u ocultar las contraseñas ingresadas -->
    <div class="show-password-container">
      <input type="checkbox" id="showPasswords" />
      <label for="showPasswords">Mostrar contraseña</label>
    </div>

    <!-- Mensaje de error si las contraseñas no coinciden -->
    <div id="error-message">Las contraseñas no coinciden.</div>
    
    <!-- Botón para enviar el formulario -->
    <button type="submit">Actualizar contraseña</button>

    <!-- Enlace para volver al login -->
    <a href="<?= base_url('usuario/login') ?>" class="btn-back">Volver a login</a>
  </form>

  <!-- Script para validación de contraseñas y mostrar/ocultar -->
  <script>
    const form = document.getElementById('resetPasswordForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const errorMessage = document.getElementById('error-message');
    const showPasswordsCheckbox = document.getElementById('showPasswords');

    // Validar que ambas contraseñas coincidan antes de enviar
    form.addEventListener('submit', function (e) {
      if (password.value !== confirmPassword.value) {
        e.preventDefault();  // Previene el envío del formulario
        errorMessage.style.display = 'block';
        confirmPassword.focus(); // Enfoca el campo para corregir
      } else {
        errorMessage.style.display = 'none';
      }
    });

    // Alternar visibilidad de las contraseñas con checkbox
    showPasswordsCheckbox.addEventListener('change', function () {
      const type = this.checked ? 'text' : 'password';
      password.type = type;
      confirmPassword.type = type;
    });
  </script>

</body>
</html>
