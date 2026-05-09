<?php
session_start();
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

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- RECAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcIVoIsAAAAAPcFXkk1ZMDn9wYSJy-qwebpmA4H"></script>

    <style>
        /* ── SweetAlert2 — Tema GRANJA AMIGA ── */
        .swal-ga-popup {
            background: #1a1a1a !important;
            border: 1px solid #2a2a2a !important;
            border-radius: 14px !important;
            font-family: inherit !important;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7) !important;
        }

        .swal-ga-title {
            color: #ffffff !important;
            font-size: 1.2rem !important;
            font-weight: 600 !important;
        }

        .swal-ga-html {
            color: #b0b0b0 !important;
            font-size: 0.92rem !important;
            line-height: 1.6 !important;
        }

        /* Botón principal verde */
        .swal-ga-confirm {
            background: #3dba4e !important;
            border: none !important;
            border-radius: 8px !important;
            color: #fff !important;
            font-weight: 600 !important;
            padding: 10px 28px !important;
            font-size: 0.9rem !important;
            transition: background 0.2s ease !important;
            box-shadow: none !important;
        }

        .swal-ga-confirm:hover {
            background: #32a542 !important;
        }

        /* Botón cancelar / secundario */
        .swal-ga-cancel {
            background: #2a2a2a !important;
            border: 1px solid #3a3a3a !important;
            border-radius: 8px !important;
            color: #b0b0b0 !important;
            font-weight: 500 !important;
            padding: 10px 24px !important;
            font-size: 0.9rem !important;
            box-shadow: none !important;
        }

        .swal-ga-cancel:hover {
            background: #333 !important;
        }

        /* Íconos personalizados */
        .swal-ga-popup .swal2-icon.swal2-error {
            border-color: #e05252 !important;
            color: #e05252 !important;
        }

        .swal-ga-popup .swal2-icon.swal2-warning {
            border-color: #f0a500 !important;
            color: #f0a500 !important;
        }

        .swal-ga-popup .swal2-icon.swal2-success {
            border-color: #3dba4e !important;
            color: #3dba4e !important;
        }

        .swal-ga-popup .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #3dba4e !important;
        }

        .swal-ga-popup .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(61, 186, 78, 0.3) !important;
        }

        .swal-ga-popup .swal2-icon.swal2-info {
            border-color: #3dba4e !important;
            color: #3dba4e !important;
        }

        /* Barra de progreso del timer */
        .swal-ga-popup .swal2-timer-progress-bar {
            background: #3dba4e !important;
        }

        /* Overlay oscuro */
        .swal-ga-backdrop {
            background: rgba(0, 0, 0, 0.75) !important;
            backdrop-filter: blur(3px) !important;
        }

        /* Lista de errores dentro del HTML */
        .swal-ga-list {
            list-style: none;
            padding: 0;
            margin: 8px 0 0 0;
            text-align: left;
        }

        .swal-ga-list li {
            padding: 5px 0 5px 24px;
            position: relative;
            color: #b0b0b0;
            font-size: 0.88rem;
        }

        .swal-ga-list li::before {
            content: '›';
            position: absolute;
            left: 8px;
            color: #3dba4e;
            font-weight: bold;
        }
    </style>

</head>

<body class="login-page">

    <div class="login-backdrop"></div>

    <div class="login-wrapper">

        <!-- HEADER -->
        <div class="login-header">

            <div class="login-logo">
                <img src="img/logo_sena_verde.png" alt="Logo SENA">
                <span class="login-brand">GRANJA<span class="green">AMIGA</span></span>
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

        <!-- Formulario de Iniciar Sesión -->
        <form method="post" action="config/login.php" class="login-form active" id="login-form">
            <div class="form-field">

                <label>Tipo de documento *</label>

                <div class="input-with-icon">

                    <i class="fa-solid fa-id-card input-icon"></i>
                    <select id="tipo_documento" name="tipo_documento" required>
                        <option value="">Tipo de documento...</option>
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
                    <input type="text" id="documento" name="documento" placeholder="Ingrese su número de documento" required />
                </div>

            </div>

            <div class="form-field">

                <label>Contraseña *</label>

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

                ¿No recuerdas tu contraseña?
                <a href="forgot_password.php">Restablecer</a>

                <br>

                ¿Tu cuenta está inactiva?
                <a href="#">Más información</a>

                <br>
                <br>

                <!-- ENLACE AL MANUAL DE USUARIO -->
                <a href="integracion_manuales/Manual_Usuario.html" target="_blank">
                    <i class="fa-solid fa-book"></i> Ver Manual de Usuario
                </a>

            </div>
        </form>

        <!-- Formulario de Registro -->
        <form method="POST" action="config/register.php" class="login-form" id="signup-form">
            <input type="hidden" name="id_cargo" value="6">
            <div class="signup-scroll-content">
                  <div class="form-field">
                    <label for="docTypeSignup">Tipo_documento</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-id-card input-icon"></i>
                        <select id="docTypeSignup" name="tipo_documento" required>
                            <option value="">Tipo Documento...</option>
                            <option value="CC">Cédula de ciudadanía</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cédula de extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
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
                    <label for="apellidos">Apellidos *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-field">
                    <label for="password">Contraseña *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="contrasena" placeholder="Contraseña" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-field">
                    <label for="confirmPassword"> Confirmar contraseña *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="confirmPassword" name="confirm_contrasena" placeholder="Confirmar contraseña" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-user-plus"></i>
                Registrarse
            </button>
        </form>

        <!-- FOOTER -->
        <div class="footer-login">
            © 2025 GRANJA AMIGA. Todos los derechos reservados.
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

    <!-- ══════════════════════════════════════════
         SWEETALERT2 — VALIDACIONES GRANJA AMIGA
    ══════════════════════════════════════════ -->
    <script>
    (function () {

        /* ── Configuración base compartida ── */
        const gaBase = {
            customClass: {
                popup:         'swal-ga-popup',
                title:         'swal-ga-title',
                htmlContainer: 'swal-ga-html',
                confirmButton: 'swal-ga-confirm',
                cancelButton:  'swal-ga-cancel',
            },
            backdrop: 'rgba(0,0,0,0.75)',
            buttonsStyling: false,
        };

        /* ── Helpers ── */
        function gaError(title, html) {
            return Swal.fire({ ...gaBase, icon: 'error', title, html, confirmButtonText: 'Entendido' });
        }

        function gaWarning(title, html) {
            return Swal.fire({ ...gaBase, icon: 'warning', title, html, confirmButtonText: 'Corregir' });
        }

        /* ── 1. ERROR DE BACKEND (sesión PHP) ── */
        <?php if ($login_error): ?>
        document.addEventListener('DOMContentLoaded', function () {
            gaError(
                'Acceso denegado',
                `<p><?= htmlspecialchars($login_error, ENT_QUOTES) ?></p>
                 <p style="margin-top:8px;font-size:0.82rem;color:#666;">
                     Verifica tu número de documento y contraseña e inténtalo de nuevo.
                 </p>`
            );
        });
        <?php endif; ?>

        /* ── 2. VALIDACIÓN DEL FORMULARIO DE LOGIN ── */
        document.getElementById('login-form').addEventListener('submit', function (e) {

            const tipo   = document.getElementById('tipo_documento').value.trim();
            const doc    = document.getElementById('documento').value.trim();
            const pass   = document.getElementById('contrasena').value;
            const errors = [];

            if (!tipo)                           errors.push('Selecciona el <strong>tipo de documento</strong>.');
            if (!doc)                            errors.push('Ingresa tu <strong>número de documento</strong>.');
            else if (!/^\d+$/.test(doc))         errors.push('El número de documento solo debe contener <strong>dígitos</strong>.');
            else if (doc.length < 5 || doc.length > 15)
                                                 errors.push('El documento debe tener entre <strong>5 y 15 dígitos</strong>.');
            if (!pass)                           errors.push('Ingresa tu <strong>contraseña</strong>.');
            else if (pass.length < 6)            errors.push('La contraseña debe tener al menos <strong>6 caracteres</strong>.');

            if (errors.length > 0) {
                e.preventDefault();
                gaWarning(
                    'Campos incompletos',
                    `<ul class="swal-ga-list">${errors.map(err => `<li>${err}</li>`).join('')}</ul>`
                );
            }
        });

        /* ── 3. VALIDACIÓN DEL FORMULARIO DE REGISTRO ── */
        document.getElementById('signup-form').addEventListener('submit', function (e) {

            const tipo     = document.getElementById('docTypeSignup').value.trim();
            const doc      = document.getElementById('lastName').value.trim();
            const correo   = document.getElementById('email').value.trim();
            const nombres  = document.getElementById('username').value.trim();
            const apellido = document.getElementById('apellidos').value.trim();
            const pass     = document.getElementById('password').value;
            const confirm  = document.getElementById('confirmPassword').value;
            const errors   = [];

            /* Tipo documento */
            if (!tipo) errors.push('Selecciona el <strong>tipo de documento</strong>.');

            /* Documento numérico */
            if (!doc)                            errors.push('Ingresa tu <strong>número de documento</strong>.');
            else if (!/^\d+$/.test(doc))         errors.push('El documento solo debe contener <strong>dígitos</strong>.');
            else if (doc.length < 5 || doc.length > 15)
                                                 errors.push('El documento debe tener entre <strong>5 y 15 dígitos</strong>.');

            /* Correo */
            const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!correo)                         errors.push('Ingresa tu <strong>correo electrónico</strong>.');
            else if (!emailRx.test(correo))      errors.push('El correo electrónico no tiene un <strong>formato válido</strong>.');

            /* Nombres y apellidos — solo letras y espacios */
            const nameRx = /^[a-záéíóúüñA-ZÁÉÍÓÚÜÑ\s'-]+$/u;
            if (!nombres)                        errors.push('Ingresa tus <strong>nombres</strong>.');
            else if (!nameRx.test(nombres))      errors.push('Los nombres solo deben contener <strong>letras</strong>.');

            if (!apellido)                       errors.push('Ingresa tus <strong>apellidos</strong>.');
            else if (!nameRx.test(apellido))     errors.push('Los apellidos solo deben contener <strong>letras</strong>.');

            /* Contraseña robusta */
            if (!pass) {
                errors.push('Ingresa una <strong>contraseña</strong>.');
            } else {
                const passErrors = [];
                if (pass.length < 8)             passErrors.push('al menos <strong>8 caracteres</strong>');
                if (!/[A-Z]/.test(pass))         passErrors.push('una <strong>letra mayúscula</strong>');
                if (!/[0-9]/.test(pass))         passErrors.push('un <strong>número</strong>');
                if (passErrors.length > 0)
                    errors.push(`La contraseña debe contener: ${passErrors.join(', ')}.`);
            }

            /* Confirmación */
            if (!confirm)                        errors.push('Confirma tu <strong>contraseña</strong>.');
            else if (pass && pass !== confirm)   errors.push('Las contraseñas <strong>no coinciden</strong>.');

            if (errors.length > 0) {
                e.preventDefault();
                gaWarning(
                    'Revisa el formulario',
                    `<ul class="swal-ga-list">${errors.map(err => `<li>${err}</li>`).join('')}</ul>`
                );
                return;
            }

            /* ── Confirmación visual antes de enviar el registro ── */
            e.preventDefault();
            Swal.fire({
                ...gaBase,
                icon: 'question',
                title: '¿Confirmar registro?',
                html: `<p>Se creará una cuenta para <strong style="color:#3dba4e">${nombres} ${apellido}</strong>.<br>
                       <span style="font-size:0.85rem;color:#888">Documento: ${tipo} ${doc}</span></p>`,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-user-plus" style="margin-right:6px"></i>Sí, registrarme',
                cancelButtonText:  'Cancelar',
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById('signup-form').submit();
                }
            });
        });

    })();
    </script>

</body>

</html>