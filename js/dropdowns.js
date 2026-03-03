/* === BLOQUEO DE DESPLAZAMIENTO (SCROLL LOCK) PARA MENÚS MODALES === */
// Este sistema evita que el fondo se mueva cuando un menú desplegable o modal está abierto.
// Solo permite hacer scroll dentro de elementos específicos (como el propio menú).
const menuToggle = document.getElementById('menu-toggle');
const menuDropdowns = document.getElementById('menu-dropdowns');

// Creamos un bloqueador de scroll global (solo una vez, aunque se use en varios lugares)
if (!window.__scrollLock) {
    window.__scrollLock = (function () {
        let count = 0; // Cuenta cuántos componentes están usando el bloqueo
        let allowedSelectors = []; // Lista de zonas donde SÍ se permite hacer scroll

        // Verifica si el elemento que intenta hacer scroll está dentro de una zona permitida
        function isAllowedTarget(target) {
            try {
                return allowedSelectors.some(sel => target && target.closest && target.closest(sel));
            } catch (err) {
                return false;
            }
        }

        // Detiene el scroll con rueda del mouse si no está en zona permitida
        function wheelHandler(e) {
            if (!isAllowedTarget(e.target)) e.preventDefault();
        }

        // Detiene el scroll táctil (en móviles) si no está en zona permitida
        function touchHandler(e) {
            if (!isAllowedTarget(e.target)) e.preventDefault();
        }

        return {
            // Activa el bloqueo de scroll y permite scroll solo en el selector dado
            lock(selector) {
                if (count === 0) {
                    // Bloquea el scroll en todo el cuerpo
                    document.documentElement.style.overflow = 'hidden';
                    document.body.style.overflow = 'hidden';
                    // Escucha eventos de scroll para cancelarlos
                    window.addEventListener('wheel', wheelHandler, { passive: false });
                    window.addEventListener('touchmove', touchHandler, { passive: false });
                }
                count++;
                if (selector && !allowedSelectors.includes(selector)) allowedSelectors.push(selector);
            },
            // Desactiva el bloqueo cuando ya no hay menús abiertos
            unlock(selector) {
                count = Math.max(0, count - 1);
                if (selector) allowedSelectors = allowedSelectors.filter(s => s !== selector);
                if (count === 0) {
                    // Restaura el scroll normal
                    document.documentElement.style.overflow = '';
                    document.body.style.overflow = '';
                    window.removeEventListener('wheel', wheelHandler);
                    window.removeEventListener('touchmove', touchHandler);
                }
            }
        };
    })();
}

/* === CONTROL DEL MENÚ PRINCIPAL DESPLEGABLE (NAVBAR) === */
// Este bloque maneja la apertura y cierre del menú grande desde el botón "Menú"
if (menuToggle && menuDropdowns) {
    // Crea un fondo oscuro semitransparente detrás del menú (si no existe)
    let menuBackdrop = document.getElementById('menu-backdrop');
    if (!menuBackdrop) {
        menuBackdrop = document.createElement('div');
        menuBackdrop.id = 'menu-backdrop';
        menuBackdrop.className = 'profile-backdrop'; // Reutiliza el estilo del menú de perfil
        menuBackdrop.style.zIndex = '989'; // Por debajo del menú, pero sobre el contenido
        document.body.appendChild(menuBackdrop);
    }

    // Función para abrir el menú principal
    const openMenu = () => {
        // Si el menú de perfil está abierto, lo cierra primero (evita conflictos)
        const profileMenu = document.getElementById('profile-menu');
        if (profileMenu && profileMenu.classList.contains('active')) {
            const profileEvent = new Event('closeProfile');
            document.dispatchEvent(profileEvent);
        }

        // Muestra el menú y el fondo oscuro
        menuDropdowns.classList.add('active');
        menuBackdrop.style.display = 'block';
        document.body.classList.add('menu-open'); // Clase útil para otros estilos
        window.__scrollLock.lock('#menu-dropdowns'); // Bloquea scroll del fondo
    };

    // Función para cerrar el menú principal
    const closeMenu = () => {
        menuDropdowns.classList.remove('active');
        menuBackdrop.style.display = 'none';
        document.body.classList.remove('menu-open');
        window.__scrollLock.unlock('#menu-dropdowns'); // Restaura scroll
    };

    // Permite cerrar el menú desde otros componentes (ej: al abrir el perfil)
    document.addEventListener('closeDropdown', () => {
        closeMenu();
    });

    // Cierra el menú si se hace clic FUERA de él
    document.addEventListener('click', (e) => {
        if (!menuDropdowns.contains(e.target) && !menuToggle.contains(e.target)) {
            closeMenu();
        }
    });

    // Alterna el menú al hacer clic en el botón "Menú"
    menuToggle.addEventListener('click', (e) => {
        e.stopPropagation(); // Evita que el clic se propague al documento
        if (menuDropdowns.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    // Evita que los clics dentro del menú lo cierren
    menuDropdowns.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Cierra el menú con la tecla ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
}

/* === CONTROL DE SUBMENÚS DENTRO DE LAS TARJETAS DEL MENÚ === */
// Cada tarjeta del menú puede expandirse o contraerse (como acordeones)
document.addEventListener('DOMContentLoaded', () => {
    // Busca todos los botones que abren/cierran submenús
    const toggleButtons = document.querySelectorAll('.menu-toggle-card');

    toggleButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); // Evita que se cierre el menú principal

            // Encuentra la tarjeta y su contenido interno
            const parentCard = button.closest('.menu-dropdown-card');
            const content = parentCard.querySelector('.menu-dropdown-content');

            if (content.classList.contains('active')) {
                // Si está abierto, lo cierra
                content.style.maxHeight = '0';
                content.classList.remove('active');
                button.classList.remove('active');
            } else {
                // Si está cerrado, lo abre calculando su altura real
                content.classList.add('active');
                button.classList.add('active');
                const scrollHeight = content.scrollHeight;
                content.style.maxHeight = scrollHeight + 'px';
            }
        });
    });
});