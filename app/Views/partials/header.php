<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inovatech.com</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>
  <header class="header">
    <nav class="header_nav">
      <ul class="header__nav-ul">
        <li class="header__nav-li">
          <form class="header__nav-li--form">
            <button class="btn btn-primary header__boton-abrir" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
              <i class="bi bi-list logo-menu"></i>
            </button>
            <div class="logo-celular">
             <a href="<?= base_url('/') ?>"><img class="logo"src ="/assets/img/logo-celular.png" alt=""></a> 
            </div>
         <div class="boton-buscar">
          <input class="input-buscar" id="buscadorNav" type="text" placeholder="Buscar productos" >
          <button type="button" class="buscar" onclick="buscarProductos()" id="botonBuscar">
            <i class="bi bi-search"></i>
          </button>
        </div>

            <div class="carrito-compras">
              <a href="<?= base_url("/carrito")?>"><i class="bi bi-cart"></i></a>
            </div>
            <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
              aria-labelledby="staticBackdropLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel">MENU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="nav nav-pills flex-column offcanvas__nav-ul ">
                  <li class="nav-item offcanvas__nav-ul-li">
                    <a href="../Pages/index.html"><i class="bi bi-house"></i>Inicio</a>
                  </li>
                  <li class="nav-item offcanvas__nav-ul-li">
                    <a href="Notificaciones.html"> <i class="bi bi-bell"></i>Notificaciones</a>
                    <li class="nav-item offcanvas__nav-ul-li dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="bi bi-dropbox"></i> Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($categorias as $categoria): ?>
                        <li><a class="dropdown-item" href="<?= base_url('categoria/' . $categoria['id']) ?>"><?= esc($categoria['nom']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    </li>

        </li>
        <li class="nav-item">
          <a href="miscompras.html"> <i class="bi bi-bag"></i>Mis compras</a>
        </li>
        <li class="nav-item offcanvas__nav-ul-li">
          <a href="oferta.html"> <i class="bi bi-tags"></i>ofertas</a>
        </li>
        <li class="nav-item offcanvas__nav-ul-li">
        <a href="<?= base_url('pqrs/Cpqrs') ?>"><i class="bi bi-info-circle icon"></i>Ayuda / PQR</a>
        </li>
        <li>

        <li class="nav-item offcanvas__nav-ul-li">
        <a href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-left"></i>Cerrar sesión</a>
        </li>
      </ul>
      </div>
      </div>
      </form>
      <div class="header-pc">
        <ul class="nav nav-pills header-pc__nav-ul ">
          <li class="nav-item header-pc__nav-ul-li">
            <a class="header__pc-li-link" href="<?= base_url('/') ?>"><i class="bi bi-house"></i>Inicio</a>
          </li>
          <li class="nav-item header-pc__nav-ul-li">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo"> <i class="bi bi-bell"></i>Notificaciones</a>
          </li>
         <li class="nav-item dropdown header-pc__nav-ul-li">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
        <i class="bi bi-dropbox"></i> Categorías
    </a>
        <ul class="dropdown-menu">
            <?php foreach ($categorias as $categoria): ?>
                <li>
                    <a class="dropdown-item" href="<?= base_url('categoria/' . $categoria['id']) ?>">
                        <?= esc($categoria['nom']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <hr class="dropdown-divider">
        </ul>
    </li>
          <li class="nav-item header-pc__nav-ul-li">
          <a href="#" data-bs-toggle="modal" data-bs-target="#modalEnDesarrollo">  <i class="bi bi-bag"></i>Mis compras</a>
          </li>
          <li class="nav-item header-pc__nav-ul-li">
            <a href="<?= base_url('ofertas/6') ?>"><i class="bi bi-tags"></i>Ofertas</a>
          </li>
          <li class="nav-item header-pc__nav-ul-li">
          <a href="<?= base_url('pqrs/Cpqrs') ?>"><i class="bi bi-info-circle icon"></i>Ayuda/PQR</a>
          </li>
          <li class="nav-item  header-pc__nav-ul-li">
          <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item  header-pc__nav-ul-li">
            <a href="<?= base_url("/perfil") ?>">
              <i class="bi bi-person-circle"></i> Mi perfil
            </a>
          </li>
          
        <?php endif; ?>
          </li>
          <li class="nav-item header-pc__nav-ul-li">
          <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item header-pc__nav-ul-li">
            <a href="<?= base_url('/logout') ?>">
              <i class="bi bi-box-arrow-left"></i> Cerrar sesión
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item header-pc__nav-ul-li">
            <a href="<?= base_url('/usuario/login') ?>">
              <i class="bi bi-box-arrow-left"></i> Iniciar sesión
            </a>
          </li>
        <?php endif; ?>
          </li>
        </ul>
      </div>
      </li>
      </ul>
    </nav>
  </header>

<!-- Bootstrap JS Bundle (al final del body) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Detectar Enter en el input
  document.getElementById("buscadorNav").addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      e.preventDefault(); // evita comportamiento por defecto (en caso de formulario)
      document.getElementById("botonBuscar").click(); // simula clic en el botón
    }
  });

  function buscarProductos() {
    const valor = document.getElementById('buscadorNav').value.trim();
    const baseUrl = "<?= base_url('categorias') ?>";

    if (valor !== '') {
      window.location.href = baseUrl + '?nom=' + encodeURIComponent(valor);
    }
  }
</script>