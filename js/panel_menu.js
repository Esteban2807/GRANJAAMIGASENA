/* === CONTROL DEL MENÚ DESPLEGABLE DE PERFIL === */
// Este bloque maneja la apertura, cierre y posicionamiento del menú de usuario en la esquina superior derecha.
document.addEventListener('DOMContentLoaded', () => {
    // Busca los elementos clave: botón de perfil, menú desplegable y fondo oscuro.
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');
    const profileBackdrop = document.getElementById('profile-backdrop');
    const body = document.body;

    // Si falta el botón o el menú, no hace nada (evita errores).
    if (!profileBtn || !profileMenu) {
        console.warn('Elementos del menú de perfil no encontrados.');
        return;
    }

    // Crea el fondo oscuro si no existe (para oscurecer el contenido al abrir el menú).
    let backdrop = profileBackdrop;
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.id = 'profile-backdrop';
        backdrop.className = 'profile-backdrop';
        backdrop.style.zIndex = '989';
        backdrop.style.display = 'none';
        document.body.appendChild(backdrop);
    }

    /* === POSICIONAMIENTO INTELIGENTE DEL MENÚ === */
    // Ajusta la posición del menú para que siempre se vea completo, sin salir de la pantalla.
    function positionProfileMenu() {
        const vw = window.innerWidth;
        // En móviles, usa la posición fija definida en CSS (no calcula).
        if (vw <= 600) {
            profileMenu.style.position = '';
            profileMenu.style.left = '';
            profileMenu.style.right = '';
            profileMenu.style.top = '';
            return;
        }

        // Obtiene la posición del botón de perfil.
        const rect = profileBtn.getBoundingClientRect();

        // Mide temporalmente el menú sin que se vea.
        let prevDisplay = profileMenu.style.display;
        let prevVisibility = profileMenu.style.visibility;

        if (window.getComputedStyle(profileMenu).display === 'none') {
            profileMenu.style.visibility = 'hidden';
            profileMenu.style.display = 'block';
        }

        const menuWidth = profileMenu.offsetWidth;
        const menuHeight = profileMenu.offsetHeight;

        // Restaura el estado visual anterior.
        profileMenu.style.display = prevDisplay;
        profileMenu.style.visibility = prevVisibility;

        // Usa posición fija para que no se mueva al hacer scroll.
        profileMenu.style.position = 'fixed';

        const margin = 13; // Margen mínimo al borde de la pantalla.
        let top = rect.bottom + margin; // Abajo del botón.
        let left = rect.right - menuWidth; // Alineado a la derecha del botón.

        // Si el menú se sale por la izquierda, lo alinea a la izquierda del botón.
        if (left < margin) {
            left = rect.left;
        }
        // Si se sale por la derecha, lo ajusta al borde derecho.
        if (left + menuWidth > window.innerWidth - margin) {
            left = window.innerWidth - menuWidth - margin;
        }

        // Si no cabe abajo, lo muestra arriba del botón.
        if (top + menuHeight > window.innerHeight - margin) {
            top = rect.top - menuHeight - margin;
            if (top < margin) top = margin; // Pero nunca fuera de la pantalla.
        }

        // Aplica la posición calculada.
        profileMenu.style.left = `${Math.round(left)}px`;
        profileMenu.style.top = `${Math.round(top)}px`;
        profileMenu.style.right = 'auto';
    }

    /* === ABRIR EL MENÚ DE PERFIL === */
    // Cierra otros menús si están abiertos, muestra el fondo y bloquea el scroll.
    const openProfile = () => {
        const menuDropdowns = document.getElementById('menu-dropdowns');
        if (menuDropdowns && menuDropdowns.classList.contains('active')) {
            const dropdownEvent = new Event('closeDropdown');
            document.dispatchEvent(dropdownEvent);
        }

        profileMenu.classList.add('active');
        backdrop.style.display = 'block';
        body.classList.add('profile-open');
        if (window.__scrollLock) {
            window.__scrollLock.lock('#profile-menu');
        } else {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        }

        // Calcula la posición un instante después de abrirlo.
        setTimeout(positionProfileMenu, 10);
    };

    /* === CERRAR EL MENÚ DE PERFIL === */
    // Oculta el menú, quita el fondo y restaura el scroll.
    const closeProfile = () => {
        profileMenu.classList.remove('active');
        backdrop.style.display = 'none';
        body.classList.remove('profile-open');
        if (window.__scrollLock) {
            window.__scrollLock.unlock('#profile-menu');
        } else {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }
    };

    // Permite cerrar el menú desde otros componentes (ej: al abrir otro menú).
    document.addEventListener('closeProfile', () => {
        closeProfile();
    });

    // Alterna el menú al hacer clic en el botón de perfil.
    profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (profileMenu.classList.contains('active')) {
            closeProfile();
        } else {
            openProfile();
        }
    });

    // Cierra el menú si se hace clic fuera de él.
    document.addEventListener('click', (e) => {
        if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
            closeProfile();
        }
    });

    // Evita que los clics dentro del menú lo cierren.
    profileMenu.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Cierra el menú con la tecla ESC.
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeProfile();
        }
    });

    // Reubica el menú si la ventana cambia de tamaño.
    window.addEventListener('resize', () => {
        if (profileMenu.classList.contains('active')) {
            setTimeout(positionProfileMenu, 50);
        }
    });

    // Reubica el menú si el usuario hace scroll (en escritorio).
    window.addEventListener('scroll', () => {
        if (profileMenu.classList.contains('active')) {
            positionProfileMenu();
        }
    });

    // Si el menú ya está marcado como "activo" al cargar, lo abre.
    if (profileMenu.classList.contains('active')) {
        openProfile();
    }
});