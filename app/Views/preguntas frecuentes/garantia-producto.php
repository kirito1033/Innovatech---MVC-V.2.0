<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Cuánto tiempo de garantía tiene mi producto? - Inovatech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .garantia-producto {
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

        .garantia-producto h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .garantia-producto h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .garantia-producto p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .garantia-producto ul {
            text-align: left;
            display: inline-block;
            margin: 0 auto;
        }

        .garantia-producto ul li {
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

        .garantia-producto a {
            color: var(--bright-turquoise, #04ebec);
            text-decoration: none;
        }

        .garantia-producto a:hover {
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
            .garantia-producto ul {
                text-align: left;
                display: block;
            }
            .garantia-producto ul li {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="garantia-producto container my-5">
        <!-- Logo en la parte superior centrado -->
        <div class="logo-container">
            <a href="<?= base_url('/') ?>">
                <img src="../assets/img/logo.png" alt="Inovatech Logo">
            </a>
        </div>

        <!-- Contenedor del contenido para evitar superposición -->
        <div class="content-wrapper">
            <div class="text-center mb-4">
                <h2>¿Cuánto tiempo de garantía tiene mi producto?</h2>
                <p class="lead">Conoce los detalles de la garantía de tus productos en Inovatech.</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Duración de la garantía</h4>
                    <p>La garantía de los productos en Inovatech varía según el fabricante, pero ofrecemos lo siguiente como estándar:</p>
                    <ul class="list-unstyled">
                        <li><span class="method-label">Garantía estándar:</span> 12 meses para la mayoría de los productos electrónicos (sujeto a las políticas del fabricante).</li>
                        <li><span class="method-label">Garantía extendida:</span> Opcional por 24 meses adicionales (consulta costos y condiciones al momento de la compra).</li>
                        <li><span class="method-label">Productos especiales:</span> Algunos artículos (como accesorios) pueden tener una garantía de 6 meses; revisa la descripción del producto.</li>
                    </ul>

                    <h4>¿Qué cubre la garantía?</h4>
                    <p>La garantía cubre defectos de fabricación bajo las siguientes condiciones:</p>
                    <ul class="list-unstyled">
                        <li>Daños causados por fallos de materiales o ensamblaje.</li>
                        <li>Reparación o reemplazo del producto (según disponibilidad).</li>
                    </ul>
                    <p>No cubre:</p>
                    <ul class="list-unstyled">
                        <li>Daños por mal uso, caídas o desgaste normal.</li>
                        <li>Accesorios o componentes consumibles (baterías, cables, etc.).</li>
                    </ul>

                    <h4>¿Cómo hacer valer mi garantía?</h4>
                    <p>Para gestionar tu garantía, sigue estos pasos:</p>
                    <ul class="list-unstyled">
                        <li>Conserva tu factura o número de pedido.</li>
                        <li>Contáctanos en <a href="mailto:soporte@inovatech.com">soporte@inovatech.com</a> o al <a href="https://wa.me/573057809016" target="_blank">+57 305 7809016</a> con los detalles de tu compra.</li>
                        <li>Envía el producto a nuestra bodega autorizada (costos de envío a cargo del cliente en algunos casos).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>