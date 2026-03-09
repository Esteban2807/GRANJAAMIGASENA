<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
verificarRol([1]);
include_once 'class/cargos.php';
$cargo = new cargos();
$cargo->setId($_POST['id']);
$cargo->consultar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cargo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-briefcase"></i> Actualizar Cargo</h1>
            </div>
            <div class="card-body">
                <form action="controllers/cargos/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($cargo->getId()) ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($cargo->getNombre()) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="l_cargos.php" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
</body>
</html>
