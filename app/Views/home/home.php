<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Configuración de codificación y responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inovatech.com</title>
    <!-- Bootstrap y librerías de iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
<header>
        <?= $this->include('partials/header') ?>
</header>

<!--Carrusel de imágenes de ofertas (principal)-->
<main class="ofertas">
    <?php
    $primero = true;
    $hayImagenes = false;
    foreach ($ofertas as $oferta) {
        if (!empty($oferta['imagen'])) {
            $hayImagenes = true;
            break;
        }
    }
    ?>

    <?php if ($hayImagenes): ?>
        <!-- Carrusel Bootstrap para las imágenes de ofertas -->
    <div id="carouselExampleControlsNoTouching" class="carousel slide carousel-ofertas" data-bs-touch="false">
        <div class="carousel-inner">
            <?php foreach ($ofertas as $oferta): ?>
                <?php if (!empty($oferta['imagen'])): ?>
                    <div class="carousel-item <?= $primero ? 'active' : '' ?>">
                            <!-- Imagen con enlace al detalle del producto -->
                            <a href="<?= base_url('producto/ver/' . $oferta['productos_id']) ?>">
                            <img src="<?= base_url('uploads/' . $oferta['imagen']) ?>" class="d-block w-100 img-fluid" alt="Imagen oferta">
                        </a>
                    </div>
                    <?php $primero = false; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Controles de navegación del carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    <?php endif; ?>
</main>

<!--Carruseles de productos por categoría-->
<main class="productos-ofertas">
<?php foreach ($categorias as $categoria): ?>
    <?php
    // Filtrar productos por categoría
    $productosPorCategoria = array_filter($productos, function($producto) use ($categoria) {
        return $producto['id_categoria'] == $categoria['id'];
    });

    // Filtrar productos válidos (con imagen, estado válido y existencias)
    $validos = array_filter($productosPorCategoria, function($p) {
        if (isset($p['existencias']) && $p['existencias'] == 0) {
            $p['id_estado'] = 2; // Agotado
        }
        return !empty($p['imagen']) && isset($p['id_estado']) && !in_array($p['id_estado'], [2, 4, 7]);
    });
    ?>

     <!-- Contenedor de carrusel por categoría -->
    <?php if (!empty($validos)): ?>
        <div class="container my-5 carrucel-productos" style="width: 95%; margin: 0 auto;">
            <h2 class="mb-4 title-ofertas"><?= esc($categoria['nom']) ?></h2>

            <div id="carouselCategoria<?= $categoria['id'] ?>" class="carousel slide carousel-ofertas" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Agrupar productos válidos en grupos de 5 para el carrusel
                    $chunked = array_chunk($validos, 5);
                    foreach ($chunked as $index => $grupo):
                    ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row g-1">
                                <?php foreach ($grupo as $producto): ?>
                                    <div class="col-6 col-sm-4 col-md custom-col-5">
                                        <a href="<?= base_url('producto/ver/' . $producto['id']) ?>" class="text-decoration-none text-dark">
                                            <div class="card h-100">
                                                <img src="<?= base_url('uploads/' . $producto['imagen']) ?>" class="card-img-top producto-img" alt="<?= esc($producto['nom']) ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= esc($producto['nom']) ?></h5>
                                                    <p class="card-text"><?= esc($producto['descripcion']) ?></p>
                                                    <!-- Mostrar descuento si aplica -->
                                                    <?php if ($producto['precio'] != $producto['precio_original']): ?>
                                                        <?php
                                                            $porcentaje_descuento = round((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100);
                                                        ?>
                                                        <p class="precio_original">
                                                            $<?= number_format($producto['precio_original'], 0, ',', '.') ?>
                                                        </p>
                                                        <p class="precio color-verde">
                                                            $<?= number_format($producto['precio'], 0, ',', '.') ?>
                                                            <span class="descuento-porcentaje">-<?= $porcentaje_descuento ?>%</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="precio color-verde">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                                                    <?php endif; ?>
                                                    <div class="btn btn-outline-primary w-100">Ver más</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Controles si hay más de un slide por categoría -->
                <?php if (count($chunked) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoria<?= $categoria['id'] ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoria<?= $categoria['id'] ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</main>
<!--Pie de página-->
<footer>
<?php require_once("../app/Views/footer/footerApp.php")?>
</footer>
</body>
