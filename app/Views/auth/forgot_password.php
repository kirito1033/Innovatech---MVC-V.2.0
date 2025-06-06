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

.mb-3 input[type="email"] {
    width: 100%;
    padding: 8px 10px;
    border-radius: 6px;
    border: none;
    font-size: 0.9rem;
    color: var(--tarawera);
    outline: none;
}

.mb-3 input[type="email"]:focus {
    box-shadow: 0 0 5px var(--bright-turquoise);
}

.btn-ingresar {
    width: 250px; /* Mismo ancho que input */
    margin-top: 15px;
    display: flex;
    justify-content: center;
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
      font-size: 0.9rem;}

        .login__logo{
            width: 250px;
           
        }
</style>


<form method="post" action="<?= base_url('send-reset-link') ?>" class="form">
    <img src ="../assets/img/logo.png" style="color: white" class="login__logo">
  <?= csrf_field() ?>
  <div class="mb-3">
    <label for="correo">Restablecer contraseña</label>
    <input type="email" name="correo" id="correo" placeholder="Tu correo" required>
  </div>
  <button type="submit">Enviar enlace</button>
</form>

<div class="btn-container">
  <a href="<?= base_url('usuario/login') ?>" class="btn-back">Volver a login</a>
</div>