<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Cuánto se demoran en entregar mi producto? - Inovatech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .tiempo-entrega {
            background-color: var(--encabezados-piedepagina, #020f1f);
            color: var(--Color--texto, #ffffff);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            min-height: 80vh;
            position: relative;
            text-align: center;
        }

        .logo-container {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
        }

        .logo-container img {
            max-width: 150px;
            height: auto;
        }

        .content-wrapper {
            margin-top: 150px;
            position: relative;
            z-index: 200;
            text-align: center;
        }

        .tiempo-entrega h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .tiempo-entrega h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .tiempo-entrega p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .tiempo-entrega ul {
            text-align: left;
            display: inline-block;
            margin: 0 auto;
        }

        .tiempo-entrega ul li {
            margin-bottom: 20px;
        }

        .method-label {
            background-color: #04ebec;
            color: #020f1f;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
        }

        .tiempo-entrega a {
            color: var(--bright-turquoise, #04ebec);
            text-decoration: none;
        }

        .tiempo-entrega a:hover {
            color: #590974;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .logo-container {
                position: static;
                text-align: center;
                margin-bottom: 20px;
                left: auto;
                transform: none;
            }
            .logo-container img {
                max-width: 120px;
            }
            .content-wrapper {
                margin-top: 0;
            }
            .tiempo-entrega ul {
                text-align: left;
                display: block;
            }
            .tiempo-entrega ul li {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="tiempo-entrega container my-5">
        <!-- Logo en la parte superior centrado -->
        <div class="logo-container">
            <a href="<?= base_url('/') ?>">
                <img src="../assets/img/logo.png" alt="Inovatech Logo">
            </a>
        </div>

        <!-- Contenedor del contenido para evitar superposición -->
        <div class="content-wrapper">
            <div class="text-center mb-4">
                <h2>¿Cuánto se demoran en entregar mi producto?</h2>
                <p class="lead">Consulta los tiempos estimados de entrega según tu ubicación.</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Tiempos de entrega</h4>
                    <p>Los tiempos de entrega pueden variar dependiendo de tu ubicación y el método de envío seleccionado. A continuación, te detallamos las estimaciones:</p>
                    <ul class="list-unstyled">
                        <li><span class="method-label">Envío estándar:</span> 3 a 5 días hábiles en áreas urbanas (puede extenderse a 7 días en zonas rurales).</li>
                        <li><span class="method-label">Envío exprés:</span> 1 a 2 días hábiles (disponible en ciudades principales, consulta costos adicionales).</li>
                        <li><span class="method-label">Efectivo contra entrega:</span> 2 a 4 días hábiles, sujeto a la disponibilidad en tu zona.</li>
                        <li><span class="method-label">Envío internacional:</span> 7 a 14 días hábiles, dependiendo del país de destino y aduanas.</li>
                    </ul>

                    <h4>Factores que pueden afectar la entrega</h4>
                    <p>Los tiempos estimados pueden variar por:</p>
                    <ul class="list-unstyled">
                        <li>Condiciones climáticas o eventos imprevistos.</li>
                        <li>Retrasos en aduanas para envíos internacionales.</li>
                        <li>Confirmación de pago o verificación de datos.</li>
                    </ul>

                    <h4>Seguimiento de tu pedido</h4>
                    <p> Si necesitas ayuda, contáctanos en <a href="mailto:soporte@inovatech.com">soporte@inovatech.com</a> o al <a href="https://wa.me/573057809016" target="_blank">+57 305 7809016</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>