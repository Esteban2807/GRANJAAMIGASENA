<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
verificarRol([1]);
$rolId = $_SESSION['rol_id'] ?? 0;
include_once 'class/cargos.php';
$cargos = new cargos();
if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
    $res = $cargos->buscar($_GET['buscar']);
} else {
    $res = $cargos->listar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-briefcase"></i> Cargos</h1>
            </div>
            <div class="card-body">
                <div class="search-section">
                    <form class="search-form" action="l_cargos.php" method="GET">
                        <input type="text" id="buscar-cargo" name="buscar" placeholder="Buscar por nombre..." value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                        <button type="submit" class="btn-action"><i class="fas fa-search"></i> Buscar</button>
                    </form>
                </div>
                <?php if (empty($res)): ?>
                    <div class="empty-state">
                        <i class="fas fa-briefcase"></i>
                        <p>No se encontraron cargos.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table" id="tabla-cargos">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $registro): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($registro['nombre']); ?></td>
                                    <?php if (in_array($rolId, [1])): ?>
                                    <td>
                                        <form action="ac_cargo.php" method="POST" class="form-inline">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">
                                            <button type="submit" class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                                        </form>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <form action="index.php" method="get" class="text-center">
                    <button type="submit" class="btn-action btn-mt"><i class="fas fa-arrow-left"></i> Volver</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer"><?php include './config/footer.php' ?></footer>
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
                inputSelector: '#buscar-cargo',
                tableSelector: '#tabla-cargos tbody',
                emptyStateSelector: '.empty-state',
                apiEndpoint: 'controllers/cargos/op_buscar.php',
                renderRow: function(cargo) {
                    return `
                        <tr>
                            <td>${$('<div>').text(cargo.nombre).html()}</td>
                            ${cargo.acciones ? `
                            <td>
                                <form action="ac_cargo.php" method="POST" class="form-inline">
                                    <input type="hidden" name="id" value="${$('<div>').text(cargo.id).html()}">
                                    <button type="submit" class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
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