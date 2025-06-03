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
        background-color: var(--encabezados-piedepagina);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    body, div {
        box-sizing: border-box;
    }

    .registrar-container {
        font-size: 15px;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 550px;
        padding: 25px 30px;
        color: var(--Color--texto);
        border-radius: 12px;
        background-color: rgba(44, 52, 67, 0.85);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        margin: auto;
    }

    .titulo {
        text-align: center;
        margin-bottom: 25px;
        font-size: 1.6rem;
        color: var(--bright-turquoise);
    }

    .form-control,
    .form-select {
        border: 1px solid var(--gris-);
        border-radius: 6px;
        padding: 10px;
        width: 100%;
        background-color: var(--ebony-clay);
        color: var(--Color--texto);
        transition: border 0.2s, background-color 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--bright-turquoise);
        background-color: #3a465a;
    }

    label {
        margin-top: 6px;
        color: var(--bright-turquoise);
    }

    .form-floating {
        margin-bottom: 15px;
    }

    #boton1 {
        background-color: var(--blue-chill);
        border: none;
        width: 100%;
        margin-top: 20px;
        padding: 12px;
        border-radius: 6px;
        color: var(--Color--texto);
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #boton1:hover {
        background-color: var(--tarawera);
    }

    #boton-regresar {
        display: block;
        text-align: center;
        background-color: var(--gossamer);
        padding: 10px;
        margin-top: 12px;
        border-radius: 6px;
        color: var(--Color--texto);
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    #boton-regresar:hover {
        background-color: var(--tarawera);
    }

    .logo-registrar {
        margin-bottom: 10px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .registrar-container {
            max-width: 600px;
            padding: 30px;
        }
    }

    @media (min-width: 1024px) {
        .registrar-container {
            max-width: 650px;
            padding: 35px;
        }
    }
</style>
</head>
<body>
<div class="registrar-container">
    <h2 class="titulo">Registro de Usuario</h2>
    <form id="my-form" method="post" action="<?= base_url('usuario/add') ?>">
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
            <label for="documento">Documento</label>
                <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento" required>
               
            </div>

            <div class="form-floating mb-3">
            <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
             
            </div>

            <div class="form-floating mb-3">
            <label for="telefono1">Teléfono 1</label>
                <input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="Teléfono 1" required>
              
            </div>

            <div class="form-floating mb-3">
            <label for="telefono2">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Teléfono 2">
                
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
               
            </div>

            <div class="form-floating mb-3">
            <label for="ciudad_id">Ciudad</label>
                <select class="form-select" id="ciudad_id" name="ciudad_id" required>
                    <option value="">Seleccione una Ciudad</option>
                    <?php foreach ($Ciudad as $Ciu) : ?>
                        <option value="<?= $Ciu['id']; ?>"><?= $Ciu['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
               
            </div>
        </div>

        <input type="hidden" id="rol_id" name="rol_id" value="3">
        <input type="hidden" id="estado_usuario_id" name="estado_usuario_id" value="1">

        <button type="submit" id="boton1">Registrar</button>
        <a href="<?= base_url('/usuario/login') ?>" id="boton-regresar">Regresar</a>
    </form>
</div>
</body>
</html>
