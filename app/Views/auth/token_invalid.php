<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Codificación del documento para caracteres especiales -->
  <meta charset="UTF-8">
  <!-- Título de la pestaña del navegador -->
  <title>Enlace inválido</title>
</head>
<body>

 <!-- Logo de la empresa -->
  <img src="../assets/img/logo.png" alt="Logo" class="login__logo">

  <!-- Mensaje de advertencia sobre el estado del enlace -->
  <h3>Este enlace ya no es válido o ha expirado</h3>

  <!-- Enlace para que el usuario solicite un nuevo link de restablecimiento -->
  <a href="<?= base_url('olvide-password') ?>">Solicitar uno nuevo</a>

</body>
</html>
