<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Codificación UTF-8 y diseño responsivo para móviles -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restablecer contraseña</title>

</head>
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
