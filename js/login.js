/* === CONFIGURACIÓN DE LOGOS FLOTANTES DE FONDO === */
// Define la imagen, cantidad y tamaño de los logos que se moverán suavemente por la pantalla.
const logoUrl = 'img/logo_sena_verde.png';
const numLogos = 30;
const logoSize = []; 
const minDistance = [];

// Lista donde se guardarán todos los logos creados.
const logos = [];

/* === CLASE: LOGO === */
// Cada logo es un objeto que se mueve, rebota en los bordes y evita superponerse.
class Logo {
    constructor(x, y, vx, vy) {
        this.x = x;          // Posición horizontal
        this.y = y;          // Posición vertical
        this.vx = vx;        // Velocidad en X
        this.vy = vy;        // Velocidad en Y
        this.size = logoSize; // Tamaño del logo (debería ser un número)
        this.element = document.createElement('div');
        this.element.className = 'logo-bg';
        this.element.innerHTML = `<img src="${logoUrl}" alt="SENA">`;
        document.body.appendChild(this.element);
        this.updatePosition(); // Lo coloca en la pantalla
    }

    // Actualiza la posición visual del logo en la página
    updatePosition() {
        this.element.style.left = this.x + 'px';
        this.element.style.top = this.y + 'px';
    }

    // Mueve el logo y hace que rebote al tocar los bordes de la ventana
    move() {
        this.x += this.vx;
        this.y += this.vy;

        // Rebote en los bordes izquierdo y derecho
        if (this.x <= 0 || this.x >= window.innerWidth - this.size) {
            this.vx *= -1;
            this.x = Math.max(0, Math.min(this.x, window.innerWidth - this.size));
        }

        // Rebote en los bordes superior e inferior
        if (this.y <= 0 || this.y >= window.innerHeight - this.size) {
            this.vy *= -1;
            this.y = Math.max(0, Math.min(this.y, window.innerHeight - this.size));
        }

        this.updatePosition();
    }
}

// Calcula la distancia entre dos puntos (usado para evitar que los logos se choquen)
function distance(x1, y1, x2, y2) {
    return Math.sqrt((x2 - x1) ** 2 + (y2 - y1) ** 2);
}

// Verifica si una posición es válida para colocar un nuevo logo
function isPositionValid(x, y, existingLogos) {
    const centerX = window.innerWidth / 2;
    const centerY = window.innerHeight / 2;

    // No permite logos muy cerca del centro (donde está el logo grande)
    if (distance(x, y, centerX, centerY) < 300) {
        return false;
    }

    // Evita que los logos estén demasiado cerca entre sí
    for (let logo of existingLogos) {
        if (distance(x, y, logo.x, logo.y) < minDistance) { // ← minDistance debe ser un número
            return false;
        }
    }

    return true;
}

// Crea todos los logos flotantes en posiciones seguras
function createLogos() {
    for (let i = 0; i < numLogos; i++) {
        let x, y;
        let attempts = 0;
        const maxAttempts = 100;

        // Intenta encontrar una posición válida (máx. 100 intentos)
        do {
            x = Math.random() * (window.innerWidth - logoSize);
            y = Math.random() * (window.innerHeight - logoSize);
            attempts++;
        } while (!isPositionValid(x, y, logos) && attempts < maxAttempts);

        // Si encuentra una posición, crea el logo con movimiento suave
        if (attempts < maxAttempts) {
            const speed = 0.1 + Math.random() * 0.1;
            const angle = Math.random() * Math.PI * 2;
            const vx = Math.cos(angle) * speed;
            const vy = Math.sin(angle) * speed;

            logos.push(new Logo(x, y, vx, vy));
        }
    }
}

// Detecta colisiones entre logos y los separa suavemente (efecto de "rebote suave")
function checkCollisions() {
    for (let i = 0; i < logos.length; i++) {
        for (let j = i + 1; j < logos.length; j++) {
            const logo1 = logos[i];
            const logo2 = logos[j];
            const dist = distance(logo1.x, logo1.y, logo2.x, logo2.y);

            // Si están demasiado cerca, los empuja ligeramente
            if (dist < logoSize) {
                const angle = Math.atan2(logo2.y - logo1.y, logo2.x - logo1.x);
                const targetX = logo1.x + Math.cos(angle) * logoSize;
                const targetY = logo1.y + Math.sin(angle) * logoSize;

                const ax = (targetX - logo2.x) * 0.05;
                const ay = (targetY - logo2.y) * 0.05;

                logo1.vx -= ax;
                logo1.vy -= ay;
                logo2.vx += ax;
                logo2.vy += ay;
            }
        }
    }
}

// Bucle de animación: mueve todos los logos constantemente
function animate() {
    checkCollisions();
    logos.forEach(logo => logo.move());
    requestAnimationFrame(animate); // Mantiene la animación fluida
}

// Inicia la creación y animación de los logos
createLogos();
animate();

// Ajusta las posiciones si el usuario cambia el tamaño de la ventana
window.addEventListener('resize', () => {
    logos.forEach(logo => {
        logo.x = Math.min(logo.x, window.innerWidth - logoSize);
        logo.y = Math.min(logo.y, window.innerHeight - logoSize);
        logo.updatePosition();
    });
});

/* === ANIMACIÓN ENTRE PESTAÑAS DE LOGIN Y REGISTRO === */
// Permite cambiar entre "Iniciar sesión" y "Registrarse" con animaciones suaves
let isAnimating = false;

document.querySelectorAll('.login-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        if (isAnimating) return; // Evita múltiples clics durante la animación

        const currentActiveForm = document.querySelector('.login-form.active');
        const targetForm = document.getElementById(`${tab.dataset.tab}-form`);

        if (!currentActiveForm || currentActiveForm === targetForm) return;

        isAnimating = true;

        // Marca la pestaña activa
        document.querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const isLoginToSignup = tab.dataset.tab === 'signup';

        // Anima la salida del formulario actual
        if (isLoginToSignup) {
            currentActiveForm.classList.add('to-right');
        } else {
            currentActiveForm.classList.add('to-left');
        }

        // Tras la animación, muestra el nuevo formulario con entrada suave
        setTimeout(() => {
            currentActiveForm.classList.remove('active', 'to-left', 'to-right');

            if (isLoginToSignup) {
                targetForm.classList.add('from-right');
            } else {
                targetForm.classList.add('from-left');
            }

            targetForm.classList.add('active');

            // Limpia las clases de animación después de que terminen
            setTimeout(() => {
                targetForm.classList.remove('from-left', 'from-right');
                isAnimating = false;
            }, 350);
        }, 350);
    });
});

/* === VISUALIZACIÓN DE CONTRASEÑA === */
// Permite al usuario ver su contraseña al hacer clic en el ojo
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
        const input = icon.previousElementSibling; // El campo de contraseña está justo antes del ícono
        if (input.type === 'password') {
            input.type = 'text'; // Muestra los caracteres
            icon.classList.replace('fa-eye', 'fa-eye-slash'); // Cambia el ícono a "oculto"
        } else {
            input.type = 'password'; // Oculta los caracteres
            icon.classList.replace('fa-eye-slash', 'fa-eye'); // Cambia el ícono a "visible"
        }
    });
});