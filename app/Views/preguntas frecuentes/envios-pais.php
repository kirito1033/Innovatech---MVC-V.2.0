<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Hacen envíos a todo el país? - Inovatech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .envios-pais {
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

        .envios-pais h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .envios-pais h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .envios-pais p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .envios-pais ul {
            text-align: left;
            display: inline-block;
            margin: 0 auto;
        }

        .envios-pais ul li {
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

        .envios-pais a {
            color: var(--bright-turquoise, #04ebec);
            text-decoration: none;
        }

        .envios-pais a:hover {
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
            .envios-pais ul {
                text-align: left;
                display: block;
            }
            .envios-pais ul li {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="envios-pais container my-5">
        <!-- Logo en la parte superior centrado -->
        <div class="logo-container">
            <a href="<?= base_url('/') ?>">
                <img src="../assets/img/logo.png" alt="Inovatech Logo">
            </a>
        </div>

        <!-- Contenedor del contenido para evitar superposición -->
        <div class="content-wrapper">
            <div class="text-center mb-4">
                <h2>¿Hacen envíos a todo el país?</h2>
                <p class="lead">Descubre la cobertura de nuestros envíos en Inovatech.</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Cobertura de envíos</h4>
                    <p>Sí, en Inovatech realizamos envíos a todo el país, incluyendo áreas urbanas y rurales. Sin embargo, hay algunos detalles a considerar:</p>
                    <ul class="list-unstyled">
                        <li><span class="method-label">Áreas urbanas:</span> Cobertura completa con entrega en 3-5 días hábiles (estándar).</li>
                        <li><span class="method-label">Áreas rurales:</span> Disponible en la mayoría de las zonas, con tiempos de entrega de 5-7 días hábiles (puede variar por accesibilidad).</li>
                        <li><span class="method-label">Zonas remotas:</span> Envíos sujetos a verificación. Contáctanos para confirmar disponibilidad y costos adicionales.</li>
                    </ul>

                    <h4>Condiciones de envío</h4>
                    <p>Los costos de envío dependen de tu ubicación y el peso del producto. Ofrecemos:</p>
                    <ul class="list-unstyled">
                        <li>Envío gratuito en compras superiores a $50.000 COP (sujeto a condiciones).</li>
                        <li>Costo adicional para envíos exprés o a zonas remotas.</li>
                    </ul>

                    <h4>Consulta tu zona</h4>
                    <p>contáctanos en <a href="mailto:soporte@inovatech.com">soporte@inovatech.com</a> o al <a href="https://wa.me/573057809016" target="_blank">+57 305 7809016</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>