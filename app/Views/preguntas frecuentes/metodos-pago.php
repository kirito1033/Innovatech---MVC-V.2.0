<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métodos de Pago - Inovatech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .metodos-pago {
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

        .metodos-pago h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .metodos-pago h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--bright-turquoise, #04ebec);
            text-align: center;
        }

        .metodos-pago p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .metodos-pago ul {
            text-align: left;
            display: inline-block;
            margin: 0 auto;
        }

        .metodos-pago ul li {
            margin-bottom: 20px; /* Aumentado para más separación */
        }

        .method-label {
            background-color: #04ebec;
            color: #020f1f;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
        }

        .metodos-pago a {
            color: var(--bright-turquoise, #04ebec);
            text-decoration: none;
        }

        .metodos-pago a:hover {
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
            .metodos-pago ul {
                text-align: left;
                display: block;
            }
            .metodos-pago ul li {
                margin-bottom: 15px; /* Menor separación en móviles si es necesario */
            }
        }
    </style>
</head>
<body>
    <div class="metodos-pago container my-5">
        <!-- Logo en la parte superior centrado -->
        <div class="logo-container">
            <a href="<?= base_url('/') ?>">
                <img src="../assets/img/logo.png" alt="Inovatech Logo">
            </a>
        </div>

        <!-- Contenedor del contenido para evitar superposición -->
        <div class="content-wrapper">
            <div class="text-center mb-4">
                <h2>¿Qué métodos de pago puedo utilizar?</h2>
                <p class="lead">Conoce las opciones disponibles para realizar tus compras en Inovatech.</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Métodos de pago aceptados</h4>
                    <p>En Inovatech, ofrecemos una variedad de métodos de pago seguros para tu conveniencia:</p>
                    <ul class="list-unstyled">
                        <li><span class="method-label">Tarjetas de crédito/débito:</span> Visa, Mastercard, American Express, Discover (procesamiento seguro con encriptación SSL).</li>
                        <li><span class="method-label">Transferencia bancaria:</span> Puedes realizar el pago directamente a nuestras cuentas autorizadas (detalles enviados al confirmar tu pedido).</li>
                        <li><span class="method-label">PayPal:</span> Paga de forma rápida y segura con tu cuenta PayPal.</li>
                        <li><span class="method-label">Efectivo contra entrega:</span> Disponible en algunas zonas (consultar disponibilidad al momento de la compra).</li>
                        <li><span class="method-label">Google Pay:</span> Paga con tu cuenta de Google de manera rápida y segura en dispositivos compatibles.</li>
                        <li><span class="method-label">Apple Pay:</span> Opción disponible para usuarios de dispositivos Apple con autenticación biométrica.</li>
                        <li><span class="method-label">Samsung Pay:</span> Compatible con dispositivos Samsung para pagos móviles.</li>
                        <li><span class="method-label">Criptomonedas:</span> Bitcoin (BTC), Ethereum (ETH) u otras criptos (sujeto a disponibilidad y conversión a moneda local).</li>
                        <li><span class="method-label">Mercado Pago:</span> Popular en América Latina, ideal para pagos con saldo o tarjetas locales.</li>
                        <li><span class="method-label">OXXO (Pago en tiendas):</span> Paga en efectivo en tiendas OXXO (disponible en México).</li>
                        <li><span class="method-label">Efecty o Baloto:</span> Pago en efectivo en puntos autorizados (disponible en Colombia).</li>
                        <li><span class="method-label">Sofort:</span> Transferencia bancaria instantánea, común en Europa.</li>
                        <li><span class="method-label">Stripe:</span> Paga con una amplia gama de tarjetas y métodos locales a través de Stripe.</li>
                        <li><span class="method-label">Alipay:</span> Opción para clientes en China y otros mercados asiáticos.</li>
                        <li><span class="method-label">WeChat Pay:</span> Pago móvil popular en China.</li>
                        <li><span class="method-label">Klarna:</span> Compra ahora, paga después (con planes de pago flexibles).</li>
                        <li><span class="method-label">Afterpay:</span> Divide el pago en cuotas sin intereses (disponible en algunos países).</li>
                    </ul>

                    <h4>Información adicional</h4>
                    <p>Todos los pagos se procesan de manera segura y cumplen con los estándares PCI-DSS. Para más detalles o asistencia con tu pago, contáctanos en <a href="mailto:soporte@inovatech.com">soporte@inovatech.com</a> o al <a href="https://wa.me/573057809016" target="_blank">+57 305 7809016</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
