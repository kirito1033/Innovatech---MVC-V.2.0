<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restablecer Contraseña</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

    :root {
      --primary-bg: #1e2a44; /* Dark blue for background */
      --container-bg: #2a3652; /* Container background */
      --text-color: #e6edf3; /* Soft white text */
      --accent-color: #00b4b8; /* Teal accent */
      --button-primary: #00c4cc; /* Primary button */
      --button-hover: #008a8e; /* Button hover */
      --border-color: #6b7280; /* Border gray */
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
        background-color: #0b4454;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-container {
      background: #020f1f;
      backdrop-filter: blur(8px);
      color: var(--text-color);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 450px;
      text-align: center;
    }

    .login__logo img {
      width: 180px;
      margin-bottom: 1rem;
    }

    h1 {
      font-size: 1.75rem;
      font-weight: 600;
      color: var(--accent-color);
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--accent-color);
      text-align: left;
      font-size: 0.95rem;
    }

    .form-control {
      background-color: var(--container-bg);
      color: var(--text-color);
      border: 1px solid var(--border-color);
      padding: 0.75rem;
      border-radius: 8px;
      width: 100%;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: #a0aec0;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--accent-color);
      box-shadow: 0 0 6px rgba(0, 180, 184, 0.3);
    }

    .btn-ingresar {
      background-color: var(--button-primary);
      border: none;
      width: 100%;
      padding: 0.85rem;
      margin-top: 1.25rem;
      border-radius: 8px;
      color: var(--text-color);
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-ingresar:hover {
      background-color: var(--button-hover);
      transform: translateY(-2px);
    }

    .btn-secondary {
      display: block;
      background-color: var(--container-bg);
      border: 1px solid var(--border-color);
      padding: 0.85rem;
      margin-top: 1rem;
      border-radius: 8px;
      color: var(--accent-color);
      font-weight: 600;
      font-size: 1rem;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      background-color: var(--button-hover);
      color: var(--text-color);
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login__logo">
      <img src="../assets/img/logo.png" alt="Logo">
    </div>
    <h1>Restablecer contraseña</h1>
    
    <form method="post" action="<?= base_url('send-reset-link') ?>">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="correo">Correo electrónico</label>
        <input type="email" name="correo" id="correo" class="form-control" placeholder="Tu correo" required>
      </div>
      <button type="submit" class="btn-ingresar">Enviar enlace</button>
    </form>

    <a href="<?= base_url('usuario/login') ?>" class="btn-secondary">Volver a login</a>
  </div>
</body>
</html>