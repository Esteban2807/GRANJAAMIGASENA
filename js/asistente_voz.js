/**
 * 🎙️ Asistente de Voz - GRANJA AMIGA SENA
 * Habla automáticamente cuando el mouse pasa encima de elementos importantes.
 * Se puede activar/desactivar con el botón flotante.
 */

(function () {
  'use strict';

  // ─── Configuración de la voz ───────────────────────────────────────────────
  const CONFIG = {
    lang: 'es-CO',          // Español Colombia (o 'es-ES' si no está disponible)
    rate: 0.95,             // Velocidad (0.5 = lento, 1.5 = rápido)
    pitch: 1.05,            // Tono (0 = grave, 2 = agudo)
    volume: 1,              // Volumen (0 a 1)
    delay: 400,             // Milisegundos que espera antes de hablar (evita spam)
    storageKey: 'granjaAmiga_voz_activa',
  };

  // ─── Mensajes por sección ──────────────────────────────────────────────────
  const MENSAJES = {
    // Navegación
    'nav-item':                 'Menú de navegación disponible',
    'menu-toggle-btn':          'Haz clic para ver el menú principal',
    'menu-dropdown-item':       (el) => `Ir a: ${el.textContent.trim()}`,
    'profile-btn':              'Abrir menú de perfil de usuario',
    'theme-toggle':             'Cambiar entre modo claro y oscuro',
    'btn-swal-logout':          'Cerrar sesión del sistema',

    // Tablas y listados
    'table':                    'Tabla de datos. Usa el teclado para navegar entre filas.',
    'btn-action':               (el) => `Botón: ${el.textContent.trim()}`,
    'btn-mt':                   'Volver a la página anterior',

    // Formularios
    'form-group':               'Grupo de campos del formulario',
    'input':                    (el) => el.placeholder ? `Campo: ${el.placeholder}` : `Campo de entrada: ${el.name || ''}`,
    'select':                   (el) => `Lista desplegable: ${el.previousElementSibling?.textContent?.trim() || el.name || 'selección'}`,
    'textarea':                 (el) => `Área de texto: ${el.placeholder || el.name || ''}`,

    // Botones de acción CRUD
    'btn-edit':                 'Editar este registro',
    'btn-delete':               'Eliminar este registro',
    'btn-view':                 'Ver detalle de este registro',

    // Cards / secciones
    'card':                     'Tarjeta de información',
    'alert':                    (el) => `Alerta: ${el.textContent.trim().substring(0, 60)}`,

    // Imágenes
    'img':                      (el) => el.alt ? `Imagen: ${el.alt}` : null,

    // Links
    'a':                        (el) => el.textContent.trim() ? `Enlace: ${el.textContent.trim()}` : null,
  };

  // ─── Estado interno ────────────────────────────────────────────────────────
  let activo = localStorage.getItem(CONFIG.storageKey) !== 'false'; // activo por defecto
  let utteranceActual = null;
  let timerHover = null;
  let ultimoElemento = null;

  // ─── Motor de síntesis de voz ──────────────────────────────────────────────
  const synth = window.speechSynthesis;
  let vocesDisponibles = [];

  function cargarVoces() {
    vocesDisponibles = synth.getVoices();
    // Intenta encontrar voz femenina en español
    return (
      vocesDisponibles.find(v => v.lang.startsWith('es') && v.name.toLowerCase().includes('female')) ||
      vocesDisponibles.find(v => v.lang.startsWith('es') && v.name.toLowerCase().includes('paulina')) ||
      vocesDisponibles.find(v => v.lang.startsWith('es') && v.name.toLowerCase().includes('monica')) ||
      vocesDisponibles.find(v => v.lang.startsWith('es') && v.name.toLowerCase().includes('sabina')) ||
      vocesDisponibles.find(v => v.lang === 'es-CO') ||
      vocesDisponibles.find(v => v.lang === 'es-ES') ||
      vocesDisponibles.find(v => v.lang.startsWith('es')) ||
      null
    );
  }

  if (typeof speechSynthesis !== 'undefined') {
    speechSynthesis.onvoiceschanged = cargarVoces;
    cargarVoces();
  }

  function hablar(texto) {
    if (!activo || !texto || !synth) return;

    synth.cancel(); // cancela lo que esté hablando

    const utter = new SpeechSynthesisUtterance(texto);
    const voz = cargarVoces();
    if (voz) utter.voice = voz;

    utter.lang   = CONFIG.lang;
    utter.rate   = CONFIG.rate;
    utter.pitch  = CONFIG.pitch;
    utter.volume = CONFIG.volume;

    utteranceActual = utter;
    synth.speak(utter);
  }

  // ─── Detectar qué decir al hacer hover ────────────────────────────────────
  function obtenerMensaje(el) {
    if (!el) return null;

    // Busca en el elemento y sus padres cercanos
    for (const [selector, mensaje] of Object.entries(MENSAJES)) {
      if (el.matches(selector) || el.closest(selector)) {
        const target = el.matches(selector) ? el : el.closest(selector);
        return typeof mensaje === 'function' ? mensaje(target) : mensaje;
      }
    }

    // Fallback: aria-label o title
    const label = el.getAttribute('aria-label') || el.getAttribute('title');
    if (label) return label;

    // Fallback: texto corto del botón
    if ((el.tagName === 'BUTTON' || el.tagName === 'A') && el.textContent.trim().length < 60) {
      return el.textContent.trim() || null;
    }

    return null;
  }

  // ─── Eventos de mouse ──────────────────────────────────────────────────────
  document.addEventListener('mouseover', (e) => {
    if (!activo) return;
    const el = e.target;
    if (el === ultimoElemento) return;
    ultimoElemento = el;

    clearTimeout(timerHover);
    timerHover = setTimeout(() => {
      const msg = obtenerMensaje(el);
      if (msg) hablar(msg);
    }, CONFIG.delay);
  });

  document.addEventListener('mouseout', () => {
    clearTimeout(timerHover);
  });

  // Hablar al hacer foco con teclado también
  document.addEventListener('focusin', (e) => {
    if (!activo) return;
    const msg = obtenerMensaje(e.target);
    if (msg) hablar(msg);
  });

  // ─── Botón flotante de activar/desactivar ─────────────────────────────────
  function crearBoton() {
    const btn = document.createElement('button');
    btn.id = 'btn-asistente-voz';
    btn.setAttribute('aria-label', activo ? 'Desactivar asistente de voz' : 'Activar asistente de voz');
    btn.title = activo ? 'Desactivar asistente de voz' : 'Activar asistente de voz';

    btn.innerHTML = activo
      ? '<i class="fas fa-volume-up"></i>'
      : '<i class="fas fa-volume-mute"></i>';

    btn.style.cssText = `
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 9999;
      width: 52px;
      height: 52px;
      border-radius: 50%;
      border: none;
      cursor: pointer;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 16px rgba(0,0,0,0.25);
      transition: transform 0.2s, background 0.2s;
      background: ${activo ? '#39A900' : '#888'};
      color: #fff;
    `;

    btn.addEventListener('click', toggleAsistente);

    btn.addEventListener('mouseenter', () => {
      btn.style.transform = 'scale(1.12)';
    });
    btn.addEventListener('mouseleave', () => {
      btn.style.transform = 'scale(1)';
    });

    document.body.appendChild(btn);
    return btn;
  }

  function toggleAsistente() {
    activo = !activo;
    localStorage.setItem(CONFIG.storageKey, activo ? 'true' : 'false');

    const btn = document.getElementById('btn-asistente-voz');
    if (!btn) return;

    if (activo) {
      btn.innerHTML = '<i class="fas fa-volume-up"></i>';
      btn.style.background = '#39A900';
      btn.title = 'Desactivar asistente de voz';
      btn.setAttribute('aria-label', 'Desactivar asistente de voz');
      hablar('Asistente de voz activado. Mueve el mouse sobre los elementos para escuchar su descripción.');
    } else {
      synth.cancel();
      btn.innerHTML = '<i class="fas fa-volume-mute"></i>';
      btn.style.background = '#888';
      btn.title = 'Activar asistente de voz';
      btn.setAttribute('aria-label', 'Activar asistente de voz');
    }
  }

  // ─── Inicializar al cargar el DOM ──────────────────────────────────────────
  function init() {
    if (!('speechSynthesis' in window)) {
      console.warn('🔇 Este navegador no soporta síntesis de voz.');
      return;
    }
    crearBoton();

    // Saludo inicial solo si está activo
    if (activo) {
      setTimeout(() => {
        hablar('Bienvenido a Granja Amiga. El asistente de voz está activo. Mueve el mouse sobre cualquier elemento para escuchar su descripción.');
      }, 1200);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
