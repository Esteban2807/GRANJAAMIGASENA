<?php

require_once("config/seguridad.php");
verificarSesion();
verificarRol([1]);
$rolId = $_SESSION['rol_id'] ?? 0;

include_once 'class/usuarios.php';

// Crear objeto Usuarios
$usuarios = new Usuarios();

/* ¿Viene búsqueda? */
if (isset($_POST['buscar']) && trim($_POST['buscar']) !== '') {
    $res = $usuarios->buscar($_POST['buscar']);
} else {
    $res = $usuarios->listar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>  
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Header -->
    <header class="header"><?php include './config/header.php' ?></header>

    <!-- Main Content -->
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title">
                    <i class="fas fa-user-circle"></i> Usuarios
                </h1>
                <?php if (in_array($rolId, [1])): ?>
                <a href="cr_usuario.php" class="btn-create">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo
                </a>
                <?php endif; ?>
            </div>

            <div class="card-body">
                <div class="search-section">
                    <form class="search-form" action="l_usuarios.php" method="POST">
                        <input type="text" id="buscar-usuario" name="buscar" placeholder="Buscar por nombre..."
                            value="<?php echo isset($_POST['buscar']) ? htmlspecialchars($_POST['buscar']) : ''; ?>">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </form>
                </div>

                <?php if (empty($res)): ?>
                    <div class="empty-state">
                        <i class="fas fa-user-circle"></i>
                        <p>No se encontraron usuarios.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table" id="tabla-usuarios">
                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>Documento</th>
                                <th>Correo</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cargo</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $registro): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($registro['tipo_documento']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['documento']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['correo']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['nombres']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['apellidos']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['cargo_nombre']); ?></td>
                                    <?php if (in_array($rolId, [1])): ?>
                                    <td>
                                        <form action="ac_usuario.php" method="POST" class="form-inline">
                                            <input type="hidden" name="documento"
                                                value="<?php echo htmlspecialchars($registro['documento']); ?>">
                                            <button type="submit" class="btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="form-eliminar-<?php echo $registro['documento']; ?>"
                                            action="controllers/usuarios/op_eliminar.php"
                                            method="POST"
                                            class="form-inline">

                                            <input type="hidden" name="documento"
                                                value="<?php echo htmlspecialchars($registro['documento']); ?>">

                                            <button type="button"
                                                class="btn btn-delete btn-swal-eliminar"
                                                data-id="<?php echo $registro['documento']; ?>"
                                                data-nombre="<?php echo htmlspecialchars($registro['nombres'] ?? 'este usuario', ENT_QUOTES); ?>">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <form action="index.php" method="get" class="text-center">
                    <button type="submit" class="btn-action btn-mt">
                        <i class="fas fa-arrow-left"></i> Volver
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/sweetalerts.js"></script>
    <script src="js/asistente_voz.js"></script>
    <script src="js/busqueda_realtime.js"></script>
    <script>
        $(document).ready(function() {
            new BuscadorRealtime({
                inputSelector: '#buscar-usuario',
                tableSelector: '#tabla-usuarios tbody',
                emptyStateSelector: '.empty-state',
                apiEndpoint: 'controllers/usuarios/op_buscar.php',
                renderRow: function(usuario) {
                    return `
                        <tr>
                            <td>${$('<div>').text(usuario.tipo_documento).html()}</td>
                            <td>${$('<div>').text(usuario.documento).html()}</td>
                            <td>${$('<div>').text(usuario.correo).html()}</td>
                            <td>${$('<div>').text(usuario.nombres).html()}</td>
                            <td>${$('<div>').text(usuario.apellidos).html()}</td>
                            <td>${$('<div>').text(usuario.cargo_nombre).html()}</td>
                            ${usuario.acciones ? `
                            <td>
                                <form action="ac_usuario.php" method="POST" class="form-inline">
                                    <input type="hidden" name="documento" value="${$('<div>').text(usuario.documento).html()}">
                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form id="form-eliminar-${$('<div>').text(usuario.documento).html()}"
                                    action="controllers/usuarios/op_eliminar.php"
                                    method="POST"
                                    class="form-inline">
                                    <input type="hidden" name="documento" value="${$('<div>').text(usuario.documento).html()}">
                                    <button type="button"
                                        class="btn btn-delete btn-swal-eliminar"
                                        data-id="${$('<div>').text(usuario.documento).html()}"
                                        data-nombre="${$('<div>').text(usuario.nombres).html()}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                            ` : ''}
                        </tr>
                    `;
                }
            });
        });
    </script> 


</body>

</html>