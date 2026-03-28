<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/alimentaciones.php';
include_once 'class/animales.php';
include_once 'class/alimentos.php';
include_once 'class/usuarios.php';
$al = new alimentaciones();
$al->setId($_POST['id']);
$al->consultar();
$animales = new animales();
$alimentos = new alimentos();
$usuarios = new usuarios();
$animalesData = $animales->listar();
$alimentosData = $alimentos->listar();
$usuariosData = $usuarios->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Alimentación</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-drumstick-bite"></i> Actualizar Alimentación</h1>
            </div>
            <div class="card-body">
                <form action="controllers/alimentaciones/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($al->getId()) ?>">
                    <div class="form-group">
                        <label for="id_animal">Animal:</label>
                        <select name="id_animal" id="id_animal" required>
                            <?php foreach ($animalesData as $a): ?>
                                <option value="<?= htmlspecialchars($a['id']) ?>" <?= $al->getIdAnimal()===$a['id']?'selected':''; ?>><?= htmlspecialchars($a['id'].' - '.$a['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_alimentador">Alimentador:</label>
                        <select name="documento_alimentador" id="documento_alimentador" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $al->getDocumentoAlimentador()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_alimento">Alimento:</label>
                        <select name="id_alimento" id="id_alimento" required>
                            <?php foreach ($alimentosData as $ali): ?>
                                <option value="<?= htmlspecialchars($ali['id']) ?>" <?= $al->getIdAlimento()===$ali['id']?'selected':''; ?>><?= htmlspecialchars($ali['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_dada">Cantidad:</label>
                        <input type="number" step="0.01" name="cantidad_dada" id="cantidad_dada" value="<?= htmlspecialchars($al->getCantidadDada()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora:</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" value="<?= htmlspecialchars(str_replace(' ', 'T', $al->getFechaHora())) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="alimentaciones" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
