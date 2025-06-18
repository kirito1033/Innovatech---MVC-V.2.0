<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        :root {
            --encabezados-piedepagina: #020f1f;
            --Color--texto: #0a6069;
            --bright-turquoise: #04ebec;
            --atoll: #0a6069;
            --tarawera: #0b4454;
            --ebony-clay: #f2f2f2;
            --gris: #5a626b;
        }

        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 1rem;
        }

        .titulo-carrito {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            background-color: #04ebec;
            color: #0b4454;
            padding: 0.7rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        .productos-carrito {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .producto-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffffff;
            color: #333;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            border: 1px solid #dce1e5;
        }

        .producto-img {
            width: 200px !important;
            height: 200px !important;
            max-width: 200px !important;
            max-height: 200px !important;
            object-fit: cover !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            display: block;
        }

        .producto-info {
            flex-grow: 3;
            padding: 0 1.5rem;
            max-width: 100%;
        }

        .producto-info h5 {
            font-size: 25px;
            margin: 0;
            color: #00796b;
        }

        .producto-texto {
            font-size: 20px;
            margin: 0.3rem 0;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #111;
        }

        .producto-precio {
            font-weight: bold;
            color: #048d94;
            margin-top: 0.3rem;
            font-size: 25px;
        }

        .producto-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-end;
            flex-shrink: 0;
            flex-grow: 0;
            width: auto;
            min-width: 130px;
        }

        .producto-actions .btn {
            font-size: 1.05rem !important;
            padding: 0.5rem 1rem !important;
            border-radius: 10px;
            min-width: 100px;
        }

        .producto-actions .btn-delete {
            background-color: #00796b;
        }

        .producto-actions .btn-show {
            background-color: #04ebec;
        }

        .producto-actions .btn-delete:hover {
            background-color:rgb(1, 92, 81);
        }

        .producto-actions .btn-show:hover {
            background-color:rgb(3, 161, 161);
        }

        .btn-sm {
            font-size: 1rem;
            padding: 0.4rem 0.9rem;
        }

        .producto-img {
            border-radius: 8px;
        }

        .cantidad-control button {
            width: 32px;
            height: 32px;
            padding: 0;
            font-size: 18px;
        }

        .container-xl-custom {
            max-width: 85%;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card-resumen {
            padding: 1rem;
            background-color: #ffffff;
            color: #00796b;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 558px;
            max-height: 235px;
        }

        .card-resumen h5 {
            font-size: 25px;
            font-weight: 600;
            color: #00796b;
        }

        #subtotal {
            font-size: 25px;
            color: #048d94;
        }

        .card-resumen button {
            background-color: #198754;
            border: none;
            font-weight: bold;
        }

        /* Metodo de pago */
        #modalPago .modal-content {
            border-radius: 1rem !important;
            overflow: hidden;
        }

        #modalPago .modal-header {
            background-color: #0b4454;
        }

        #modalPago .btn-light:hover {
            background-color: #e0f0ff;
            border-color: #04ebec;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .producto-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .producto-actions {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
                margin-top: 1rem;
            }

            .producto-info {
                padding: 0.5rem 0;
            }

            .col-md-4 {
                flex: 0 0 auto;
                width: 320px;
            }
        }
    </style>
</head>
<body>

<header>
    <?= $this->include('partials/header') ?>
</header>

<div class="container-xl-custom">
    <h1 class="titulo-carrito mb-4">Carrito de Compras</h1>
    <div class="row">
        <!-- Columna izquierda: productos -->
        <div class="col-md-8 productos-carrito">
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card producto-carrito d-flex mb-3 p-3 border rounded shadow-sm align-items-center" 
                    id="producto-<?= $producto['carrito_id'] ?>"
                    data-id="<?= $producto['carrito_id'] ?>" 
                    data-precio="<?= $producto['precio'] ?>">
                    
                    <!-- Imagen del producto -->
                    <img src="<?= base_url('Uploads/' . $producto['imagen']) ?>" 
                        alt="<?= esc($producto['nom']) ?>" 
                        class="producto-img me-3" 
                        style="width: 100px; height: 100px; object-fit: cover;">

                    <!-- Información del producto -->
                    <div class="producto-info flex-grow-1">
                        <h5 class="mb-1"><?= esc($producto['nom']) ?></h5>
                        <p class="producto-texto mb-1"><?= esc(substr($producto['descripcion'], 0, 60)) ?>...</p>
                        <p class="producto-precio mb-1">$<?= number_format($producto['precio'], 0, ',', '.') ?> x <span id="cantidad-<?= $producto['carrito_id'] ?>"><?= $producto['cantidad'] ?></span></p>

                        <!-- Controles de cantidad -->
                        <div class="cantidad-control d-flex align-items-center gap-2 mt-2">
                            <button type="button" class="btn btn-outline-warning btn-sm"
                                onclick="cambiarCantidad(<?= $producto['carrito_id'] ?>, -1)">−</button>
                            <span id="cantidad-<?= $producto['carrito_id'] ?>"><?= $producto['cantidad'] ?></span>
                            <button type="button" class="btn btn-outline-warning btn-sm"
                                onclick="cambiarCantidad(<?= $producto['carrito_id'] ?>, 1)">+</button>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="producto-actions d-flex flex-column gap-2 ms-3">
                        <button onclick="eliminarProducto(<?= $producto['carrito_id'] ?>)" class="btn btn-delete btn-sm">
                            <i class="bi bi-trash"></i>Eliminar
                        </button>


                        <a href="<?= base_url('producto/ver/' . $producto['producto_id']) ?>" class="btn btn-show btn-sm">
                            <i class="bi bi-eye"></i>Ver más
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Columna derecha: resumen -->
        <div class="col-md-4">
            <div class="card card-resumen">
                <h5 class="mb-3">Resumen del Carrito</h5>
                <p class="mb-1">Subtotal: <strong id="subtotal">$0</strong></p>
                <button class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalPago">Comprar Ahora</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de pago -->
<div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header text-white rounded-top-4">
                <h5 class="modal-title" id="modalPagoLabel">Elige el método de pago</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row g-3 justify-content-center">

                    <!-- Pago Contraentrega -->
                    <div class="col-6 col-md-4">
                        <button class="btn btn-light shadow-sm w-100 border border-2 rounded-3 d-flex flex-column align-items-center py-3"
                        onclick="seleccionarMetodo('contraentrega')">
                        <i class="fas fa-truck fa-2x text-primary mb-2"></i>
                        <span class="fw-semibold">Contraentrega</span>
                        </button>
                    </div>

                    <!-- Tarjeta Débito -->
                    <div class="col-6 col-md-4">
                        <button class="btn btn-light shadow-sm w-100 border border-2 rounded-3 d-flex flex-column align-items-center py-3"
                        onclick="seleccionarMetodo('tarjeta')">
                        <i class="fas fa-credit-card fa-2x text-primary mb-2"></i>
                        <span class="fw-semibold">Tarjeta Débito</span>
                        </button>
                    </div>

                    <!-- Tarjeta Crédito -->
                    <div class="col-6 col-md-4">
                        <button class="btn btn-light shadow-sm w-100 border border-2 rounded-3 d-flex flex-column align-items-center py-3"
                        onclick="seleccionarMetodo('tarjeta')">
                        <i class="far fa-credit-card fa-2x text-primary mb-2"></i>
                        <span class="fw-semibold">Tarjeta Crédito</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <?php require_once("../app/Views/footer/footerApp.php") ?>
</footer>

<script>
    // Función para cambiar la cantidad de un producto
    function cambiarCantidad(id, delta) {
        const cantidadSpans = document.querySelectorAll(`#cantidad-${id}`);
        if (cantidadSpans.length === 0) return;

        let cantidad = parseInt(cantidadSpans[0].innerText);
        cantidad = Math.max(1, cantidad + delta);

        // Actualizar visualmente
        cantidadSpans.forEach(span => {
            span.innerText = cantidad;
        });

        // Guardar en sessionStorage
        guardarCantidadEnStorage(id, cantidad);

        actualizarSubtotal();
    }

    // Guardar cantidades en sessionStorage
    function guardarCantidadEnStorage(id, cantidad) {
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        cantidades[id] = cantidad;
        sessionStorage.setItem("cantidades", JSON.stringify(cantidades));
    }

    // Restaurar cantidades desde sessionStorage
    function restaurarCantidadesDesdeStorage() {
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        for (let id in cantidades) {
            const cantidad = cantidades[id];
            const spans = document.querySelectorAll(`#cantidad-${id}`);
            spans.forEach(span => {
                span.innerText = cantidad;
            });
        }
    }

    // Actualizar subtotal
    function actualizarSubtotal() {
        let subtotal = 0;
        const productos = document.querySelectorAll('.producto-carrito');

        productos.forEach(producto => {
            const precio = parseFloat(producto.dataset.precio);
            const id = producto.dataset.id;
            const cantidadSpan = document.getElementById(`cantidad-${id}`);
            if (cantidadSpan) {
                const cantidad = parseInt(cantidadSpan.innerText);
                subtotal += precio * cantidad;
            }
        });

        document.getElementById("subtotal").innerText = `$${subtotal.toLocaleString()}`;
    }

    // Redirección al pago y envío de cantidades al backend
    // Pendiente

    // Eliminar del Carrito
    function eliminarProducto(id) {
        if (!confirm("¿Eliminar este producto del carrito?")) return;

        // Elimina del DOM
        const productoElemento = document.getElementById(`producto-${id}`);
        if (productoElemento) {
            productoElemento.remove();
        }

        // Elimina del sessionStorage
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        delete cantidades[id];
        sessionStorage.setItem("cantidades", JSON.stringify(cantidades));

        actualizarSubtotal();

        // Backend
        fetch(`<?= base_url('carrito/eliminarDelCarrito/') ?>${id}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error || 'Error desconocido');
                });
            }
        })
        .catch(error => {
            alert("Hubo un error al eliminar el producto: " + error.message);
            console.error(error);
        });
    }

    // Selección de metodo
    function seleccionarMetodo(metodo) {
        switch (metodo) {
            case 'contraentrega':
                window.location.href = "<?= base_url('pago/contraentrega') ?>";
                break;
            case 'tarjeta':
                window.location.href = "<?= base_url('pago/tarjeta') ?>";
                break;
            default:
                alert("Método de pago no válido");
        }
    }

    // Al cargar la página
    document.addEventListener("DOMContentLoaded", function () {
        restaurarCantidadesDesdeStorage();
        actualizarSubtotal();
    });
</script>

</body>
</html>