<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica de codificación y escalado en móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Producto</title>
    <!-- Bootstrap 5 para estilos y componentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

</head>
<body>
    <!-- Cabecera del sitio cargada como vista parcial -->
<header>
    <?= $this->include('partials/header') ?>
</header>

<!-- Contenedor principal de dos columnas -->
<div class="main-container container">
    <!-- Columna izquierda: Filtros de búsqueda de productos -->
    <main class="filters-main">
        <div class="card p-2 shadow-sm">
            <h5>Filtrar productos</h5>
            <!-- Formulario GET para filtrar productos -->
            <form method="GET" action="">
                <!-- Filtro: Nombre del producto -->
                <div class="mb-2">
                    <label for="nom" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= esc($_GET['nom'] ?? '') ?>">
                </div>

                <!-- Filtro: Precio mínimo -->
                <div class="mb-2">
                    <label for="precio_min" class="form-label">Precio mínimo</label>
                    <input type="number" class="form-control" id="precio_min" name="precio_min" value="<?= esc($_GET['precio_min'] ?? '') ?>">
                </div>

                <!-- Filtro: Precio máximo -->
                <div class="mb-2">
                    <label for="precio_max" class="form-label">Precio máximo</label>
                    <input type="number" class="form-control" id="precio_max" name="precio_max" value="<?= esc($_GET['precio_max'] ?? '') ?>">
                </div>

                <!-- Filtro: Marca -->
                <div class="mb-2">
                    <label for="id_marca" class="form-label">Marca</label>
                    <select class="form-select" id="id_marca" name="id_marca">
                        <option value="">Todas</option>
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?= esc($marca['id']) ?>" <?= (isset($_GET['id_marca']) && $_GET['id_marca'] == $marca['id']) ? 'selected' : '' ?>>
                                <?= esc($marca['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Filtro: Color -->
                <div class="mb-2">
                    <label for="id_color" class="form-label">Color</label>
                    <select class="form-select" id="id_color" name="id_color">
                        <option value="">Todos</option>
                        <?php foreach ($colores as $color): ?>
                            <option value="<?= esc($color['id_color']) ?>" <?= (isset($_GET['id_color']) && $_GET['id_color'] == $color['id_color']) ? 'selected' : '' ?>>
                                <?= esc($color['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Filtro: RAM -->
                <div class="mb-2">
                    <label for="id_ram" class="form-label">RAM</label>
                    <select class="form-select" id="id_ram" name="id_ram">
                        <option value="">Todas</option>
                        <?php foreach ($rams as $ram): ?>
                            <option value="<?= esc($ram['id']) ?>" <?= (isset($_GET['id_ram']) && $_GET['id_ram'] == $ram['id']) ? 'selected' : '' ?>>
                                <?= esc($ram['num']) . ' ' . esc($ram['unidadestandar']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Filtro: Almacenamiento -->
                <div class="mb-2">
                    <label for="id_almacenamiento" class="form-label">Almacenamiento</label>
                    <select class="form-select" id="id_almacenamiento" name="id_almacenamiento">
                        <option value="">Todos</option>
                        <?php foreach ($almacenamientos as $almacenamiento): ?>
                            <option value="<?= esc($almacenamiento['id']) ?>" <?= (isset($_GET['id_almacenamiento']) && $_GET['id_almacenamiento'] == $almacenamiento['id']) ? 'selected' : '' ?>>
                                <?= esc($almacenamiento['num']) . ' ' . esc($almacenamiento['unidadestandar']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Filtro: Garantía -->
                <div class="mb-2">
                    <label for="id_garantia" class="form-label">Garantía</label>
                    <select class="form-select" id="id_garantia" name="id_garantia">
                        <option value="">Todas</option>
                        <?php if (!empty($garantias)): ?>
                            <?php foreach ($garantias as $garantia): ?>
                                <option value="<?= esc($garantia['id']) ?>" <?= (isset($_GET['id_garantia']) && $_GET['id_garantia'] == $garantia['id']) ? 'selected' : '' ?>>
                                    <?= esc($garantia['numero_mes_año']) . ' ' . esc($garantia['mes_año']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Filtro: Resolución -->
                <div class="mb-2">
                    <label for="id_resolucion" class="form-label">Resolución</label>
                    <select class="form-select" id="id_resolucion" name="id_resolucion">
                        <option value="">Todas</option>
                        <?php if (!empty($resoluciones)): ?>
                            <?php foreach ($resoluciones as $resolucion): ?>
                                <option value="<?= esc($resolucion['id']) ?>" <?= (isset($_GET['id_resolucion']) && $_GET['id_resolucion'] == $resolucion['id']) ? 'selected' : '' ?>>
                                    <?= esc($resolucion['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Botón para aplicar los filtros -->
                <button type="submit" class="btn btn-primary mt-2 w-100">Buscar</button>
            </form>
        </div>
    </main>

    <!-- Columna derecha: Listado de productos por categoría -->
<main class="productos-ofertas">
    <div class="lista-productos">
        <?php foreach ($categorias as $categoria): ?>
            <?php
            // Agrupa productos por categoría
            $productosPorCategoria = array_filter($productos, function($producto) use ($categoria) {
                return $producto['id_categoria'] == $categoria['id'];
            });
            ?>
            <?php if (!empty($productosPorCategoria)): ?>
                <!-- Título de categoría -->
                <h2 class="mb-3 title-ofertas"><?= esc($categoria['nom']) ?></h2>
                <!-- Grid de productos -->
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
                                               <!-- Mostrar precio con o sin descuento -->
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

<!-- Pie de página del sitio -->
<footer>
    <?php require_once("../app/Views/footer/footerApp.php")?>
</footer>
</body>
</html>