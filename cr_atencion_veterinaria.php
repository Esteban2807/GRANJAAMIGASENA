<?php
include_once 'class/animales.php';
include_once 'class/medicamentos.php';
include_once 'class/usuarios.php';
$animales = new animales();
$medicamentos = new medicamentos();
$usuarios = new usuarios();
$animalesData = $animales->listar();
$medData = $medicamentos->listar();
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
    <title>Crear Atención Veterinaria</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-stethoscope"></i> Crear Atención Veterinaria</h1>
            </div>
            <div class="card-body">
                <form action="controllers/atenciones_veterinarias/op_crear.php" method="POST">
                    <div class="form-group">
                        <label for="id_animal">Animal:</label>
                        <select name="id_animal" id="id_animal" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($animalesData as $a): ?>
                                <option value="<?= htmlspecialchars($a['id']) ?>"><?= htmlspecialchars($a['id'].' - '.$a['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento_veterinario">Veterinario:</label>
                        <select name="documento_veterinario" id="documento_veterinario" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($usuariosData as $u): ?>
                                <option value="<?= htmlspecialchars($u['documento']) ?>"><?= htmlspecialchars($u['documento'].' - '.$u['nombres'].' '.$u['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_atencion">Fecha de atención:</label>
                        <input type="datetime-local" name="fecha_atencion" id="fecha_atencion" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <select name="motivo" id="motivo" required>
                            <option value="Chequeo General">Chequeo General</option>
                            <option value="Vacunación">Vacunación</option>
                            <option value="Enfermedad">Enfermedad</option>
                            <option value="Herida/Trauma">Herida/Trauma</option>
                            <option value="Seguimiento">Seguimiento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="diagnostico">Diagnóstico:</label>
                        <textarea name="diagnostico" id="diagnostico" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tratamiento">Tratamiento:</label>
                        <textarea name="tratamiento" id="tratamiento"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="medicamento_id">Medicamento:</label>
                        <select name="medicamento_id" id="medicamento_id">
                            <option value="">Sin medicamento</option>
                            <?php foreach ($medData as $m): ?>
                                <option value="<?= htmlspecialchars($m['id']) ?>"><?= htmlspecialchars($m['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosis">Dosis:</label>
                        <input type="text" name="dosis" id="dosis">
                    </div>
                    <div class="form-group">
                        <label for="via_administracion">Vía de administración:</label>
                        <select name="via_administracion" id="via_administracion">
                            <option value="">Sin especificar</option>
                            <option value="Oral">Oral</option>
                            <option value="Intramuscular">Intramuscular</option>
                            <option value="Subcutánea">Subcutánea</option>
                            <option value="Intravenosa">Intravenosa</option>
                            <option value="Tópica">Tópica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <textarea name="observaciones" id="observaciones"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="costo_total">Costo total:</label>
                        <input type="number" step="0.01" name="costo_total" id="costo_total" value="0.00">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar</button>
                        <a href="atenciones-veterinarias" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
