<?php
include_once 'class/partos.php';
include_once 'class/usuarios.php';
$partos = new partos();
$usuarios = new usuarios();
$partosData = $partos->listar();
$usuariosData = $usuarios->listar();
?>
<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nacimiento</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-baby-carriage"></i> Crear Nacimiento</h1>
            </div>
            <div class="card-body">
                <form action="controllers/nacimientos/op_crear.php" method="POST">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="datetime-local" name="fecha" id="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="parto_id">Parto:</label>
                        <select name="parto_id" id="parto_id" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($partosData as $p): ?>
                                <option value="<?= htmlspecialchars($p['id']) ?>"><?= htmlspecialchars($p['id'].' - '.$p['madre_id'].' - '.$p['fecha']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_usuario">Usuario:</label>
                        <select name="documento_usuario" id="documento_usuario" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>"><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="peso_kg">Peso (kg):</label>
                        <input type="number" step="0.01" name="peso_kg" id="peso_kg" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo" required>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vigor">Vigor:</label>
                        <select name="vigor" id="vigor" required>
                            <option value="Excelente">Excelente</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Débil">Débil</option>
                            <option value="Crítico">Crítico</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" name="observaciones" id="observaciones">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar</button>
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
