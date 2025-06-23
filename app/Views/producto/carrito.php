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
            object-fit: contain !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            display: block;
            margin: auto;
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
            color: white;
            border: none;
            font-weight: bold;
        }

        .card-resumen button:hover {
            background-color: #0d6a76;
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

        /* Preload */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            <?php foreach ($productoscarrito as $producto): ?>
                <div class="producto-card producto-carrito d-flex mb-3 p-3 border rounded shadow-sm align-items-center" 
                    id="producto-<?= $producto['carrito_id'] ?>"
                    data-id="<?= $producto['carrito_id'] ?>"
                    data-nombre="<?= esc($producto['nom']) ?>"
                    data-precio="<?= $producto['precio'] ?>"
                    data-cantidad="<?= $producto['cantidad'] ?>">
                    
                    <!-- Imagen del producto -->
                    <img src="<?= base_url('Uploads/' . $producto['imagen']) ?>" 
                        alt="<?= esc($producto['nom']) ?>" 
                        class="producto-img me-3">

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
            <form id="formFactura" action="<?= base_url('facturas/registrar') ?>" method="post" class="card card-resumen p-4 shadow rounded">
                <!-- Título -->
                <h5 class="mb-3">Resumen del Carrito</h5>

                <!-- Datos ocultos -->
                <input type="hidden" name="numbering_range_id" value="8">
                <input type="hidden" name="reference_code" id="reference_code">
                <input type="hidden" name="observation" value="">
                <input type="hidden" name="payment_form" value="1">
                <input type="hidden" name="payment_due_date" value="2024-12-30">
                <input type="hidden" name="payment_method_code" value="10">
                <input type="hidden" name="operation_type" value="10">
                <input type="hidden" name="order_reference[reference_code]" value="ref-001">
                <input type="hidden" name="order_reference[issue_date]" value="">
                <input type="hidden" name="billing_period[start_date]" value="2024-01-10">
                <input type="hidden" name="billing_period[start_time]" value="00:00:00">
                <input type="hidden" name="billing_period[end_date]" value="2024-02-09">
                <input type="hidden" name="billing_period[end_time]" value="23:59:59">
                <input type="hidden" name="customer[dv]" value="3">

                <!-- Cliente -->
                <div class="mb-2">
                    <label for="identification">Identificación</label>
                    <input type="text" name="customer[identification]" id="identification" class="form-control"
                        value="<?= esc($usuario['documento']) ?>" required>
                </div>
                <div class="mb-2">
                    <label for="names">Nombres</label>
                    <input type="text" name="customer[names]" id="names" class="form-control"
                        value="<?= esc($usuario['primer_nombre'] . ' ' . ($usuario['segundo_nombre'] ?? '') . ' ' . $usuario['primer_apellido'] . ' ' . ($usuario['segundo_apellido'] ?? '')) ?>" required>
                </div>
                <div class="mb-2">
                    <label for="address">Dirección</label>
                    <input type="text" name="customer[address]" id="address" class="form-control"
                        value="<?= esc($usuario['direccion']) ?>">
                </div>
                <div class="mb-2">
                    <label for="email">Correo</label>
                    <input type="email" name="customer[email]" id="email" class="form-control"
                        value="<?= esc($usuario['correo']) ?>">
                </div>
                <div class="mb-2">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="customer[phone]" id="phone" class="form-control"
                        value="<?= esc($usuario['telefono1']) ?>">
                </div>

                <!-- Ocultos cliente -->
                <input type="hidden" name="customer[company]" value="">
                <input type="hidden" name="customer[trade_name]" value="">
                <input type="hidden" name="customer[legal_organization_id]" value="2">
                <input type="hidden" name="customer[tribute_id]" value="21">
                <input type="hidden" name="customer[identification_document_id]" value="3">
                <input type="hidden" name="customer[municipality_id]" value="980">

                <!-- Productos -->
                <div id="productos-container"></div>

                <div id="productos-container"></div>
                <p class="mb-1">Subtotal: <strong id="subtotal">$0</strong></p>

                <!-- Botones -->
                <button type="submit" class="btn btn-success d-none">Enviar factura</button>
                <button type="button" class="btn btn-outline-primary w-100" onclick="prepararPago()">
                    <i class="bi bi-credit-card"></i> Pagar
                </button>
            </form>

            <!-- Formulario PayU externo -->
            <form id="formPayU" method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                <input name="merchantId"    type="hidden" value="508029">
                <input name="accountId"     type="hidden" value="512321">
                <input name="description"   type="hidden" value="Factura electrónica">
                <input name="referenceCode" type="hidden" id="payu_refcode">
                <input name="amount"        type="hidden" id="payu_amount">
                <input name="tax"           type="hidden" value="0">
                <input name="taxReturnBase" type="hidden" value="0">
                <input name="currency"      type="hidden" value="COP">
                <input name="signature"     type="hidden" id="payu_signature">
                <input name="test"          type="hidden" value="1">
                <input name="buyerEmail"    type="hidden" id="payu_email">
                <input name="responseUrl"   type="hidden" value="<?= base_url('facturas/respuesta') ?>">
               <input name="confirmationUrl" type="hidden" value="https://01f7-179-51-111-179.ngrok-free.app/facturas/confirmacion">
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
<script>
    // ==========================
    // FUNCIONES UTILITARIAS
    // ==========================

    function calcularTotalFactura() {
        const precios = document.querySelectorAll('input[name^="items"][name$="[price]"]');
        const cantidades = document.querySelectorAll('input[name^="items"][name$="[quantity]"]');
        let total = 0;
        for (let i = 0; i < precios.length; i++) {
            const precio = parseFloat(precios[i].value) || 0;
            const cantidad = parseInt(cantidades[i].value) || 0;
            total += precio * cantidad;
        }
        return total.toFixed(2);
    }

    function guardarCantidadEnStorage(id, cantidad) {
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        cantidades[id] = cantidad;
        sessionStorage.setItem("cantidades", JSON.stringify(cantidades));

        // 🔁 Mostrar preload y recargar
        const preload = document.getElementById("preload");
        if (preload) preload.style.display = "flex";

        // Esperar unos ms antes de recargar (para que se vea la animación)
        setTimeout(() => {
            location.reload();
        }, 700); // puedes ajustar el tiempo
    }

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

    function cambiarCantidad(id, delta) {
        const cantidadSpans = document.querySelectorAll(`#cantidad-${id}`);
        if (cantidadSpans.length === 0) return;

        let cantidad = parseInt(cantidadSpans[0].innerText);
        cantidad = Math.max(1, cantidad + delta);

        cantidadSpans.forEach(span => {
            span.innerText = cantidad;
        });

        guardarCantidadEnStorage(id, cantidad);
        actualizarSubtotal();
    }

    function eliminarProducto(id) {
        if (!confirm("¿Eliminar este producto del carrito?")) return;

        // 1. Eliminar del DOM visual (carrito)
        const productoElemento = document.getElementById(`producto-${id}`);
        if (productoElemento) {
            productoElemento.remove();
        }

        // 2. Eliminar del sessionStorage
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        delete cantidades[id];
        sessionStorage.setItem("cantidades", JSON.stringify(cantidades));

        // 3. Eliminar los inputs ocultos del formulario (formFactura)
        const container = document.getElementById("productos-container");
        const bloques = container.querySelectorAll("div");

        bloques.forEach(bloque => {
            const inputRef = bloque.querySelector(`input[name$="[code_reference]"]`);
            if (inputRef && inputRef.value == id) {
                bloque.remove();
            }
        });

        // 4. Actualizar subtotal
        actualizarSubtotal();

        // 5. Eliminar del backend
        fetch(`<?= base_url('carrito/eliminarDelCarrito/') ?>${id}`, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
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


    // ==========================
    // CARGAR PRODUCTOS DEL CARRITO AL FORMULARIO
    // ==========================

    function cargarProductosEnFormulario() {
        const productos = document.querySelectorAll('.producto-carrito');
        const container = document.getElementById("productos-container");
        let cantidades = JSON.parse(sessionStorage.getItem("cantidades")) || {};
        let itemIndex = 0;

        productos.forEach(producto => {
            const id = producto.dataset.id;
            const nombre = producto.dataset.nombre;
            const precio = parseFloat(producto.dataset.precio);
            const cantidad = parseInt(cantidades[id] || producto.dataset.cantidad || 1);

            const html = `
                <div class="border rounded p-3 mb-3">
                    <h6>Producto: ${nombre}</h6>
                    <input type="hidden" name="items[${itemIndex}][name]" value="${nombre}">
                    <input type="hidden" name="items[${itemIndex}][code_reference]" value="${id}">
                    <input type="hidden" name="items[${itemIndex}][quantity]" value="${cantidad}">
                    <input type="hidden" name="items[${itemIndex}][price]" value="${precio}">
                    <!-- Ocultos -->
                    <input type="hidden" name="items[${itemIndex}][scheme_id]" value="0">
                    <input type="hidden" name="items[${itemIndex}][note]" value="">
                    <input type="hidden" name="items[${itemIndex}][discount_rate]" value="0">
                    <input type="hidden" name="items[${itemIndex}][tax_rate]" value="19.00">
                    <input type="hidden" name="items[${itemIndex}][unit_measure_id]" value="70">
                    <input type="hidden" name="items[${itemIndex}][standard_code_id]" value="1">
                    <input type="hidden" name="items[${itemIndex}][is_excluded]" value="0">
                    <input type="hidden" name="items[${itemIndex}][tribute_id]" value="1">
                    <input type="hidden" name="items[${itemIndex}][withholding_taxes][0][code]" value="06">
                    <input type="hidden" name="items[${itemIndex}][withholding_taxes][0][withholding_tax_rate]" value="7.00">
                    <input type="hidden" name="items[${itemIndex}][withholding_taxes][1][code]" value="05">
                    <input type="hidden" name="items[${itemIndex}][withholding_taxes][1][withholding_tax_rate]" value="15.00">
                    <input type="hidden" name="items[${itemIndex}][mandate][identification_document_id]" value="6">
                    <input type="hidden" name="items[${itemIndex}][mandate][identification]" value="123456789">
                </div>
            `;
            container.insertAdjacentHTML("beforeend", html);
            itemIndex++;
        });
    }

    // ==========================
    // PAGO CON PAYU
    // ==========================

    function prepararPago() {
        const reference = 'ref_' + Date.now();
        const email = document.getElementById("email").value;
        const amount = calcularTotalFactura();
        const apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        const merchantId = "508029";
        const currency = "COP";

        const signatureRaw = `${apiKey}~${merchantId}~${reference}~${amount}~${currency}`;
        const signature = md5(signatureRaw);

        document.getElementById("payu_refcode").value = reference;
        document.getElementById("payu_amount").value = amount;
        document.getElementById("payu_signature").value = signature;
        document.getElementById("payu_email").value = email;

        const form = document.getElementById("formFactura");
        const formData = new FormData(form);
        formData.append('reference_code', reference);
         console.log("formData")
        fetch("<?= base_url('facturas/guardar-temporal') ?>", {
            method: "POST",
            body: formData,
           
        }).then(() => {
            document.getElementById("formPayU").submit();
        });
    }

    // ==========================
    // AL CARGAR LA PÁGINA
    // ==========================

    document.addEventListener("DOMContentLoaded", function () {
        restaurarCantidadesDesdeStorage();
        actualizarSubtotal();
        cargarProductosEnFormulario();
    });
</script>

<footer>
    <?php require_once("../app/Views/footer/footerApp.php") ?>
</footer>

<div id="preload" style="
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    display: none;">
    <div class="spinner" style="
        width: 60px;
        height: 60px;
        border: 6px solid #ccc;
        border-top: 6px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;">
    </div>
</div>

</body>
</html>