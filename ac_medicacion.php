<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/medicaciones.php';
include_once 'class/animales.php';
include_once 'class/medicamentos.php';
include_once 'class/usuarios.php';
$med = new medicaciones();
$med->setId($_POST['id']);
$med->consultar();
$animales = new animales();
$medicamentos = new medicamentos();
$usuarios = new usuarios();
$animalesData = $animales->listar();
$medData = $medicamentos->listar();
$usuariosData = $usuarios->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Medicación</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-notes-medical"></i> Actualizar Medicación</h1>
            </div>
            <div class="card-body">
                <form action="controllers/medicaciones/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($med->getId()) ?>">
                    <div class="form-group">
                        <label for="id_animal">Animal:</label>
                        <select name="id_animal" id="id_animal" required>
                            <?php foreach ($animalesData as $a): ?>
                                <option value="<?= htmlspecialchars($a['id']) ?>" <?= $med->getIdAnimal()===$a['id']?'selected':''; ?>><?= htmlspecialchars($a['id'].' - '.$a['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_veterinario">Veterinario:</label>
                        <select name="documento_veterinario" id="documento_veterinario" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $med->getDocumentoVeterinario()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_medicamento">Medicamento:</label>
                        <select name="id_medicamento" id="id_medicamento" required>
                            <?php foreach ($medData as $m): ?>
                                <option value="<?= htmlspecialchars($m['id']) ?>" <?= $med->getIdMedicamento()===$m['id']?'selected':''; ?>><?= htmlspecialchars($m['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_dada">Cantidad:</label>
                        <input type="number" step="0.01" name="cantidad_dada" id="cantidad_dada" value="<?= htmlspecialchars($med->getCantidadDada()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora:</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" value="<?= htmlspecialchars(str_replace(' ', 'T', $med->getFechaHora())) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="l_medicaciones.php" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
