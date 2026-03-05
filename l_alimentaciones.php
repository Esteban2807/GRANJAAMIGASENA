<?php
include_once 'class/alimentaciones.php';
$alims = new alimentaciones();
if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
    $res = $alims->buscar($_GET['buscar']);
} else {
    $res = $alims->listar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alimentaciones</title>
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
                <h1 class="card-title"><i class="fas fa-drumstick-bite"></i> Alimentaciones</h1>
                <a href="cr_alimentacion.php" class="btn-create"><i class="fas fa-plus-circle"></i> Crear Nuevo</a>
            </div>
            <div class="card-body">
                <div class="search-section">
                    <form class="search-form" action="l_alimentaciones.php" method="GET">
                        <input type="text" name="buscar" placeholder="Buscar por animal o documento." value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                        <button type="submit" class="btn-action"><i class="fas fa-search"></i> Buscar</button>
                    </form>
                </div>
                <?php if (empty($res)): ?>
                    <div class="empty-state">
                        <i class="fas fa-drumstick-bite"></i>
                        <p>No se encontraron alimentaciones.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Animal</th>
                                <th>Alimentador</th>
                                <th>Alimento</th>
                                <th>Cantidad</th>
                                <th>Fecha/Hora</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $registro): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($registro['id']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['id_animal']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['documento_alimentador']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['id_alimento']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['cantidad_dada']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['fecha_hora']); ?></td>
                                    <td>
                                        <form action="ac_alimentacion.php" method="POST" class="form-inline">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">
                                            <button type="submit" class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="form-eliminar-<?php echo $registro['id']; ?>" action="controllers/alimentaciones/op_eliminar.php" method="POST" class="form-inline">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">
                                            <button type="button" class="btn btn-delete btn-swal-eliminar" data-id="<?php echo $registro['id']; ?>" data-nombre="<?php echo htmlspecialchars($registro['id'] ?? 'este registro', ENT_QUOTES); ?>">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
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
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/sweetalerts.js"></script>
</body>
</html>
