<?php
include_once 'class/partos.php';
include_once 'class/animales.php';
include_once 'class/usuarios.php';
$p = new partos();
$p->setId($_POST['id']);
$p->consultar();
$animales = new animales();
$usuarios = new usuarios();
$animalesData = $animales->listar();
$usuariosData = $usuarios->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Parto</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-baby"></i> Actualizar Parto</h1>
            </div>
            <div class="card-body">
                <form action="controllers/partos/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($p->getId()) ?>">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="datetime-local" name="fecha" id="fecha" value="<?= htmlspecialchars(str_replace(' ', 'T', $p->getFecha())) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="facilidad">Facilidad:</label>
                        <select name="facilidad" id="facilidad" required>
                            <?php
                            $facilidades = ['Normal','Asistido','Cesárea','Difícil'];
                            foreach ($facilidades as $f) {
                                $sel = $p->getFacilidad() === $f ? 'selected' : '';
                                echo "<option value=\"$f\" $sel>$f</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="madre_id">Madre:</label>
                        <select name="madre_id" id="madre_id" required>
                            <?php foreach ($animalesData as $a): ?>
                                <option value="<?= htmlspecialchars($a['id']) ?>" <?= $p->getMadreId()===$a['id']?'selected':''; ?>><?= htmlspecialchars($a['id'].' - '.$a['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="secuencia">Secuencia:</label>
                        <input type="number" name="secuencia" id="secuencia" value="<?= htmlspecialchars($p->getSecuencia()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="documento_usuario">Usuario:</label>
                        <select name="documento_usuario" id="documento_usuario" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $p->getDocumentoUsuario()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_veterinario">Veterinario:</label>
                        <select name="documento_veterinario" id="documento_veterinario" required>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>" <?= $p->getDocumentoVeterinario()===$u['documento']?'selected':''; ?>><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duracion_minutos">Duración (minutos):</label>
                        <input type="number" name="duracion_minutos" id="duracion_minutos" value="<?= htmlspecialchars($p->getDuracionMinutos()) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="l_partos.php" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
