<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Codificación del documento en UTF-8 -->
  <meta charset="UTF-8">
  <!-- Título de la pestaña del navegador -->
  <title>Pago Exitoso</title>
  <!-- Bootstrap 5 para estilos y layout responsive -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
  <!-- Contenedor centrado vertical y horizontalmente -->
  <div class="text-center success-box">
    <!-- Mensaje de agradecimiento -->
    <h2 class="mb-4">¡Gracias por tu compra!</h2>
    <!-- Confirmación del pago exitoso -->
    <p class="mb-4">Tu pago fue procesado exitosamente.</p>

    <!-- Botón dinámico según el rol del usuario -->
    <?php if (isset($rol) && $rol === 'admin') : ?>
      <!-- Si el usuario es administrador, redirige a la gestión de facturas -->
      <a href="<?= base_url('/facturas') ?>" class="btn btn-custom-admin px-4">Volver a Facturas</a>
    <?php else : ?>
      <!-- Si es cliente u otro rol, redirige al inicio -->
      <a href="<?= base_url('/') ?>" class="btn btn-custom-client px-4">Volver al Inicio</a>
    <?php endif; ?>
  </div>

  <!-- Script para limpiar el sessionStorage si la compra fue exitosa -->
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      <?php if (isset($compra_exitosa) && $compra_exitosa) : ?>
        // Limpia la información temporal del navegador relacionada a la compra
        console.log('🧹 Limpiando sessionStorage por compra exitosa');
        sessionStorage.clear();
      <?php endif; ?>
    });
  </script>
</body>
</html>