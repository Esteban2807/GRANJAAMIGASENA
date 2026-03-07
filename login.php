<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión / Registro</title>

    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- RECAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcIVoIsAAAAAPcFXkk1ZMDn9wYSJy-qwebpmA4H"></script>

</head>

<body class="login-page">

    <div class="login-backdrop"></div>

    <div class="login-wrapper">

        <!-- HEADER -->
        <div class="login-header">

            <div class="login-logo">
                <img src="img/logo_sena_verde.png">
                <span class="login-brand">NE<span class="green">XO</span></span>
            </div>

            <a href="https://portal.senasofiaplus.edu.co/">
                <i class="fa-solid fa-arrow-left"></i> Ir a Portal SENA
            </a>

        </div>

        <!-- TABS -->
        <div class="login-tabs">

            <div class="login-tab active" data-tab="login">
                <i class="fa-solid fa-right-to-bracket"></i>
                Iniciar sesión
            </div>

            <div class="login-tab" data-tab="signup">
                <i class="fa-solid fa-user-plus"></i>
                Registrarse
            </div>

        </div>

        <!-- LOGIN -->
        <div class="login-form active" id="login-form">

            <div class="form-field">

                <label>Tipo de documento *</label>

                <div class="input-with-icon">

                    <i class="fa-solid fa-id-card input-icon"></i>

                    <select id="tipoDocumento" required>

                        <option value="">Cédula de Ciudadanía</option>
                        <option value="CC">Cédula de ciudadanía</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="CE">Cédula de extranjería</option>
                        <option value="PAS">Pasaporte</option>

                    </select>

                </div>

            </div>

            <div class="form-field">

                <label>Número de documento *</label>

                <div class="input-with-icon">

                    <i class="fa-solid fa-hashtag input-icon"></i>

                    <input
                        type="text"
                        id="documento"
                        placeholder="Ingrese su número de documento"
                        required>

                </div>

            </div>

            <div class="form-field">

                <label>Contraseña *</label>

                <div class="password-container">

                    <i class="fa-solid fa-lock input-icon"></i>

                    <input
                        type="password"
                        id="contrasena"
                        placeholder="Contraseña"
                        required>

                    <i class="fa-solid fa-eye toggle-password"></i>

                </div>

            </div>

            <!-- TOKEN CAPTCHA -->
            <input type="hidden" id="token" name="token">

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-cloud"></i>
                Iniciar sesión
            </button>

            <div class="help-links">

                ¿No recuerdas tu contraseña?
                <a href="forgot_password.php">Restablecer</a>

                <br>

                ¿Tu cuenta está inactiva?
                <a href="#">Más información</a>

            </div>

        </div>

        <!-- REGISTRO -->
        <div class="login-form" id="signup-form">

            <div class="signup-scroll-content">

                <div class="form-field">

                    <label>Nombre *</label>

                    <div class="input-with-icon">

                        <i class="fa-solid fa-user input-icon"></i>

                        <input
                            type="text"
                            placeholder="Nombre"
                            required>

                    </div>

                </div>

                <div class="form-field">

                    <label>Apellido *</label>

                    <div class="input-with-icon">

                        <i class="fa-solid fa-user input-icon"></i>

                        <input
                            type="text"
                            placeholder="Apellido"
                            required>

                    </div>

                </div>

                <div class="form-field">

                    <label>Correo electrónico *</label>

                    <div class="input-with-icon">

                        <i class="fa-solid fa-envelope input-icon"></i>

                        <input
                            type="email"
                            placeholder="Correo electrónico"
                            required>

                    </div>

                </div>

                <div class="form-field">

                    <label>Usuario *</label>

                    <div class="input-with-icon">

                        <i class="fa-solid fa-at input-icon"></i>

                        <input
                            type="text"
                            placeholder="Usuario"
                            required>

                    </div>

                </div>

                <div class="form-field">

                    <label>Contraseña *</label>

                    <div class="password-container">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            placeholder="Contraseña"
                            required>

                        <i class="fa-solid fa-eye toggle-password"></i>

                    </div>

                </div>

                <div class="form-field">

                    <label>Confirmar contraseña *</label>

                    <div class="password-container">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            placeholder="Confirmar contraseña"
                            required>

                        <i class="fa-solid fa-eye toggle-password"></i>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn-login">

                <i class="fa-solid fa-user-plus"></i>
                Registrarse

            </button>

        </div>

        <!-- FOOTER -->
        <div class="footer-login">
            © 2025 NEXO. Todos los derechos reservados.
        </div>

    </div>

    <script src="js/login.js"></script>
    <script src="js/tema.js"></script>

    <!-- SCRIPT CAPTCHA -->
    <script>

        grecaptcha.ready(function () {

            grecaptcha.execute(
                '6LcIVoIsAAAAAPcFXkk1ZMDn9wYSJy-qwebpmA4H',
                { action: 'login' }

            ).then(function (token) {

                document.getElementById("token").value = token;

            });

        });

    </script>

</body>

</html>
