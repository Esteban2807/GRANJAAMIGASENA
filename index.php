<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
$nombreUsuario = $_SESSION['user']['nombres'] ?? 'Usuario';

// Solo mostrar bienvenida si viene directo del login
$mostrarBienvenida = false;
if (!empty($_SESSION['mostrar_bienvenida'])) {
    $mostrarBienvenida = true;
    unset($_SESSION['mostrar_bienvenida']); // consumir — no vuelve a aparecer
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Sistema de Gestión</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="loader">
        <img src="/img/logo_sena_verde.png" alt="Logo SENA" id="loader-logo">
    </div>

    <header class="header"><?php include './config/header.php' ?></header>

    <main class="container">
        <div class="page-header">
            <h1 class="page-title">Bienvenido!</h1>
            <p class="page-subtitle">Seleccione una tabla para gestionar</p>
        </div>

        <ul class="cards-grid">
            <li class="card"><a href="l_animales.php">
                    <div class="card-icon"><i class="fas fa-paw"></i></div>
                    <h3 class="card-title">Animales</h3>
                    <p class="card-description">Administrar animales</p>
                </a></li>
            <li class="card"><a href="l_tipos_documento.php">
                    <div class="card-icon"><i class="fas fa-id-card"></i></div>
                    <h3 class="card-title">Tipos de documento</h3>
                    <p class="card-description">Gestionar tipos de documento</p>
                </a></li>
            <li class="card"><a href="l_usuarios.php">
                    <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                    <h3 class="card-title">Usuarios</h3>
                    <p class="card-description">Administrar usuarios del sistema</p>
                </a></li>
            <li class="card"><a href="l_especies.php">
                    <div class="card-icon"><i class="fas fa-venus-mars"></i></div>
                    <h3 class="card-title">Especies</h3>
                    <p class="card-description">Administrar especies</p>
                </a></li>
            <li class="card"><a href="l_razas.php">
                    <div class="card-icon"><i class="fas fa-paw"></i></div>
                    <h3 class="card-title">Razas</h3>
                    <p class="card-description">Administrar razas</p>
                </a></li>
            <li class="card"><a href="l_cargos.php">
                    <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                    <h3 class="card-title">Cargos</h3>
                    <p class="card-description">Administrar cargos</p>
                </a></li>
            <li class="card"><a href="l_alimentos.php">
                    <div class="card-icon"><i class="fas fa-apple-alt"></i></div>
                    <h3 class="card-title">Alimentos</h3>
                    <p class="card-description">Inventario de alimentos</p>
                </a></li>
            <li class="card"><a href="l_medicamentos.php">
                    <div class="card-icon"><i class="fas fa-pills"></i></div>
                    <h3 class="card-title">Medicamentos</h3>
                    <p class="card-description">Inventario de medicamentos</p>
                </a></li>
            <li class="card"><a href="l_vacunas.php">
                    <div class="card-icon"><i class="fas fa-syringe"></i></div>
                    <h3 class="card-title">Vacunas</h3>
                    <p class="card-description">Inventario de vacunas</p>
                </a></li>
            <li class="card"><a href="l_alimentaciones.php">
                    <div class="card-icon"><i class="fas fa-drumstick-bite"></i></div>
                    <h3 class="card-title">Alimentaciones</h3>
                    <p class="card-description">Control de alimentación</p>
                </a></li>
            <li class="card"><a href="l_medicaciones.php">
                    <div class="card-icon"><i class="fas fa-notes-medical"></i></div>
                    <h3 class="card-title">Medicaciones</h3>
                    <p class="card-description">Registro de medicaciones</p>
                </a></li>
            <li class="card"><a href="l_vacunaciones.php">
                    <div class="card-icon"><i class="fas fa-syringe"></i></div>
                    <h3 class="card-title">Vacunaciones</h3>
                    <p class="card-description">Registro de vacunaciones</p>
                </a></li>
            <li class="card"><a href="l_partos.php">
                    <div class="card-icon"><i class="fas fa-baby"></i></div>
                    <h3 class="card-title">Partos</h3>
                    <p class="card-description">Control de partos</p>
                </a></li>
            <li class="card"><a href="l_nacimientos.php">
                    <div class="card-icon"><i class="fas fa-baby-carriage"></i></div>
                    <h3 class="card-title">Nacimientos</h3>
                    <p class="card-description">Registro de nacimientos</p>
                </a></li>
            <li class="card"><a href="l_atenciones_veterinarias.php">
                    <div class="card-icon"><i class="fas fa-stethoscope"></i></div>
                    <h3 class="card-title">Atenciones Veterinarias</h3>
                    <p class="card-description">Historial de atenciones</p>
                </a></li>
        </ul>
    </main>

    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <!-- Scripts -->
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/sweetalerts.js"></script>
    <script src="js/asistente_voz.js"></script>
    <?php if ($mostrarBienvenida): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nombre = <?= json_encode($nombreUsuario) ?>;
                const hora = new Date().getHours();
                let saludo = hora < 12 ? 'Buenos días' : hora < 18 ? 'Buenas tardes' : 'Buenas noches';

                Swal.fire({
                    icon: 'success',
                    title: `🌿 ${saludo}, ${nombre}!`,
                    html: `
                    <p style="margin:0; font-size:1rem; color: var(--text-secondary, #aaa);">
                        Bienvenido al sistema de gestión<br>
                        <strong style="color:#39a900;">GRANJA AMIGA</strong>
                    </p>
                `,
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    background: 'var(--card-bg, #1e1e1e)',
                    color: 'var(--text-primary, #fff)',
                    iconColor: '#39a900'
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>