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
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(
                90deg,
                rgb(3, 161, 161) 0%,
                rgb(1, 78, 69) 50%,
                rgb(16, 36, 56) 100%
            );
            font-family: 'Lato', sans-serif;
        }

        .contenedor {
            width: 90%;
            max-width: 1000px;
            padding: 40px 20px;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ---------- Estilos Generales de las Tarjetas ----------*/
        .tarjeta {
            width: 100%;
            max-width: 550px;
            position: relative;
            color: #fff;
            transition: .3s ease all;
            transform: rotateY(0deg);
            transform-style: preserve-3d;
            cursor: pointer;
            z-index: 2;
        }

        .tarjeta.active {
            transform: rotateY(180deg);
        }

        .tarjeta > div {
            padding: 30px;
            border-radius: 15px;
            min-height: 333.46px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 10px 0 rgba(63, 82, 105, 0.84);
        }

        /* ---------- Tarjeta Delantera ----------*/

        .tarjeta .delantera {
            width: 100%;
            background: url("<?= base_url('assets/img/pagos/tarjeta.jpg') ?>");
            background-size: cover;
        }

        .delantera .logo-marca {
            text-align: right;
            min-height: 50px;
        }

        .delantera .logo-marca img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            max-width: 80px;
        }

        .delantera .chip {
            width: 100%;
            max-width: 50px;
            margin-bottom: 20px;
        }

        .delantera .grupo .label {
            font-size: 16px;
            color: #7d8994;
            margin-bottom: 5px;
        }

        .delantera .grupo .numero,
        .delantera .grupo .nombre,
        .delantera .grupo .expiracion {
            color: #fff;
            font-size: 22px;
            text-transform: uppercase;
        }

        .delantera .flexbox {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        /* ---------- Tarjeta Trasera ----------*/
        .trasera {
            background: url("<?= base_url('assets/img/pagos/tarjeta.jpg') ?>");
            background-size: cover;
            position: absolute;
            top: 0;
            transform: rotateY(180deg);
            backface-visibility: hidden;
        }

        .trasera .barra-magnetica {
            height: 40px;
            background: #000;
            width: 100%;
            position: absolute;
            top: 30px;
            left: 0;
        }

        .trasera .datos {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .trasera .datos p {
            margin-bottom: 5px;
        }

        .trasera .datos #firma {
            width: 70%;
        }

        .trasera .datos #firma .firma {
            height: 40px;
            background: repeating-linear-gradient(skyblue 0, skyblue 5px, orange 5px, orange 10px);
        }

        .trasera .datos #firma .firma p {
            line-height: 40px;
            font-family: 'Liu Jian Mao Cao', cursive;
            color: #000;
            font-size: 30px;
            padding: 0 10px;
            text-transform: capitalize;
        }

        .trasera .datos #ccv {
            width: 20%;
        }

        .trasera .datos #ccv .ccv {
            background: #fff;
            height: 40px;
            color: #000;
            padding: 10px;
            text-align: center;
        }

        .trasera .leyenda {
            font-size: 14px;
            line-height: 24px;
        }

        .trasera .link-banco {
            font-size: 14px;
            color: #fff;
        }

        /* ---------- Contenedor Boton ----------*/
        .contenedor-btn .btn-abrir-formulario {
            width: 50px;
            height: 50px;
            font-size: 20px;
            line-height: 20px;
            background: rgb(12, 114, 126);
            color: #fff;
            position: relative;
            top: -25px;
            z-index: 3;
            border-radius: 100%;
            box-shadow: -5px 4px 8px rgb(11, 68, 83);
            padding: 5px;
            transition: all .2s ease;
            border: none;
            cursor: pointer;
            
        }

        .contenedor-btn .btn-abrir-formulario:hover {
            background: rgb(14, 84, 104);
        }

        .contenedor-btn .btn-abrir-formulario.active {
            transform: rotate(45deg);
        }
        
        .contenedor-btn .btn-abrir-formulario i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            line-height: 1;
            pointer-events: none;
        }


        /* ---------- Formulario Tarjeta ----------*/
        .formulario-tarjeta {
            background: #fff;
            width: 100%;
            max-width: 700px;
            padding: 150px 30px 30px 30px;
            border-radius: 10px;
            position: relative;
            top: -150px;
            z-index: 1;
            clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            transition: clip-path .3s ease-out;
        }

        .formulario-tarjeta.active {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        }

        .formulario-tarjeta label {
            display: block;
            color: #7d8994;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .formulario-tarjeta input,
        .formulario-tarjeta select,
        .btn-enviar {
            border: 2px solid #CED6E0;
            font-size: 18px;
            height: 50px;
            width: 100%;
            padding: 5px 12px;
            transition: .3s ease all;
            border-radius: 5px;
        }

        .formulario-tarjeta input:hover,
        .formulario-tarjeta select:hover {
            border: 2px solid #93BDED;
        }

        .formulario-tarjeta input:focus,
        .formulario-tarjeta select:focus {
            outline: rgb(4,4,4);
            box-shadow: 1px 7px 10px -5px rgba(90,116,148,0.3);
        }

        .formulario-tarjeta input {
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .formulario-tarjeta .flexbox {
            display: flex;
            justify-content: space-between;
        }

        .formulario-tarjeta .expira {
            width: 100%;
        }

        .formulario-tarjeta .ccv {
            min-width: 100px;
        }

        .formulario-tarjeta .grupo-select {
            width: 100%;
            margin-right: 15px;
            position: relative;
        }

        .formulario-tarjeta .grupo-select i {
            position: absolute;
            color: #CED6E0;
            top: 18px;
            right: 15px;
            transition: .3s ease all;
        }

        .formulario-tarjeta .grupo-select:hover i {
            color: #93bfed;
        }

        .formulario-tarjeta .btn-enviar {
            border: none;
            padding: 10px;
            font-size: 22px;
            color: #fff;
            background:rgb(12, 114, 126);
            box-shadow: 2px 2px 10px 0px rgba(0,85,212,0.4);
            cursor: pointer;
        }

        .formulario-tarjeta .btn-enviar:hover {
            background:rgb(14, 84, 104);
        }
    </style>
</head>
<body>

<header>
    <?= $this->include('partials/header') ?>
</header>

<div class="contenedor">
	<!-- Tarjeta -->
	<section class="tarjeta" id="tarjeta">
		<div class="delantera">
			<div class="logo-marca" id="logo-marca">
				<!-- <img src="img/logos/visa.png" alt=""> -->
			</div>
			<img src="../assets/img/pagos/chip.png" class="chip" alt="">
			<div class="datos">
				<div class="grupo" id="numero">
					<p class="label">Número Tarjeta</p>
					<p class="numero">#### #### #### ####</p>
				</div>
				<div class="flexbox">
					<div class="grupo" id="nombre">
						<p class="label">Nombre Tarjeta</p>
						<p class="nombre">Jhon Doe</p>
					</div>

					<div class="grupo" id="expiracion">
						<p class="label">Expiracion</p>
						<p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="trasera">
			<div class="barra-magnetica"></div>
			<div class="datos">
				<div class="grupo" id="firma">
					<p class="label">Firma</p>
					<div class="firma"><p></p></div>
				</div>
				<div class="grupo" id="ccv">
					<p class="label">CCV</p>
					<p class="ccv"></p>
				</div>
			</div>
				<p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
				<a href="#" class="link-banco">www.tubanco.com</a>
		</div>
	</section>

	<!-- Contenedor Boton Abrir Formulario -->
	<div class="contenedor-btn">
		<button class="btn-abrir-formulario" id="btn-abrir-formulario">
			<i class="fas fa-plus"></i>
		</button>
	</div>

	<!-- Formulario -->
	<form action="" id="formulario-tarjeta" class="formulario-tarjeta">
		<div class="grupo">
			<label for="inputNumero">Número Tarjeta</label>
			<input type="text" id="inputNumero" maxlength="19" autocomplete="off">
		</div>
		<div class="grupo">
			<label for="inputNombre">Nombre</label>
			<input type="text" id="inputNombre" maxlength="19" autocomplete="off">
		</div>
		<div class="flexbox">
			<div class="grupo expira">
				<label for="selectMes">Expiracion</label>
				<div class="flexbox">
					<div class="grupo-select">
						<select name="mes" id="selectMes">
							<option disabled selected>Mes</option>
						</select>
					</div>
					<div class="grupo-select">
						<select name="year" id="selectYear">
							<option disabled selected>Año</option>
						</select>
					</div>
				</div>
			</div>

			<div class="grupo ccv">
				<label for="inputCCV">CCV</label>
				<input type="text" id="inputCCV" maxlength="3">
			</div>
		</div>
		<button type="submit" class="btn-enviar">Enviar</button>
	</form>
</div>

<footer>
    <?php require_once("../app/Views/footer/footerApp.php") ?>
</footer>


<script>
    document.querySelector('.btn-enviar').addEventListener('click', function(event) {
        event.preventDefault(); // Evita el envío del formulario
        window.location.href = '<?= base_url('pago/entrega') ?>';
    });


    const tarjeta = document.querySelector('#tarjeta'),
        btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
        formulario = document.querySelector('#formulario-tarjeta'),
        numeroTarjeta = document.querySelector('#tarjeta .numero'),
        nombreTarjeta = document.querySelector('#tarjeta .nombre'),
        logoMarca = document.querySelector('#logo-marca'),
        firma = document.querySelector('#tarjeta .firma p'),
        mesExpiracion = document.querySelector('#tarjeta .mes'),
        yearExpiracion = document.querySelector('#tarjeta .year');
    ccv = document.querySelector('#tarjeta .ccv');

    // * Volteamos la tarjeta para mostrar el frente.
    const mostrarFrente = () => {
        if (tarjeta.classList.contains('active')) {
            tarjeta.classList.remove('active');
        }
    }

    // * Rotacion de la tarjeta
    tarjeta.addEventListener('click', () => {
        tarjeta.classList.toggle('active');
    });

    // * Boton de abrir formulario
    btnAbrirFormulario.addEventListener('click', () => {
        btnAbrirFormulario.classList.toggle('active');
        formulario.classList.toggle('active');
    });

    // * Select del mes generado dinamicamente.
    for (let i = 1; i <= 12; i++) {
        let opcion = document.createElement('option');
        opcion.value = i;
        opcion.innerText = i;
        formulario.selectMes.appendChild(opcion);
    }

    // * Select del año generado dinamicamente.
    const yearActual = new Date().getFullYear();
    for (let i = yearActual; i <= yearActual + 8; i++) {
        let opcion = document.createElement('option');
        opcion.value = i;
        opcion.innerText = i;
        formulario.selectYear.appendChild(opcion);
    }

    // * Input numero de tarjeta
    formulario.inputNumero.addEventListener('keyup', (e) => {
        let valorInput = e.target.value;

        formulario.inputNumero.value = valorInput
            // Eliminamos espacios en blanco
            .replace(/\s/g, '')
            // Eliminar las letras
            .replace(/\D/g, '')
            // Ponemos espacio cada cuatro numeros
            .replace(/([0-9]{4})/g, '$1 ')
            // Elimina el ultimo espaciado
            .trim();

        numeroTarjeta.textContent = valorInput;

        if (valorInput == '') {
            numeroTarjeta.textContent = '#### #### #### ####';

            logoMarca.innerHTML = '';
        }

        if (valorInput[0] == 4) {
            logoMarca.innerHTML = '';
            const imagen = document.createElement('img');
            imagen.src = '../assets/img/pagos/visa.png';
            logoMarca.appendChild(imagen);
        } else if (valorInput[0] == 5) {
            logoMarca.innerHTML = '';
            const imagen = document.createElement('img');
            imagen.src = '../assets/img/pagos/mastercard.png';
            logoMarca.appendChild(imagen);
        }

        // Volteamos la tarjeta para que el usuario vea el frente.
        mostrarFrente();
    });

    // * Input nombre de tarjeta
    formulario.inputNombre.addEventListener('keyup', (e) => {
        let valorInput = e.target.value;

        formulario.inputNombre.value = valorInput.replace(/[0-9]/g, '');
        nombreTarjeta.textContent = valorInput;
        firma.textContent = valorInput;

        if (valorInput == '') {
            nombreTarjeta.textContent = 'Jhon Doe';
        }

        mostrarFrente();
    });

    // * Select mes
    formulario.selectMes.addEventListener('change', (e) => {
        mesExpiracion.textContent = e.target.value;
        mostrarFrente();
    });

    // * Select Año
    formulario.selectYear.addEventListener('change', (e) => {
        yearExpiracion.textContent = e.target.value.slice(2);
        mostrarFrente();
    });

    // * CCV
    formulario.inputCCV.addEventListener('keyup', () => {
        if (!tarjeta.classList.contains('active')) {
            tarjeta.classList.toggle('active');
        }

        formulario.inputCCV.value = formulario.inputCCV.value
            // Eliminar los espacios
            .replace(/\s/g, '')
            // Eliminar las letras
            .replace(/\D/g, '');

        ccv.textContent = formulario.inputCCV.value;
    });
</script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>