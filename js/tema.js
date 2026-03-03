/* === SISTEMA DE MODO OSCURO CON PREFERENCIA GUARDADA === */
// Este bloque gestiona el botón de cambio de tema y recuerda la elección del usuario.

// Lee la preferencia de tema guardada en el navegador (si existe).
const savedTheme = localStorage.getItem('theme');
// Busca el botón que cambia el tema y el cuerpo de la página.
const toggleButton = document.getElementById('theme-toggle');
const body = document.body;

// Si el usuario ya eligió modo oscuro antes, lo aplica al cargar la página.
if (savedTheme === 'dark') {
    body.classList.add('dark-mode');
    toggleButton.innerHTML = '<i class="fas fa-sun"></i>'; // Muestra el ícono de sol (para salir del modo oscuro)
}

// Escucha clics en el botón para alternar entre modo claro y oscuro.
toggleButton.addEventListener('click', () => {
    // Alterna la clase 'dark-mode' en el cuerpo de la página.
    body.classList.toggle('dark-mode');
    // Verifica si ahora está en modo oscuro.
    const isDark = body.classList.contains('dark-mode');
    // Guarda la nueva preferencia en el navegador para futuras visitas.
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    // Cambia el ícono del botón: sol si está oscuro, luna si está claro.
    toggleButton.innerHTML = isDark
        ? '<i class="fas fa-sun"></i>'
        : '<i class="fas fa-moon"></i>';
});