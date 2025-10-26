<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
        background-color: #0b4454;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    body, div {
        box-sizing: border-box;
    }

    .registrar-container {
        background-color: var(--encabezados-piedepagina);
        color: var(--Color--texto);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        text-align: center;
    }

    .titulo {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
        color: var(--bright-turquoise);
        font-weight: bold;
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
        padding: 15px 18px;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
    }
    .form-select{
        background-color: var(--ebony-clay);
        color: var(--Color--texto);
        border: 1px solid var(--gris-);
        padding: 15px 18px;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: #ccc;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--bright-turquoise);
        background-color: #3a465a;
    }

    .form-floating {
        margin-bottom: 20px;
        width: 100%;
        max-width: 220px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        justify-content: center;
        justify-items: center;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    #boton1 {
        background-color: var(--blue-chill);
        border: none;
        width: 100%;
        max-width: 300px;
        padding: 14px;
        margin-top: 20px;
        border-radius: 8px;
        color: var(--Color--texto);
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #boton1:hover {
        background-color: var(--tarawera);
    }

    #boton-regresar {
        display: block;
        text-align: center;
        background-color: #0a6069;
        padding: 12px;
        margin: 15px auto 0;
        border-radius: 8px;
        color: var(--Color--texto);
        text-decoration: none;
        font-weight: bold;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        max-width: 300px;
    }

    #boton-regresar:hover {
        background-color: var(--tarawera);
    }
     .login__logo img {
            width: 250px;
        }
    @media (max-width: 768px) {
    .registrar-container {
        padding: 20px;
        width: 90%;
    }

    .form-grid {
        grid-template-columns: 1fr !important;
        gap: 15px;
    }

    .form-floating {
        max-width: 100%;
        width: 100%;
    }

    .form-control,
    .form-select {
        width: 100%;
        font-size: 0.9rem;
        padding: 12px 14px;
    }

    .login__logo img {
        width: 180px;
    }

    #boton1,
    #boton-regresar {
        width: 100%;
        max-width: 100%;
        font-size: 0.95rem;
    }
    }

    /* Estilo para los mensajes de error */
    .error-message {
        color: #ff4c4c; /* Rojo brillante legible en fondo oscuro */
        font-weight: 500;
        font-size: 0.9rem;
        margin-top: 5px;
        display: block;
    }

    /* Si quieres resaltar también el borde del input con error */
    .form-control.error,
    .form-select.error {
        border-color: #ff4c4c !important;
        box-shadow: 0 0 6px rgba(255, 76, 76, 0.5);
    }

</style>
</head>
<body>
<div class="registrar-container">
     <div class="login__logo">
            <img src ="../assets/img/logo.png" style="color: white" >
    </div>
    <h2 class="titulo">Registro de Usuario</h2>
    <form id="my-form" method="post" action="<?= base_url('register/add') ?>">
        <?= csrf_field() ?>
       
        <input type="hidden" id="id_usuario" name="id_usuario" value="">
        <input type="hidden" id="updated_at" name="updated_at" value="">

        <div class="form-grid">
            <div class="form-floating mb-3">
                <label for="primer_nombre">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" placeholder="Primer Nombre" required>
                
            </div>

            <div class="form-floating mb-3">
            <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Segundo Nombre">
               
            </div>

            <div class="form-floating mb-3">
            <label for="primer_apellido">Primer Apellido</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" required>
              
            </div>

            <div class="form-floating mb-3">
            <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido">
                
            </div>

            <div class="form-floating mb-3">
            <label for="tipo_documento_id">Tipo de Documento</label>
                <select class="form-select" id="tipo_documento_id" name="tipo_documento_id" required>
                    <option value="">Seleccione un Tipo de Documento</option>
                    <?php foreach ($TipoDocumento as $Tipo) : ?>
                        <option value="<?= $Tipo['id']; ?>"><?= $Tipo['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
              
            </div>

            <div class="form-floating mb-3">
                <label for="ciudad_id">Ciudad</label>
                <select class="form-select" id="ciudad_id" name="ciudad_id" required>
                    <option value="">Seleccione una Ciudad</option>
                    <?php foreach ($Ciudad as $Ciu) : ?>
                        <option value="<?= $Ciu['id']; ?>"><?= $Ciu['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-floating mb-3">
                <label for="documento">Documento</label>
                <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento" required>
                <small class="error-message" id="documento-error"></small>
            </div>

            <div class="form-floating mb-3">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                <small class="error-message" id="correo-error"></small>
            </div>

            <div class="form-floating mb-3">
                <label for="telefono1">Teléfono 1</label>
                <input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="Teléfono 1" required>
                <small class="error-message" id="telefono1-error"></small>
            </div>

            <div class="form-floating mb-3">
                <label for="telefono2">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Teléfono 2" required>
                <small class="error-message" id="telefono2-error"></small>
            </div>

            <div class="form-floating mb-3">
            <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
            </div>

            <div class="form-floating mb-3">
            <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                
            </div>

            <div class="form-floating mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <small class="error-message" id="password-error"></small>
            </div>

            <div class="form-floating mb-3">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                <small class="error-message" id="confirm-error"></small>
            </div>

            
        </div>

        <input type="hidden" id="rol_id" name="rol_id" value="3">
        <input type="hidden" id="estado_usuario_id" name="estado_usuario_id" value="1">

        <button type="submit" id="boton1">Registrar</button>
        <a href="<?= base_url('/usuario/login') ?>" id="boton-regresar">Regresar</a>
    </form>
</div>
<script>
document.getElementById("my-form").addEventListener("submit", function(e) {
    e.preventDefault();

    let valid = true;

    // Limpiar errores de texto y clases visuales
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('error'));

    // Validar correo
    const correoInput = document.getElementById("correo");
    const correo = correoInput.value.trim();
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
        document.getElementById("correo-error").textContent = "Ingrese un correo válido.";
        correoInput.classList.add("error");
        valid = false;
    }

    // Validar contraseña
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    const regexPass = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!regexPass.test(password)) {
        document.getElementById("password-error").textContent = "Mínimo 8 caracteres, una mayúscula, un número y un símbolo.";
        passwordInput.classList.add("error");
        valid = false;
    }

    // Confirmar contraseña
    if (password !== confirmPassword) {
        document.getElementById("confirm-error").textContent = "Las contraseñas no coinciden.";
        confirmPasswordInput.classList.add("error");
        valid = false;
    }

    // Validar teléfono 1
    const tel1Input = document.getElementById("telefono1");
    const tel1 = tel1Input.value.trim();
    if (!/^\d{10}$/.test(tel1)) {
        document.getElementById("telefono1-error").textContent = "Ingrese un número válido (10 dígitos).";
        tel1Input.classList.add("error");
        valid = false;
    }

    // ✅ Validar teléfono 2
    const tel2Input = document.getElementById("telefono2");
    const tel2 = tel2Input.value.trim();
    if (!/^\d{10}$/.test(tel2)) {
        document.getElementById("telefono2-error").textContent = "Ingrese un número válido (10 dígitos).";
        tel2Input.classList.add("error");
        valid = false;
    }

    // ✅ Validar documento
    const documentoInput = document.getElementById("documento");
    const documento = documentoInput.value.trim();
    if (!/^\d{10}$/.test(documento)) {
        document.getElementById("documento-error").textContent = "El documento debe tener 10 dígitos.";
        documentoInput.classList.add("error");
        valid = false;
    }

    // Si todo está bien, enviar el formulario
    if (valid) {
        e.target.submit();
    }
});
</script>


</body>
</html>
