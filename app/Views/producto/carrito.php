<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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

        /* Container for two-column layout */
        .main-container {
            display: flex;
            width: 95%;
            max-width: 1200px;
            margin: 1.5rem auto;
            gap: 1rem;
        }

        /* Filter Section Styles */
        .filters-main {
            background-color: var(--ebony-clay);
            padding: 1rem;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 8px 16px, rgba(0, 0, 0, 0.23) 0px 4px 4px;
            height: fit-content;
            flex: 0 0 25%;
        }

        .filters-main .card {
            background-color: var(--tarawera);
            border: none;
            border-radius: 8px;
            padding: 1rem;
        }

        .filters-main .card h5 {
            color: var(--bright-turquoise);
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .filters-main .form-label {
            color: var(--Color--texto);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .filters-main .form-control,
        .filters-main .form-select {
            background-color: var(--blue-chill);
            color: var(--Color--texto);
            border: 1px solid var(--gossamer);
            border-radius: 4px;
            font-size: 0.8rem;
            padding: 0.3rem 0.5rem;
        }

        .filters-main .form-control:focus,
        .filters-main .form-select:focus {
            background-color: var(--blue-chill);
            border-color: var(--bright-turquoise);
            box-shadow: 0 0 4px var(--bright-turquoise);
            color: var(--Color--texto);
        }

        .filters-main .btn-primary {
            background-color: var(--gossamer);
            border-color: var(--gossamer);
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 4px;
            padding: 0.4rem;
            transition: background-color 0.3s ease;
        }

        .filters-main .btn-primary:hover {
            background-color: var(--bright-turquoise);
            border-color: var(--bright-turquoise);
        }

        /* Products Section Styles */
        .productos-ofertas {
            max-width: 68%;
            background-color: var(--gossamer);
            border: 1px solid var(--gris-);
            border-radius: 8px;
            padding: 1rem;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 8px 16px, rgba(0, 0, 0, 0.23) 0px 4px 4px;
            flex: 0 0 75%;
            overflow-x: hidden;
          
        }

        .title-ofertas {
            background-color: var(--tarawera);
            color: var(--bright-turquoise);
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 1.4rem;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 8px 16px, rgba(0, 0, 0, 0.23) 0px 4px 4px;
            margin-bottom: 1rem;
        }

        .card {
            max-width: 100%;
            margin: 0 auto;
            border-radius: 8px;
            background-color: var(--ebony-clay);
        }

        .card .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0a6069;
        }

        .card .card-text {
            font-size: 0.85rem;
            color: #111
        }

        .card .card-body {
            padding: 1rem;
        }

        .card img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px 0 0 8px;
            display: block;
            margin: 0 auto;
            margin-top: 5%;
        }

        .card:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            color: var(--bright-turquoise);
            border-color: var(--bright-turquoise);
        }

        .btn-outline-primary:hover {
            background-color: var(--bright-turquoise);
            color: var(--tarawera);
        }

        .card-link {
            display: block;
            width: 90%;
            height: 100%;
            text-decoration: none;
            color: inherit;
            margin: auto; 
        }

        .text-precio {
            font-weight: 700;
            font-size: 1rem;
            color: #0a6069;
        }

        /* Ensure no overflow */
        .lista-productos {
        
            overflow-x: hidden;
        }

        .row.g-3 {
            margin-right: 0;
            margin-left: 0;
        }

        .row.g-3 > .col-12 {
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            margin-bottom: 0.7rem;
        }
    </style>
</head>
<body>
<header>
    <?= $this->include('partials/header') ?>
</header>

<!-- Two-column layout container -->
<div class="main-container container">
    
    <!-- Products Main Section -->
<main class="productos-ofertas">
    <div class="lista-productos">
        <?php foreach ($categorias as $categoria): ?>
            <?php
            $productosPorCategoria = array_filter($productos, function($producto) use ($categoria) {
                return $producto['id_categoria'] == $categoria['id'];
            });
            ?>
            <?php if (!empty($productosPorCategoria)): ?>
                <h2 class="mb-3 title-ofertas"><?= esc($categoria['nom']) ?></h2>
                <div class="row g-3">
                    <?php foreach ($productosPorCategoria as $producto): ?>
                        <?php if ($producto['id_estado'] != 1) continue; // Solo mostrar productos con estado 1 ?>
                        <div class="col-12">
                            <a href="<?= base_url('producto/ver/' . $producto['id']) ?>" class="card-link">
                                <div class="card mb-2 shadow-sm">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="<?= base_url('Uploads/' . $producto['imagen']) ?>" class="img-fluid rounded-start" alt="<?= esc($producto['nom']) ?>">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= esc($producto['nom']) ?></h5>
                                                <p class="card-text"><?= esc($producto['descripcion']) ?></p>
                                                <p class="card-text">
                                                    <?php if ($producto['precio'] != $producto['precio_original']): ?>
                                                        <?php
                                                        $porcentaje_descuento = round((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100);
                                                        ?>
                                                        <p class="precio_original">
                                                            $<?= number_format($producto['precio_original'], 0, ',', '.') ?>
                                                        </p>
                                                        <p class="text-precio">
                                                            $<?= number_format($producto['precio'], 0, ',', '.') ?>
                                                            <span class="descuento-porcentaje">-<?= $porcentaje_descuento ?>%</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="precio color-verde">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                                                    <?php endif; ?>
                                                </p>
                                                <span class="btn btn-sm btn-outline-primary mt-1">Ver más</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</main>

</div>

<footer>
    <?php require_once("../app/Views/footer/footerApp.php")?>
</footer>
</body>
</html>