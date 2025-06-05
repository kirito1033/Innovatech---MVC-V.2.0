<form method="post" action="<?= base_url('update-password') ?>" class="form" id="resetPasswordForm">
  <img src ="../assets/img/logo.png" style="color: white" class="login__logo">
  <?= csrf_field() ?>
  <input type="hidden" name="token" value="<?= $token ?>">
  
  <div class="mb-3">
    <label for="password">Nueva contraseña</label>
    <input type="password" name="password" id="password" placeholder="Nueva contraseña" required>
  </div>
  
  <div class="mb-3">
    <label for="confirm_password">Confirmar contraseña</label>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirma tu contraseña" required>
  </div>

  <div class="mb-3" style="width: 250px; display: flex; align-items: center; gap: 8px;">
    <input type="checkbox" id="showPasswords">
    <label for="showPasswords" style="color: var(--bright-turquoise); cursor: pointer; user-select: none;">Mostrar contraseña</label>
  </div>
  
  <div id="error-message" style="color: #ff6b6b; font-weight: 600; display:none; margin-bottom: 10px;">
    Las contraseñas no coinciden.
  </div>
  
  <button type="submit">Actualizar contraseña</button>
</form>

<div class="btn-container">
  <a href="<?= base_url('usuario/login') ?>" class="btn-back">Volver a login</a>
</div>

<script>
  const form = document.getElementById('resetPasswordForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');
  const errorMessage = document.getElementById('error-message');
  const showPasswordsCheckbox = document.getElementById('showPasswords');

  form.addEventListener('submit', function(e) {
    if (password.value !== confirmPassword.value) {
      e.preventDefault(); // Evitar envío del formulario
      errorMessage.style.display = 'block';
      confirmPassword.focus();
    } else {
      errorMessage.style.display = 'none';
    }
  });

  showPasswordsCheckbox.addEventListener('change', function() {
    const type = this.checked ? 'text' : 'password';
    password.type = type;
    confirmPassword.type = type;
  });
</script>

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
}

.form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 5%;
}

.mb-3 {
    width: 250px; /* Ancho fijo para input */
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
}

.mb-3 label {
    margin-bottom: 0.4rem;
    font-weight: 600;
    color: var(--bright-turquoise);
}

.mb-3 input[type="password"],
.mb-3 input[type="text"] {
    width: 100%;
    padding: 8px 10px;
    border-radius: 6px;
    border: none;
    font-size: 0.9rem;
    color: var(--tarawera);
    outline: none;
}

.mb-3 input[type="password"]:focus,
.mb-3 input[type="text"]:focus {
    box-shadow: 0 0 5px var(--bright-turquoise);
}

form button, .btn-back {
    background-color: var(--bright-turquoise);
    color: var(--encabezados-piedepagina);
    border: none;
    padding: 10px 0;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 250px; /* Mismo ancho */
    margin-top: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

form button:hover, .btn-back:hover {
    background-color: var(--gossamer);
}

.btn-container {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    font-size: 0.9rem;
}

.login__logo {
    width: 250px;
    margin-bottom: 20px;
}
</style>
