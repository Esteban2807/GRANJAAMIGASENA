/* === CONFIRMACIÓN DE ELIMINACIÓN === */
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-swal-eliminar').forEach(button => {
        button.addEventListener('click', function () {
            const registroId     = this.getAttribute('data-id');
            const registroNombre = this.getAttribute('data-nombre') || 'este registro';
            const formId         = 'form-eliminar-' + registroId;

            Swal.fire({
                title: '¿Eliminar registro?',
                html: `¿Estás seguro de eliminar <strong>${registroNombre}</strong>?<br>Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-trash-alt"></i> Sí, eliminar',
                cancelButtonText:  '<i class="fas fa-times"></i> Cancelar',
                reverseButtons: true,
                customClass: { confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel' },
                willOpen:  () => document.body.classList.add('swal2-open'),
                willClose: () => document.body.classList.remove('swal2-open')
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });

    /* === CONFIRMACIÓN CIERRE DE SESIÓN === */
    document.querySelectorAll('.btn-swal-logout').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Cerrar sesión?',
                html: '¿Estás seguro que te quieres marchar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-sign-out-alt"></i> Sí',
                cancelButtonText:  '<i class="fas fa-times"></i> No',
                reverseButtons: true,
                customClass: { confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel' },
                willOpen:  () => document.body.classList.add('swal2-open'),
                willClose: () => document.body.classList.remove('swal2-open')
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        });
    });

    /* === MENSAJES DE RESULTADO (creado / actualizado / eliminado) === */
    const params = new URLSearchParams(window.location.search);
    const msg    = params.get('msg');
    const error  = params.get('error');

    const mensajes = {
        creado:      { icon: 'success', title: '¡Creado!',      text: 'El registro fue creado exitosamente.'       },
        actualizado: { icon: 'success', title: '¡Actualizado!', text: 'El registro fue actualizado correctamente.' },
        eliminado:   { icon: 'warning', title: 'Eliminado',     text: 'El registro fue eliminado del sistema.'     },
    };

    const errores = {
        error_crear:      { title: 'Error al crear',      text: 'No se pudo crear el registro.'             },
        error_actualizar: { title: 'Error al actualizar', text: 'No se pudo actualizar el registro.'        },
        error_eliminar:   { title: 'Error al eliminar',   text: 'No se pudo eliminar el registro.'          },
        sin_permiso:      { title: 'Sin permisos',        text: 'No tienes permisos para esta acción.'      },
        no_encontrado:    { title: 'No encontrado',       text: 'El registro no existe o ya fue eliminado.' },
    };

    if (msg && mensajes[msg]) {
        const m = mensajes[msg];
        Swal.fire({
            icon: m.icon, title: m.title, text: m.text,
            confirmButtonColor: '#39a900',
            timer: 3000, timerProgressBar: true
        });
    }

    if (error && errores[error]) {
        const e = errores[error];
        Swal.fire({ icon: 'error', title: e.title, text: e.text, confirmButtonColor: '#d33' });
    }

    // Limpiar ?msg= y ?error= de la URL sin recargar
    if (msg || error) {
        const url = new URL(window.location);
        url.searchParams.delete('msg');
        url.searchParams.delete('error');
        window.history.replaceState({}, '', url);
    }

});