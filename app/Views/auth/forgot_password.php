<!DOCTYPE html>
<html lang="es">
<head>

<!-- Metadatos básicos para codificación y diseño responsive -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restablecer Contraseña</title>
    
   
</head>
<body>
  <!-- Contenedor del formulario -->
  <div class="login-container">

  <!-- Logo institucional -->
    <div class="login__logo">
      <img src="../assets/img/logo.png" alt="Logo">
    </div>

    <!-- Título -->
    <h1>Restablecer contraseña</h1>
    
    <!-- Formulario de envío del correo para restablecer contraseña -->
    <form method="post" action="<?= base_url('send-reset-link') ?>">
      <?= csrf_field() ?> <!-- Protección CSRF de CodeIgniter -->

       <!-- Campo de correo electrónico -->
      <div class="mb-3">
        <label for="correo">Correo electrónico</label>
        <input type="email" name="correo" id="correo" class="form-control" placeholder="Tu correo" required>
      </div>

      <!-- Botón para enviar el formulario -->
      <button type="submit" class="btn-ingresar">Enviar enlace</button>
    </form>

    <!-- Botón secundario para volver al login -->
    <a href="<?= base_url('usuario/login') ?>" class="btn-secondary">Volver a login</a>
  </div>
</body>
</html>