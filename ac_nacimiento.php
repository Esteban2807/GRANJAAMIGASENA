<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/nacimientos.php';
include_once 'class/partos.php';
include_once 'class/usuarios.php';
$n = new nacimientos();
$n->setId($_POST['id']);
$n->consultar();
$partos = new partos();
$usuarios = new usuarios();
$partosData = $partos->listar();
$usuariosData = $usuarios->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Nacimiento</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-baby-carriage"></i> Actualizar Nacimiento</h1>
            </div>
            <div class="card-body">
                <form action="controllers/nacimientos/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($n->getId()) ?>">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="datetime-local" name="fecha" id="fecha" value="<?= htmlspecialchars(str_replace(' ', 'T', $n->getFecha())) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="parto_id">Parto:</label>
                        <select name="parto_id" id="parto_id" required>
                            <?php foreach ($partosData as $p): ?>
                                <option value="<?= htmlspecialchars($p['id']) ?>" <?= $n->getPartoId()===$p['id']?'selected':''; ?>><?= htmlspecialchars($p['id'].' - '.$p['madre_id'].' - '.$p['fecha']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_usuario">Usuario:</label>
                        <select name="documento_usuario" id="documento_usuario" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $n->getDocumentoUsuario()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="peso_kg">Peso (kg):</label>
                        <input type="number" step="0.01" name="peso_kg" id="peso_kg" value="<?= htmlspecialchars($n->getPesoKg()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo" required>
                            <?php
                            $sexos = ['Macho','Hembra'];
                            foreach ($sexos as $s) {
                                $sel = $n->getSexo() === $s ? 'selected' : '';
                                echo "<option value=\"$s\" $sel>$s</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vigor">Vigor:</label>
                        <select name="vigor" id="vigor" required>
                            <?php
                            $vigores = ['Excelente','Bueno','Débil','Crítico'];
                            foreach ($vigores as $v) {
                                $sel = $n->getVigor() === $v ? 'selected' : '';
                                echo "<option value=\"$v\" $sel>$v</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" name="observaciones" id="observaciones" value="<?= htmlspecialchars($n->getObservaciones()) ?>">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="nacimientos" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
