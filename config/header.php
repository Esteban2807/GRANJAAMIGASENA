<!-- Header superior -->
<header class="header">
    <div class="header-top">
        <div class="header-top-content">
            <div class="logo-sena">
                <div class="logo-sena-container">
                    <img src="img/logo_sena_verde.png" alt="Logo SENA">
                </div>
                <span class="logo-text">GRANJA <span class="green">AMIGA</span></span>
            </div>
            <div class="ministerio">
                <img src="img/ministerio_de_trabajo.png" alt="Ministerio del Trabajo">
            </div>
        </div>
    </div>

    <!-- Navbar de navegación -->
    <nav class="nav-bar">
        <div class="nav-bar-content">
            <div class="nav-left">
                <button onclick="window.location.href = 'index.php'" class="nav-item menu-toggle-btn">Inicio</button>
                <div class="menu-dropdown-container">
                    <button id="menu-toggle" class="nav-item menu-toggle-btn">
                        Menú
                    </button>
                    <!-- Dropdowns flotantes -->
                    <div id="menu-dropdowns" class="menu-dropdowns">
                        <div class="menu-dropdown-card">
                            <div class="menu-dropdown-header menu-toggle-card">
                                Ejemplo 1
                                <i class="fas fa-chevron-right menu-toggle-icon"></i>
                            </div>
                            <div class="menu-dropdown-content">
                                <div class="menu-dropdown-items">
                                    <a href="#" class="menu-dropdown-item">Opción 1.1</a>
                                    <a href="#" class="menu-dropdown-item">Opción 1.2</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-dropdown-card">
                            <div class="menu-dropdown-header menu-toggle-card">
                                Ejemplo 2
                                <i class="fas fa-chevron-right menu-toggle-icon"></i>
                            </div>
                            <div class="menu-dropdown-content">
                                <div class="menu-dropdown-items">
                                    <a href="#" class="menu-dropdown-item">Opción 2.1</a>
                                    <a href="#" class="menu-dropdown-item">Opción 2.2</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-dropdown-card">
                            <div class="menu-dropdown-header menu-toggle-card">
                                Ejemplo 3
                                <i class="fas fa-chevron-right menu-toggle-icon"></i>
                            </div>
                            <div class="menu-dropdown-content">
                                <div class="menu-dropdown-items">
                                    <a href="#" class="menu-dropdown-item">Opción 3.1</a>
                                    <a href="#" class="menu-dropdown-item">Opción 3.2</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-dropdown-card">
                            <div class="menu-dropdown-header menu-toggle-card">
                                Ejemplo 4
                                <i class="fas fa-chevron-right menu-toggle-icon"></i>
                            </div>
                            <div class="menu-dropdown-content">
                                <div class="menu-dropdown-items">
                                    <a href="#" class="menu-dropdown-item">Opción 4.1</a>
                                    <a href="#" class="menu-dropdown-item">Opción 4.2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Movido fuera de nav-left y colocado al mismo nivel -->
            <div class="nav-right">
                <button id="theme-toggle" class="nav-theme-btn" aria-label="Cambiar tema">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="profile-container">
                    <button class="profile-btn" id="profile-btn" aria-label="Abrir menú de perfil">
                        <div class="profile-avatar">EE</div>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="profile-menu" id="profile-menu">
    <div class="profile-menu-header">
        <div class="profile-menu-avatar">EE</div>
        <div class="profile-menu-name">Ejemplo.Ejemplo</div>
        <div class="profile-menu-email">ejemplo@sena.edu.co</div>
        <button class="profile-menu-manage">Aprendiz</button>
    </div>

    <div class="profile-menu-items">
        <a href="#" class="profile-menu-item">
            <i class="fas fa-user"></i>
            <span>Información Perfil</span>
        </a>
    </div>

    <div class="profile-menu-items">
        <a href="#" class="profile-menu-item">
            <i class="fas fa-question-circle"></i>
            <span>Ayuda y soporte</span>
        </a>
    </div>

    <div class="profile-menu-items">
        <a href="#" class="profile-menu-item btn-swal-logout" role="button" aria-label="Cerrar sesión">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar sesión</span>
        </a>
    </div>

    <div class="profile-menu-footer">
        <a href="#">Política de privacidad</a> • <a href="#">Términos de servicio</a>
    </div>
</div>

<!-- Overlay para desenfoque -->
<div id="profile-backdrop" class="profile-backdrop"></div>
