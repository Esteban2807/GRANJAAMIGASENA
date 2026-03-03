<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Sistema de Gestión</title>
    <link rel="stylesheet" href="css/nexo-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Contenedor de carga inicial -->
    <div id="loader">
        <img src="img/logo_sena_verde.png" alt="Logo SENA" id="loader-logo">
    </div>

    <!-- Header -->
    <header class="header"><?php include './config/header.php' ?></header>

    <!-- Main Content -->
    <main class="container">
        <div class="page-header">
            <h1 class="page-title">Cruds</h1>
            <p class="page-subtitle">Seleccione una tabla para gestionar</p>
        </div>

        <!-- Cards Grid -->
        <ul class="cards-grid">
            <li class="card">
                <a href="l_tipos_documento.php">
                    <div class="card-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="card-title">Tipos de documento</h3>
                    <p class="card-description">Gestionar tipos de documento</p>
                </a>
            </li>

            <li class="card">
                <a href="l_usuarios.php">
                    <div class="card-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3 class="card-title">Usuarios</h3>
                    <p class="card-description">Administrar usuarios del sistema</p>
                </a>
            </li>

            <li class="card">
                <a href="l_especies.php">
                    <div class="card-icon">
                        <i class="fas fa-venus-mars"></i>
                    </div>
                    <h3 class="card-title">Especies</h3>
                    <p class="card-description">Administrar especies</p>
                </a>
            </li>

            <li class="card">
                <a href="l_razas.php">
                    <div class="card-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <h3 class="card-title">Razas</h3>
                    <p class="card-description">Administrar razas</p>
                </a>
            </li>
        </ul>
    </main>

    <!-- Footer -->
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <!-- Scripts -->
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/sweetalerts.js"></script>

</body>

</html>