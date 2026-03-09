<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/razas.php';
$raza = new Razas();
$raza->setId($_POST['id']);
$raza->consultar();

include_once 'class/especies.php';
$especie = new Especies();
$especie->setId($_POST['especie']);
$especie->consultar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Raza</title>
    <link rel="stylesheet" href="css/styles.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Header -->
    <header class="header"><?php include './config/header.php' ?></header>

    <!-- Main Content -->
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title">
                    <i class="fas fa-user-circle"></i> Actualizar Raza
                </h1>
            </div>

            <div class="card-body">
                <form action="controllers/razas/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($raza->getId()) ?>">

                    <div class="form-group">
                        <label for="especie">Especie:</label>
                        <select name="especie" id="especie" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($especiesData as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>" <?= $especie->getId() == $item['id_especie'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre" value="<?= htmlspecialchars($raza->getNombre()) ?>" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        <a href="l_usuarios.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
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

</body>

</html>
