/**
 * Buscador en tiempo real con AJAX
 * Reutilizable para todos los listados
 */

class BuscadorRealtime {
    constructor(config) {
        this.config = {
            inputSelector: 'input[name="buscar"]',
            tableSelector: '.data-table tbody',
            emptyStateSelector: '.empty-state',
            apiEndpoint: '',
            debounceDelay: 300,
            ...config
        };
        
        this.$input = $(this.config.inputSelector);
        this.$tableBody = $(this.config.tableSelector);
        this.$emptyState = $(this.config.emptyStateSelector);
        this.debounceTimer = null;
        
        this.init();
    }
    
    init() {
        if (!this.$input.length) {
            console.error('BuscadorRealtime: No se encontró el input de búsqueda');
            return;
        }
        
        // Quitar el form submit original
        this.$input.closest('form').off('submit').on('submit', (e) => {
            e.preventDefault();
        });
        
        // Escuchar cambios en el input con debounce
        this.$input.on('input', () => {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                this.buscar();
            }, this.config.debounceDelay);
        });
        
        // Mostrar indicador de carga
        this.$input.on('input', () => {
            this.$input.addClass('loading');
        });
    }
    
    buscar() {
        const query = this.$input.val().trim();
        
        if (query === '') {
            // Si está vacío, cargar todos los datos
            this.cargarTodos();
            return;
        }
        
        $.ajax({
            url: this.config.apiEndpoint,
            method: 'GET',
            data: { q: query },
            dataType: 'json',
            success: (response) => {
                this.$input.removeClass('loading');
                if (response.success) {
                    this.renderizarResultados(response.data);
                } else {
                    this.mostrarError(response.message || 'Error en la búsqueda');
                }
            },
            error: (xhr, status, error) => {
                this.$input.removeClass('loading');
                console.error('Error en búsqueda:', error);
                this.mostrarError('Error al conectar con el servidor');
            }
        });
    }
    
    cargarTodos() {
        // Recargar la página para mostrar todos los datos
        window.location.href = window.location.pathname;
    }
    
    renderizarResultados(datos) {
        if (!datos || datos.length === 0) {
            this.$tableBody.empty();
            this.$emptyState.show();
            return;
        }
        
        this.$emptyState.hide();
        
        // Usar el callback de renderizado personalizado si existe
        if (this.config.renderRow) {
            this.$tableBody.empty();
            datos.forEach(item => {
                this.$tableBody.append(this.config.renderRow(item));
            });
        } else {
            console.error('BuscadorRealtime: No se definió renderRow');
        }
    }
    
    mostrarError(mensaje) {
        this.$tableBody.empty();
        this.$emptyState.show();
        this.$emptyState.find('p').text(mensaje);
    }
}
