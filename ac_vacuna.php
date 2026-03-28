<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/vacunas.php';
$vac = new vacunas();
$vac->setId($_POST['id']);
$vac->consultar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Vacuna</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-syringe"></i> Actualizar Vacuna</h1>
            </div>
            <div class="card-body">
                <form action="controllers/vacunas/op_actualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($vac->getId()) ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($vac->getNombre()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="marca_proveedor">Marca/Proveedor:</label>
                        <input type="text" name="marca_proveedor" id="marca_proveedor" value="<?= htmlspecialchars($vac->getMarcaProveedor()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_actual">Stock:</label>
                        <input type="number" step="0.01" name="stock_actual" id="stock_actual" value="<?= htmlspecialchars($vac->getStockActual()) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="unidad_medida">Unidad:</label>
                        <select name="unidad_medida" id="unidad_medida" required>
                            <?php
                            $unidades = ['ml','cm^3'];
                            foreach ($unidades as $u) {
                                $sel = $vac->getUnidadMedida() === $u ? 'selected' : '';
                                echo "<option value=\"$u\" $sel>$u</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" value="<?= htmlspecialchars($vac->getFechaVencimiento()) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="vacunas" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
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
