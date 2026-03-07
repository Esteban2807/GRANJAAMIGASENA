<?php

require_once("config/seguridad.php");
verificarSesion();
verificarRol([1]);

include_once 'class/usuarios.php';

// Crear objeto Usuarios
$usuarios = new Usuarios();

/* ¿Viene búsqueda? */
if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
    $res = $usuarios->buscar($_GET['buscar']);
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
                    <i class="fas fa-user-circle"></i> Usuario
                </h1>
                <a href="cr_usuario.php" class="btn-create">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo
                </a>
            </div>

            <div class="card-body">
                <div class="search-section">
                    <form class="search-form" action="l_usuarios.php" method="GET">
                        <input type="text" name="buscar" placeholder="Buscar por nombres."
                            value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
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
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Tipo de Documento</th>
                                    <th>Número de Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>ID Cargo</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res as $registro): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($registro['tipo_documento']); ?></td>
                                        <td><?php echo htmlspecialchars($registro['documento']); ?></td>
                                        <td><?php echo htmlspecialchars($registro['nombres']); ?></td>
                                        <td><?php echo htmlspecialchars($registro['apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($registro['correo']); ?></td>
                                        <td><?php echo htmlspecialchars($registro['id_cargo']); ?></td>
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
                                            <form id="form-eliminar-<?php echo htmlspecialchars($registro['documento']); ?>"
                                                action="controllers/usuarios/op_eliminar.php"
                                                method="POST"
                                                class="form-inline">

                                                <input type="hidden" name="documento"
                                                    value="<?php echo htmlspecialchars($registro['documento']); ?>">

                                                <button type="button"
                                                    class="btn btn-delete btn-swal-eliminar"
                                                    data-id="<?php echo htmlspecialchars($registro['documento']); ?>"
                                                    data-nombre="<?php echo htmlspecialchars($registro['nombres'] ?? 'este usuario', ENT_QUOTES); ?>">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/sweetalerts.js"></script>


</body>

</html>
