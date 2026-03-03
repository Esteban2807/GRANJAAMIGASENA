/* === CONFIRMACIÓN DE ELIMINACIÓN CON ALERTA PERSONALIZADA === */
// Cuando la página termina de cargar, busca todos los botones que eliminan registros.
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-swal-eliminar').forEach(button => {
        button.addEventListener('click', function () {
            // Obtiene el ID y el nombre del registro a eliminar desde los atributos del botón.
            const registroId = this.getAttribute('data-id');
            const registroNombre = this.getAttribute('data-nombre') || 'este registro';
            const formId = 'form-eliminar-' + registroId; // Nombre del formulario oculto que se enviará

            // Muestra una alerta de confirmación con estilo personalizado.
            Swal.fire({
                title: '¿Eliminar registro?',
                html: `¿Estás seguro de eliminar <strong>${registroNombre}</strong>?<br>Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-trash-alt"></i> Sí, eliminar',
                cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                reverseButtons: true, // Pone el botón "Sí" a la izquierda
                customClass: {
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                },

                // Añade una clase al body mientras la alerta está abierta (útil para estilos o bloqueos).
                willOpen: () => {
                    document.body.classList.add('swal2-open');
                },
                willClose: () => {
                    document.body.classList.remove('swal2-open');
                }

            }).then((result) => {
                // Si el usuario confirma, envía el formulario de eliminación.
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });
});

/* === CONFIRMACIÓN DE CIERRE DE SESIÓN === */
// También al cargar la página, busca los botones de cierre de sesión.
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-swal-logout').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el enlace actúe inmediatamente

            // Muestra una alerta amigable preguntando si realmente quiere salir.
            Swal.fire({
                title: '¿Cerrar sesión?',
                html: '¿Estás seguro que te quieres marchar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-sign-out-alt"></i> Sí',
                cancelButtonText: '<i class="fas fa-times"></i> No',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                },

                willOpen: () => {
                    document.body.classList.add('swal2-open');
                },
                willClose: () => {
                    document.body.classList.remove('swal2-open');
                }

            }).then((result) => {
                // Si confirma, redirige al usuario a la página de login.
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        });
    });
});