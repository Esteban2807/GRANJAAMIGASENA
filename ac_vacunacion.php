<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/vacunaciones.php';
include_once 'class/animales.php';
include_once 'class/vacunas.php';
include_once 'class/usuarios.php';
$vac = new vacunaciones();
$vac->setId($_POST['id']);
$vac->consultar();
$animales = new animales();
$vacunas = new vacunas();
$usuarios = new usuarios();
$animalesData = $animales->listar();
$vacData = $vacunas->listar();
$usuariosData = $usuarios->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Vacunación</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-syringe"></i> Actualizar Vacunación</h1>
            </div>
            <div class="card-body">
                <form action="controllers/vacunaciones/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($vac->getId()) ?>">
                    <div class="form-group">
                        <label for="id_animal">Animal:</label>
                        <select name="id_animal" id="id_animal" required>
                            <?php foreach ($animalesData as $a): ?>
                                <option value="<?= htmlspecialchars($a['id']) ?>" <?= $vac->getIdAnimal()===$a['id']?'selected':''; ?>><?= htmlspecialchars($a['id'].' - '.$a['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_veterinario">Veterinario:</label>
                        <select name="documento_veterinario" id="documento_veterinario" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $vac->getDocumentoVeterinario()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_vacuna">Vacuna:</label>
                        <select name="id_vacuna" id="id_vacuna" required>
                            <?php foreach ($vacData as $v): ?>
                                <option value="<?= htmlspecialchars($v['id']) ?>" <?= $vac->getIdVacuna()===$v['id']?'selected':''; ?>><?= htmlspecialchars($v['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_dada">Cantidad:</label>
                        <input type="number" step="0.01" name="cantidad_dada" id="cantidad_dada" value="<?= htmlspecialchars($vac->getCantidadDada()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora:</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" value="<?= htmlspecialchars(str_replace(' ', 'T', $vac->getFechaHora())) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="vacunaciones" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
