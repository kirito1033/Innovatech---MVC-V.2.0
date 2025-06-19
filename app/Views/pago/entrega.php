<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Entrega</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #005b63, #0c2d3e);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        main.contenido-principal {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        .card-contraentrega {
            background-color: #0f1e26;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 217, 231, 0.2);
            width: 100%;
            max-width: 500px;
            color: white;
            z-index: 2;
            position: relative;
        }

        .card-contraentrega h2 {
            text-align: center;
            color: #00d9e7;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #17343d;
            border: 1px solid #0e5962;
            color: #fff;
            z-index: 2;
            position: relative;
        }

        .form-control:focus {
            border-color: #00d9e7;
            box-shadow: 0 0 5px rgba(0,217,231,0.6);
            background-color: #17343d;
            color: white;
        }

        label {
            margin-bottom: 5px;
        }

        .btn-confirmar {
            background-color: #00d9e7 !important;
            color: #0c2d3e !important;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            padding: 12px;
            transition: background 0.3s ease;
            z-index: 3;
            position: relative;
            text-align: center;
        }

        .btn-confirmar:hover {
            background-color:rgb(1, 94, 100) !important;
            color:rgb(248, 248, 248) !important;
        }

        .info-text {
            font-size: 0.95rem;
            color: #ccc;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <header>
        <?= $this->include('partials/header') ?>
    </header>

    <main class="contenido-principal">
        <div class="card-contraentrega">
            <h2>Datos de Entrega</h2>
            <p class="info-text">Recibirás tu pedido en la dirección indicada y podrás pagarlo en efectivo al momento de la entrega.</p>

            <form action="<?= base_url('procesar-contraentrega') ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de entrega</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono de contacto</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                </div>
                <button type="submit" class="btn btn-confirmar w-100 mt-3">Confirmar Pedido</button>
            </form>
        </div>
    </main>

    <footer>
        <?php require_once("../app/Views/footer/footerApp.php") ?>
    </footer>


    <script>
        
    </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>