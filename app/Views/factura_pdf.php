<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura N° <?= esc($numero_factura) ?></title>
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
            padding: 0;
            background-color: var(--encabezados-piedepagina);
            font-family: Arial, sans-serif;
            color: var(--Color--texto);
        }

        .page {
            padding: 20px;
        }

        .empresa {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--bright-turquoise);
        }

        .empresa-info {
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: var(--Color--texto);
        }

        .info, .proveedor-info {
            margin-bottom: 20px;
            background-color: var(--tarawera);
            padding: 10px;
            border-radius: 8px;
        }

        .info p, .proveedor-info p {
            margin: 5px 0;
            color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #aaa;
         
        }

        th, td {
            padding: 8px;
            text-align: left;
            background-color: #ffffff;
            color: #000;
        }

        th {
            background-color: var(--blue-chill);
            color: #fff;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .total-label {
            text-align: right;
        }

        .observaciones {
            margin-top: 25px;
            font-size: 0.9rem;
        }

        .firmas {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .firmas .firma {
            width: 45%;
            text-align: center;
        }

        .firmas .firma-linea {
            border-top: 1px solid #fff;
            margin-top: 60px;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="empresa">Innovatech</div>
        <div class="empresa-info">
            NIT: 900123456-7 · Carrera 45 #12-34, Bogotá, Colombia<br>
            Tel: +57 1 234 5678 · contacto@innovatech.com
        </div>

        <h1>Factura Proveedor N° <?= esc($numero_factura) ?></h1>

        <div class="info">
            <p><strong>Fecha de emisión:</strong> <?= date('d/m/Y') ?></p>
            <p><strong>Número de pedido:</strong> PED-<?= date('Ymd') ?>-<?= esc($numero_factura) ?></p>
        </div>

        <div class="proveedor-info">
            <p><strong>Proveedor:</strong> <?= esc($proveedor['nombre']) ?></p>
            <p><strong>NIT/Cédula:</strong> <?= esc($proveedor['nit'] ?? 'N/A') ?></p>
            <p><strong>Dirección:</strong> <?= esc($proveedor['direccion'] ?? 'No registrada') ?></p>
            <p><strong>Teléfono:</strong> <?= esc($proveedor['telefono'] ?? 'No registrado') ?></p>
            <p><strong>Correo:</strong> <?= esc($proveedor['email'] ?? 'No registrado') ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_cantidad = 0;
                foreach ($productos as $i => $item):
                    $total_cantidad += $item['cantidad'];
                ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($item['nombre_producto']) ?></td>
                        <td><?= esc($item['cantidad']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="2" class="total-label">Total de productos:</td>
                    <td><?= $total_cantidad ?></td>
                </tr>
            </tbody>
        </table>

        <div class="observaciones">
           <p><strong>Observaciones:</strong></p>
            <ul>
                <li>Esta solicitud de productos tiene como finalidad abastecer el inventario de Innovatech.</li>
            </ul>
        </div>

        <div class="firmas">
            <div class="firma">
                _________________________<br>
                <span class="firma-linea">Firma del proveedor</span>
            </div>
            <div class="firma">
                _________________________<br>
                <span class="firma-linea">Recibido por Innovatech</span>
            </div>
        </div>
    </div>
</body>
</html>
