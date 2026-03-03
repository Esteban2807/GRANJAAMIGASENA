/* === ANIMACIÓN DE CARGA INICIAL: OCULTAR EL LOADER Y MOSTRAR EL CONTENIDO === */
// Este bloque se ejecuta cuando toda la página (imágenes, estilos, etc.) ha terminado de cargar.
window.addEventListener('load', function () {
    // Busca el elemento del "loader" (pantalla de bienvenida) y el contenedor principal del contenido.
    const loader = document.getElementById('loader');
    const contenido = document.getElementById('contenido-principal');

    // Espera un poco (300 milisegundos) para que la animación del logo se vea completa.
    setTimeout(function () {
        // Empieza a desvanecer el loader (lo hace transparente suavemente).
        loader.style.opacity = '0';

        // Después de que termina de desvanecerse (600 ms más), lo quita del flujo visual.
        setTimeout(function () {
            loader.style.display = 'none'; // Ya no ocupa espacio ni se ve.
            contenido.style.display = 'block'; // Muestra el contenido principal (antes estaba oculto).

            // Da un pequeño retraso (50 ms) y luego lo hace completamente visible con opacidad.
            setTimeout(() => { 
                contenido.style.opacity = '1'; 
            }, 50);
        }, 600); 
    }, 300); 
});