<?php
// Los datos ya están extraídos como $producto y $categorias
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($producto['nom']) ?></title>
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

        .main-producto {
            background-color: var(--Color--texto);
            padding: 3%;
            margin-top: 2%;
            border: 1px solid #fff;
            border-radius: 10px;
        }

        div {
            text-align: justify;
        }

        .precio-p {
            font-size: 40px;
        }

        .titulo-producto {
            font-size: 25px;
            font-weight: 600;
        }

        a {
            color: var(--blue-chill);
        }

        a:hover {
            color: #02bebe;
        }

        .li-caracteristicas {
            margin: 4%;
            list-style-type: disc;
        }

        .comprar-btn, .carrito-btn {
            width: 100%;
            margin-top: 2%;
        }

        .comprar-col {
            border: 1px solid #1114;
            border-radius: 5px;
            padding: 2%;
        }

        .borde1, .borde2 {
            border-bottom: 1px solid #1114;
        }

        .borde2 {
            margin-right: 3%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            overflow: hidden;
        }

        th {
            background-color: #f2f2f2;
        }

        .img-tarjetas-credito, .img-tarjeta-debito, .img-efectivo {
            display: flex;
            justify-content: space-around;
            padding: 10px;
        }

        h6 {
            font-weight: 700;
        }

        #inputpregunta {
            width: 100%;
        }

        .preguntas-col {
            margin-top: 2%;
        }

        .form-preguntas {
            margin-top: 1%;
        }

        .medios-pago-img {
            height: 60%;
            border-radius: 5px;
            border: 1px solid #1114;
        }

        .productos-carac {
            border-bottom: 1px solid #1114;
            margin-top: 2%;
        }

        .ver-imagen-producto {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

       /* ===================== */
        /* MEDIA QUERY RESPONSIVO */
        /* ===================== */

        @media (max-width: 767.98px) {
            /* Las columnas principales (imagen, info, compra) se apilan */
            .producto .row {
                flex-direction: column !important;
            }

            .producto .row > div {
                width: 100% !important;
                max-width: 100% !important;
                margin-bottom: 1rem;
            }

            .ver-imagen-producto {
                height: auto !important;
                max-height: 300px;
                object-fit: contain !important;
            }

            .titulo-producto {
                font-size: 20px;
                text-align: center;
            }

            .precio {
                text-align: center;
            }

            .caracteristicas-gene ul {
                padding-left: 1rem;
            }

            table {
                width: 100% !important;
            }

            .comprar-col {
                padding: 1rem;
            }

            .productos-carac h2 {
                text-align: center;
            }

            .productos-carac table {
                font-size: 14px;
            }

            .preguntas-col {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
<header>
<?= $this->include('partials/header') ?>
</header>
<main class="producto">
    <div class="container main-producto text-center">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col borde1">
                <img src="<?= base_url('uploads/' . esc($producto['imagen'] ?? 'placeholder.jpg')) ?>" class="ver-imagen-producto" alt="<?= esc($producto['nom']) ?>">
            </div>

            <!-- Detalles del producto -->
            <div class="col borde2">
                <div class="titulo">
                    <h2 class="titulo-producto"><?= esc($producto['nom']) ?></h2>
                </div>
                <div class="precio">
                <?php if (isset($producto['precio_original']) && $producto['precio'] != $producto['precio_original']): ?>
                    <?php
                        $porcentaje_descuento = round((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100);
                    ?>
                    <p class="precio_original" style="text-decoration: line-through; color: gray;">
                        $<?= number_format($producto['precio_original'], 0, ',', '.') ?>
                    </p>
                    <p class="precio color-verde" style="font-weight: bold;">
                        $<?= number_format($producto['precio'], 0, ',', '.') ?>
                        <span class="descuento-porcentaje" style="color: red; margin-left: 10px;">-<?= $porcentaje_descuento ?>%</span>
                    </p>
                <?php else: ?>
                    <p class="precio color-verde" style="font-weight: bold;">
                        $<?= number_format($producto['precio'], 0, ',', '.') ?>
                    </p>
                <?php endif; ?>
            </div>
                <div class="medios-pago">
                    <a class="medios-pago-a" href="#">Ver medios de pago</a>
                </div>
                <div class="color">
                    <p>Color: <?= esc($producto['color'] ?? 'N/A') ?></p>
                </div>
                <div class="caracteristicas-gene">
                    <h5>Lo que tienes que saber de este producto</h5>
                    <ul class="ul-caracteristicas">
                        <?php
                        $caracteristicas = explode(',', $producto['caracteristicas'] ?? '');
                        foreach ($caracteristicas as $caract): ?>
                            <li class="li-caracteristicas"><?= esc(trim($caract)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Sección de compra -->
            <div class="col comprar-col">
                <div class="envio">
                    <p><span class="color-verde">Envío gratis</span> a todo el país</p>
                    <p><span class="color-verde">Llega gratis</span> entre el lunes y el jueves</p>
                    <a href="#">Más formas de entrega</a>
                </div>

                <div class="stock">
                    <p style="color: <?= $producto['existencias'] == 0 ? 'red' : 'inherit' ?>;">
                        Stock disponible (<?= esc($producto['existencias']) ?> unidades)
                    </p>
                </div>

                <!-- Formulario para agregar al carrito -->
                <?php if ($producto['existencias'] > 0): ?>
                    <form action="<?= base_url('/carrito/agregar') ?>" method="post">
                        <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">

                        <div class="cantidad">
                            <label for="cantidad">Cantidad:</label>
                            <select class="form-select form-select-lg mb-3" id="cantidad" name="cantidad" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <?php for ($i = 1; $i <= min($producto['existencias'], 6); $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?> unidad<?= $i > 1 ? 'es' : '' ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="comprar">
                            <button type="submit"
                                class="btn btn-primary comprar-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEnDesarrollo">
                                Comprar ahora
                            </button>
                        </div>

                        <div class="agregar-carrito mt-2">
                            <button type="submit" class="btn btn-info carrito-btn w-100">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="cantidad">
                        <label for="cantidad">Cantidad:</label>
                        <select class="form-select form-select-lg mb-3" id="cantidad" name="cantidad" disabled>
                            <option value="">Sin stock</option>
                        </select>
                    </div>

                    <div class="comprar">
                        <button type="submit" class="btn btn-secondary comprar-btn" disabled>
                            Comprar ahora
                        </button>
                    </div>

                    <div class="agregar-carrito mt-2">
                        <button type="submit" class="btn btn-secondary carrito-btn w-100" disabled>
                            Agregar al carrito
                        </button>
                    </div>
                <?php endif; ?>

                <div class="devoluciones mt-3">
                    <i class="bi bi-skip-backward-circle"></i>
                    <a href="/politicas-devolucion">Devolución gratis. Tienes 30 días desde que lo recibes.</a>
                </div>

                <div class="protegida">
                    <i class="bi bi-shield-check"></i>
                    <a href="/politicas-devolucion">Recibe el producto que esperabas o te devolvemos tu dinero.</a>
                </div>
            </div>
        </div>

        <!-- Características detalladas -->
        <div class="row productos-carac">
            <h2>Características del producto</h2>
            <div class="col">
                <h5>Características principales</h5>
                <table class="table">
                    <tr>
                        <th>Marca</th>
                        <td><?= esc($producto['marca'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>Modelo</th>
                        <td><?= esc($producto['nom']) ?></td>
                    </tr>
                    <tr>
                        <th>Categoría</th>
                        <td><?= esc($producto['categoria'] ?? 'N/A') ?></td>
                    </tr>
                </table>
                <h5>Especificaciones</h5>
                <table class="table">
                    <tr>
                        <th>Tamaño</th>
                        <td><?= esc($producto['tam'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>Tamaño de pantalla</th>
                        <td><?= esc($producto['tampantalla'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>Almacenamiento</th>
                        <td><?= esc($producto['almacenamiento'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>RAM</th>
                        <td><?= esc($producto['ram'] ?? 'N/A') ?></td>
                    </tr>
                </table>
                <h5>Sistema</h5>
                <table class="table">
                    <tr>
                        <th>Sistema operativo</th>
                        <td><?= esc($producto['sistema_operativo'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>Resolución</th>
                        <td><?= esc($producto['resolucion'] ?? 'N/A') ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Sección de preguntas -->
        <div class="row">
            <div class="col preguntas-col">
                <h3>Preguntas</h3>
                <form class="row g-3 form-preguntas" action="/producto/preguntar/<?= $producto['id'] ?>" method="POST">
                    <div class="col-10">
                        <input type="text" class="form-control" id="inputpregunta" name="pregunta" placeholder="Escribe tu pregunta..." required>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo"><button type="submit" class="btn btn-primary mb-3">Preguntar</button></a> 
                    </div>
                </form>
                <p id="preguntas"></p>
            </div>
        </div>
    </div>
    
</main>
<main>

<?php if (!empty($productos)): ?>
    <main class="productos-ofertas">
        <div class="container my-5 carrucel-productos" style="width: 95%; margin: 0 auto;">
            <h2 class="mb-4 title-ofertas">Más en <?= esc($producto['categoria'] ?? 'esta categoría') ?></h2>

            <div id="carouselCategoriaRelacionada" class="carousel slide carousel-ofertas" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $chunked = array_chunk($productos, 5);
                    foreach ($chunked as $index => $grupo):
                    ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row g-1">
                                <?php foreach ($grupo as $prod): ?>
                                    <div class="col-6 col-sm-4 col-md custom-col-5">
                                        <a href="<?= base_url('producto/ver/' . $prod['id']) ?>" class="text-decoration-none text-dark">
                                            <div class="card h-100">
                                                <img src="<?= base_url('Uploads/' . esc($prod['imagen'] ?? 'placeholder.jpg')) ?>" class="card-img-top producto-img" alt="<?= esc($prod['nom']) ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= esc($prod['nom']) ?></h5>
                                                    <p class="card-text"><?= esc($prod['descripcion']) ?></p>
                                                    <p class="precio color-verde">$<?= number_format($prod['precio'], 0, ',', '.') ?></p>
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
                <?php if (count($chunked) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoriaRelacionada" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoriaRelacionada" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php endif; ?>
</main>
<!-- Bootstrap JS (opcional, solo si necesitas funcionalidades como dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function preguntar() {
    const pregunta = document.getElementById('inputpregunta').value;
    if (pregunta.trim()) {
        document.getElementById('preguntas').innerHTML += `<p>${pregunta}</p>`;
        document.getElementById('inputpregunta').value = '';
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
<?php require_once("../app/Views/footer/footerApp.php")?>
</footer>
</html>