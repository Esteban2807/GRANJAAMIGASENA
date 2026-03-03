<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión / Registro</title>
    <link rel="stylesheet" href="css/nexo-style.css">
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
                <span class="login-brand">NE<span class="green">XO</span></span>
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
        <div class="login-form active" id="login-form">
            <div class="form-field">
                <label for="docType">Tipo de documento *</label>
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
                <label for="documento">Número de documento *</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-hashtag input-icon"></i>
                    <input type="text" id="documento" placeholder="Ingrese su número de documento" required />
                </div>
            </div>

            <div class="form-field">
                <label for="contrasena">Contraseña *</label>
                <div class="password-container">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" id="contrasena" placeholder="Contraseña" required />
                    <i class="fa-solid fa-eye toggle-password"></i>
                </div>
            </div>

            <button onclick="window.location.href = 'index.php'" type="submit" class="btn-login">
                <i class="fa-solid fa-cloud"></i>Iniciar sesión
            </button>

            <div class="help-links">
                ¿No recuerdas tu contraseña? <a href="#">Restablecer</a><br>
                ¿Tu cuenta está inactiva? <a href="#">Más información</a>
            </div>
        </div>

        <!-- Formulario de Registro -->
        <div class="login-form" id="signup-form">

            <div class="signup-scroll-content">

                <div class="form-field">
                    <label for="firstName">Nombre *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="firstName" placeholder="Nombre" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="lastName">Apellido *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="lastName" placeholder="Apellido" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="email">Correo electrónico *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" id="email" placeholder="Correo electrónico" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="username">Usuario *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-at input-icon"></i>
                        <input type="text" id="username" placeholder="Usuario" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="signupPassword">Contraseña *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="signupPassword" placeholder="Contraseña" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-field">
                    <label for="confirmPassword"></i> Confirmar contraseña *</label>
                    <div class="password-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="confirmPassword" placeholder="Confirmar contraseña" required />
                        <i class="fa-solid fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-field">
                    <label for="docTypeSignup">Tipo de documento *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-id-card input-icon"></i>
                        <select id="docTypeSignup" required>
                            <option value="">Tipo Documento...</option>
                            <option value="CC">Cédula de ciudadanía</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cédula de extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label for="gender">Género *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-venus-mars input-icon"></i>
                        <select id="gender" required>
                            <option value="">Género...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label for="docNumberNew">Número de documento *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-hashtag input-icon"></i>
                        <input type="text" id="documentoNew" placeholder="Ingrese su número de documento" required />
                    </div>
                </div>

                <div class="form-field">
                    <label for="expeditionPlace">Lugar de expedición *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <select id="expeditionPlace" required>
                            <option value="">Lugar de expedición...</option>
                            <option value="BOG">Bogotá</option>
                            <option value="MED">Medellín</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label for="expeditionDate">Fecha de expedición del documento *</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-calendar-days input-icon"></i>
                        <input type="date" id="expeditionDate" required />
                    </div>
                </div>

            </div>
            <button type="submit" class="btn-login">
                <i class="fa-solid fa-user-plus"></i> Registrarse
            </button>
        </div>

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