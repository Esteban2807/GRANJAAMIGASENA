<?php

include_once 'class/animales.php';
$animales = new Animales();
$animalesData = $animales->listar();
/* ¿Viene búsqueda? */
if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
    $res = $animales->buscar($_GET['buscar']);
} else {
    $res = $animales->listar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Animales</title>
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
                    <i class="fas fa-id-card"></i> Animales
                </h1>
                <a href="cr_animal.php" class="btn-create">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo
                </a>
            </div>

            <div class="card-body">
                <div class="search-section">
                    <form class="search-form" action="l_animales.php" method="GET">
                        <input type="text" name="buscar" placeholder="Buscar por nombre."
                            value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </form>
                </div>

                <?php if (empty($res)): ?>
                    <div class="empty-state">
                        <i class="fas fa-id-card"></i>
                        <p>No se encontraron animales.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Espécie</th>
                                <th>Raza</th>
                                <th>Padre</th>
                                <th>Madre</th>
                                <th>Observaciones</th>
                                <th>Fecha de Nacimiento</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $registro): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($registro['id']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['especie']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['raza']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['id_padre']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['id_madre']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['observaciones']); ?></td>
                                    <td><?php echo htmlspecialchars($registro['fecha_de_nacimiento']); ?></td>
                                    <td>
                                        <form action="ac_animal.php" method="POST" class="form-inline">
                                            <input type="hidden" name="id"
                                                value="<?php echo htmlspecialchars($registro['id']); ?>">
                                            <button type="submit" class="btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="form-eliminar-<?php echo $registro['id']; ?>"
                                            action="controllers/raza/op_eliminar.php"
                                            method="POST"
                                            class="form-inline">

                                            <input type="hidden" name="id"
                                                value="<?php echo htmlspecialchars($registro['id']); ?>">

                                            <button type="button"
                                                class="btn btn-delete btn-swal-eliminar"
                                                data-id="<?php echo $registro['id']; ?>"
                                                data-nombre="<?php echo htmlspecialchars($registro['nombre'] ?? 'esta raza', ENT_QUOTES); ?>">
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
