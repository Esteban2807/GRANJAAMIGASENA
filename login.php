<?php
require_once __DIR__ . '/config/login.php';
$login_error = $_SESSION['login_error'] ?? null;
if ($login_error) {
    unset($_SESSION['login_error']);
}
?>
    

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión / Registro</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="login-page">

    <!-- Inserta esto: blur del fondo sin afectar el card ni las animaciones -->
    <div class="login-backdrop" aria-hidden="true"></div>

    <!-- Contenedor principal del login -->
    <div class="login-wrapper">

        <!-- Encabezado con logo y marca -->
        <div class="login-header">
            <div class="login-logo">
                <img src="img/logo_sena_verde.png" alt="Logo SENA">
                <span class="login-brand">GRANJA<span class="green">AMIGA</span></span>
            </div>
            <a href="https://portal.senasofiaplus.edu.co/">
                <i class="fa-solid fa-arrow-left"></i> Ir a Portal SENA
            </a>
        </div>

        <!-- Pestañas: Iniciar sesión / Registrarse -->
        <div class="login-tabs">
            <div class="login-tab active" data-tab="login">
                <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
            </div>
            <div class="login-tab" data-tab="signup">
                <i class="fa-solid fa-user-plus"></i> Registrarse
            </div>
        </div>

        <!-- Formulario de Iniciar Sesión -->
        <form method="post" action="" class="login-form active" id="login-form">
            <input type="hidden" name="action" value="login">
            <div class="form-field">
                <label for="docType">Tipo de documento *</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-id-card input-icon"></i>
                    <select id="tipo_documento" name="tipo_documento" required>
                        <option value="">Cédula de Ciudadanía</option>
                        <option value="CC">Cédula de ciudadanía</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="CE">Cédula de extranjería</option>
                        <option value="PAS">Pasaporte</option>
                    </select>
                </div>
            </div>

            <div class="form-field">
                <label for="documento">Número de documento *</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-hashtag input-icon"></i>
                    <input type="text" id="documento" name="documento" placeholder="Ingrese su número de documento" required />
                </div>
            </div>

            <div class="form-field">
                <label for="contrasena">Contraseña *</label>
                <div class="password-container">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required />
                    <i class="fa-solid fa-eye toggle-password"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-cloud"></i>Iniciar sesión
            </button>

            <div class="help-links">
                ¿No recuerdas tu contraseña? <a href="#">Restablecer</a><br>
                ¿Tu cuenta está inactiva? <a href="#">Más información</a>
            </div>
        </form>

        <!-- Formulario de Registro -->
        <form method="post" action="" class="login-form" id="signup-form">
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="id_cargo" value="2">

            <div class="signup-scroll-content">
                  <div class="form-field">
                    <label for="docTypeSignup">Tipo_documento</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-id-card input-icon"></i>
                        <select id="docTypeSignup" name="id_cargo" required>
                            <option value="">Tipo Documento...</option>
                            <option value="CC">Cédula de ciudadanía</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cédula de extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label for="lastName">Documento *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="lastName" name="documento" placeholder="Documento" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="email">Correo electrónico *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" id="email" name="correo" placeholder="Correo electrónico" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="username">Nombres *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-at input-icon"></i>
                        <input type="text" id="username" name="nombres" placeholder="Nombres" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="signupPassword">Apellidos *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="text" id="signupPassword" name="apellidos" placeholder="Apellidos" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-field">
                    <label for="confirmPassword"></i> Contraseña *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="confirmPassword" name="confirm_contrasena" placeholder="Confirmar contraseña" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

              
            </div>
            <button type="submit" class="btn-login">
                <i class="fa-solid fa-user-plus"></i> Registrarse
            </button>
        </form>

        <!-- Footer del login -->
        <div class="footer-login">
            © 2025 NEXO. Todos los derechos reservados.
        </div>
    </div>

    <!-- Script para el modo oscuro (igual que en index) -->
    <script src="js/login.js"></script>
    <script src="js/tema.js"></script>

</body>

</html>